<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineVotePerson extends Model
{
    use HasFactory;

    protected $table = 'online_vote_person';

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'nik',
        'ip',
        'user_agent',
        'pilihan',
    ];
}
