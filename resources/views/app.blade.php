<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ======== Page title ============ -->
    <title>{{ env('APP_NAME') }}</title>
    <!--<< Favicon >>-->
    <link rel="shortcut icon" href="{{ asset('assets') }}/img/favicon.svg">
    <!--<< Bootstrap min.css >>-->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css">
    <!--<< Font Awesome.css >>-->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/font-awesome.css">
    <!--<< Animate.css >>-->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/animate.css">
    <!--<< Magnific Popup.css >>-->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/magnific-popup.css">
    <!--<< MeanMenu.css >>-->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/meanmenu.css">
    <!--<< Swiper Bundle.css >>-->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/swiper-bundle.min.css">
    <!--<< Nice Select.css >>-->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/nice-select.css">
    <!--<< Main.css >>-->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/main.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- CSS untuk styling tambahan -->
    <style>
        .datepicker-dropdown {
            z-index: 2000; /* Menempatkan datepicker di atas elemen lain */
            max-width: 300px; /* Menyesuaikan lebar datepicker */
        }
        .datepicker {
            font-size: 14px; /* Ukuran font untuk datepicker */
        }
    </style>
</head>

<body>

    <!-- Back To Top Start -->
    <div class="scroll-up">
        <svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>


    <header id="header-sticky" class="header-1">
        <div class="container-fluid">
            <div class="mega-menu-wrapper">
                <div class="header-main">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets') }}/img/logo.png" alt="logo-img" class="logo-1">
                        </a>
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets') }}/img/logo-dark.png" alt="logo-img" class="logo-2">
                        </a>
                    </div>
                    <div class="header-left">
                        <div class="mean__menu-wrapper">
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li>
                                            <a href="{{ url('/') }}">Index</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/') }}">Lihat Pooling</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section Start -->
    <section class="hero-section hero-1 bg-cover fix" style="background-image: url('assets/img/hero/01.jpg');">
        <div class="container">
            <div class="row g-4 justify-content-between">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="wow fadeInUp" data-wow-delay=".2s">
                            Survey Elektabilitas <br>
                            Digital Untuk<br> Pemilihan Bupati Dan Calon Wakil Bupati
                        </h1>
                        <div class="hero-button">
                            <a href="#" class="theme-btn hover-white wow fadeInUp" data-wow-delay=".4s">Syarat Dan Kebijakan <i class="far fa-arrow-right"></i></a>
                            <a href="#" class="btn-link wow fadeInUp" data-wow-delay=".6s">Tentang E-Voting <i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInUp" data-wow-delay=".4s">
                    <div class="hero-contact-box">
                        <h4>Form Voting</h4>
                        <p>Sistem akan mendeteksi untuk validasi data lokal aceh barat daya</p>
                        <form id="voteme" class="contact-form-item">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="form-clt">
                                        <input type="text" name="nama" id="nama" placeholder="Nama Lengkap Sesuai KTP" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-clt">
                                        <input type="text" name="nik" id="nik" placeholder="Nomor Induk KTP" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-clt">
                                        <input type="text" class="form-control" id="tanggal" name="tanggal_lahir" placeholder="Pilih tanggal" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <h5>Calon Bupati Aceh Barat Daya</h5>
                                    <div class="form-check">
                                            <input class="form-check-input" type="radio" name="pilihan" id="calon1" value="1" required>
                                            <label class="form-check-label" for="calon1">
                                                Salman Alfarisi ST
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="pilihan" id="calon2" value="2" required>
                                            <label class="form-check-label" for="calon2">
                                                Dr Safaruddin S.Sos., M.SP
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="pilihan" id="calon3" value="3" required>
                                            <label class="form-check-label" for="calon3">
                                                Ir H Jufri Hasanuddin MM
                                            </label>
                                        </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="theme-btn">
                                        Berikan Voting <i class="far fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section Start -->
    <footer class="footer-section footer-bg">
        <div class="container">
            <div class="footer-bottom">
                <div class="container">
                    <div class="footer-wrapper d-flex align-items-center justify-content-between">
                        <ul class="footer-menu wow fadeInUp" data-wow-delay=".2s">
                            <li>
                                <a href="#">
                                    FAQs
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Privacy
                                </a>
                            </li>
                        </ul>
                        <a href="#" id="scrollUp" class="scroll-icon wow fadeInUp" data-wow-delay=".4s">
                            <i class="far fa-angle-double-up"></i>
                        </a>
                        <p class="wow fadeInUp" data-wow-delay=".6s">
                            © <a href="{{ url('/') }}">2024</a> All Rights Reserved
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets') }}/js/jquery-3.7.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.id.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#tanggal').datepicker({
                format: 'dd/mm/yyyy', // Format tanggal diubah menjadi dd/mm/yyyy
                language: 'id', // Bahasa diubah menjadi Indonesia
                todayHighlight: false,
                autoclose: true,
                daysOfWeekShort: ["Minggu","Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"], // Nama hari dalam Bahasa Indonesia
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#voteme').on('submit', function(event) {
                event.preventDefault(); // Menghentikan submit form biasa

                var formData = $(this).serialize(); // Mengambil data formulir dalam bentuk serialized

                // Mengambil CSRF token dari meta tag dalam halaman

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': `{{ csrf_token() }}`
                    }
                });

                $.ajax({
                    url: '{{ route("poll") }}', // Sesuaikan dengan route Laravel Anda
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        if (response.success === true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                            });
                            $('#voteme')[0].reset(); // Mengosongkan formulir setelah berhasil dikirim
                        } else {
                            Swal.fire({
                                icon: 'danger',
                                title: 'Gagal',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseJSON);
                        Swal.fire({
                                icon: 'warning',
                                title: 'Kesalahan',
                                text: xhr.responseJSON.message,
                            });
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets') }}/js/viewport.jquery.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.waypoints.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.counterup.min.js"></script>
    <script src="{{ asset('assets') }}/js/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.meanmenu.min.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('assets') }}/js/wow.min.js"></script>
    <script src="{{ asset('assets') }}/js/main.js"></script>
</body>
</html>
