<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
            crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="https://dpm-ptsp.batubarakab.go.id/asset/img/icon.png" type="image/x-icon">
        <style>
            * {
                font-family: "Montserrat", sans-serif;
                font-optical-sizing: auto;
            }
            .stats-value {
                font-size: 72px !important;
            }
            li.nav-item .nav-link {
                /* padding-left: 1rem !important;
                padding-right: 1rem !important; */
                padding:0px !important;
            }
            .navbar-nav {
                gap:20px;
            }
            .hero {
                position: relative;
                height: 450px;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
                background-image: url({{asset('modules/antrian/img/welcome-hero.png')}});
            }
            .hero-content {
                width: 100%;
                position: absolute;
                left: 50%;
                top: 50%;
                -webkit-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
                color: #FFF;
            }
            .hero-overlay {
                background-color: #3498db;
                height: 450px;
                width: 100%;
                position: absolute;
                top: 0;
                opacity: 0.8;
            }
            @media screen and (max-width: 575px) {
                .hero-container {
                    padding-left: 0 !important;
                    padding-right: 0 !important;
                }
            }
        </style>
    </head>
    <body>

        <header class="sticky-top">
            <nav class="navbar navbar-expand-lg bg-white py-2 fw-bold">
                <div class="container">
                    <a class="navbar-brand" href="/">
                        <img src="{{asset('modules/antrian/img/logo.png')}}" alt="" height="58px">
                    </a>
                    <button class="navbar-toggler" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarText"
                        aria-controls="navbarText" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse text-uppercase"
                        id="navbarText">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#antrian">Antrian Online</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#loket">Loket Pelayanan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Kontak</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('login')}}">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            <div class="py-5 bg-white">
                <div class="container py-4">
                    <div class="row">
                        <div class="col-md-4 d-flex align-items-center mb-3">
                            <img src="{{asset('modules/antrian/img/logo.png')}}" alt="" style="max-width:200px">
                        </div>
                        <div class="col-md-4 mb-3">
                            <div>
                                <h5>Alamat</h5>
                                <p class="m-0">Jalan Perintis Kemerdekaan, No.
                                    55, Kec.
                                    Lima Puluh, Kabupaten Batu Bara,
                                    Sumatera Utara 212255</p>
                            </div>
                            <div class="mt-3">
                                <h5>Hubungi Kami</h5>
                                <p class="m-0">0821-7377-9427</p>
                                <p class="m-0">dpmptsp@batubarakab.go.id</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d995.9276915444756!2d99.41782205919361!3d3.1706634790812975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3033cf9b53a43915%3A0x584cbd1387efd3d8!2sDinas%20Penanaman%20Modal%20Dan%20Pelayanan%20Perizinan%20Terpadu!5e0!3m2!1sen!2sid!4v1750744439856!5m2!1sen!2sid"
                                width="100%" height="100%" style="border:0;"
                                class="rounded-4"
                                allowfullscreen loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center bg-body-secondary py-3">
                <p class="m-0">©
                    <script>document.write(new Date().getFullYear())</script>
                    DPMPTSP Kab. Batu Bara</p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        @yield('scripts')
    </body>
</html>