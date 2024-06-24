<?php

namespace App\Http\Controllers;

use App\Models\OnlineVotePerson;
use App\Services\OAuth2ClientService;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OnlineVotePersonController extends Controller
{

    protected $oauth2Client;

    public function __construct(OAuth2ClientService $oauth2Client)
    {
        $this->oauth2Client = $oauth2Client;
    }

    public function store(Request $request)
    {
        // Ambil IP address dan user agent dari request
        $ip = $request->ip();
        $userAgent = $request->header('User-Agent');

        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required',
            'nik' => 'required|numeric',
            'pilihan' => 'required|in:1,2,3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        try {
            // Konversi tanggal
            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal_lahir)->format('Y-m-d');
            $usia   = Carbon::parse($tanggal)->age;

        } catch (InvalidFormatException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Format tanggal tidak valid. Gunakan format dd/mm/yyyy.'
            ], 422);
        }

        // Periksa apakah IP sudah pernah voting
        $existingVoteByIp = OnlineVotePerson::where('ip', $ip)->first();
        if ($existingVoteByIp) {
            return response()->json([
                'success' => false,
                'message' => 'IP yang digunakan sudah pernah melakukan voting'
            ], 422);
        }

        // Periksa apakah NIK sudah pernah voting
        $existingVoteByNik = OnlineVotePerson::where('nik', $request->nik)->first();
        if ($existingVoteByNik) {
            return response()->json([
                'success' => false,
                'message' => 'NIK sudah pernah voting, dan hanya diperbolehkan 1 kali'
            ], 422);
        }

        [$code, $result] = $this->oauth2Client->getToken();

        if ($code === 401) {
            return response()->json([
                'success' => false,
                'message' => $result
            ]);
        }

        $data = [
            'nama' => $request->nama,
            'tanggal' => $tanggal,
            'nik' => $request->nik
        ];

        [$statusCode, $response] = $this->patientRequest($data, $result);

        // Periksa status kode
        if ($statusCode == 200) {
            $datas = $response->entry;

            if ($datas === []) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ditemukan penduduk dengan Nomor induk Kependudukan seperti ini'
                ], 422);
            }else {
                $city = $datas[0]->resource->address[0]->city;
                if (strpos($city, 'ACEH BARAT DAYA') !== false) {
                    if ($usia >= 17) {
                        $vote = OnlineVotePerson::create([
                            'nama' => $request->nama,
                            'tanggal_lahir' => $tanggal,
                            'nik' => $request->nik,
                            'ip' => $ip,
                            'user_agent' => $userAgent,
                            'pilihan' => $request->pilihan,
                        ]);

                        return response()->json([
                            'success' => true,
                            'message' => 'Berhasil Melakukan Voting'
                        ], 201);
                    }else {
                        return response()->json([
                            'success' => false,
                            'message' => "Usia anda masih $usia tahun, syarat melakukan voting, minimum usia 17 tahun atau lebih !"
                        ], 422);
                    }

                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'NIK yang anda masukan tidak terdata sebagai penduduk Aceh Barat Daya'
                    ], 422);
                }
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'KTP tidak sesuai dengan format yang ada !'
            ], $statusCode);
        }
    }


    private function patientRequest($data, $token) {
        $nama = $data['nama'];
        $tanggal = $data['tanggal'];
        $nik = $data['nik'];
        $payload = "?name=$nama&birthdate=$tanggal&identifier=https://fhir.kemkes.go.id/id/nik|$nik";

        return [$statusCode, $response] = $this->oauth2Client->requestSatuSehat($token, 'Patient', $payload);
    }
}
