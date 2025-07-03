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
                    <a class="navbar-brand" href="#">
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
                                <a class="nav-link" href="#">Galeri</a>
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
            <div class="bg-body-secondary">
                <div class="container hero-container">
                    <div class="hero">
                        <div class="hero-overlay"></div>
                        <div class="hero-content text-center">
                            <h1 class="display-6 fw-bold">Selamat Datang <br> di Portal MPP Kab. Batu Bara</h1>
                            <p class="fs-4">Satu Tempat, Semua Urusan - Lebih Dekat, Lebih Cepat</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-5 bg-white" id="antrian">
                <div class="container py-4 text-center">
                    <h2 class="fs-2 fw-bold">Tidak Mau Nunggu Lama ? <br> Yuk Ambil Antrian</h2>

                    <button class="btn btn-warning mt-3 btn-lg text-uppercase fw-medium" data-bs-toggle="modal" data-bs-target="#boardingModal">Ambil Antrian Online</button>
                </div>
            </div>
            <div class="py-5 bg-body-secondary" id="loket">
                <div class="container py-4">
                    <h2 class="fs-2 fw-bold mb-3">Loket Layanan OPD</h2>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="https://placehold.co/600x400"
                                    class="card-img-top" alt="placeholder">
                                <div class="card-body">
                                    <h6 class="card-title">DPMPTSP KAB.
                                        BATUBARA</h6>
                                    <p class="card-text fw-medium">Loket A -
                                        Senin
                                        s.d
                                        Jum'at</p>
                                    <p class="card-text">
                                        <ul>
                                            <li>Pelayanan Perizina</li>
                                            <li>Pelayanan Non Perizinan</li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="https://placehold.co/600x400"
                                    class="card-img-top" alt="placeholder">
                                <div class="card-body">
                                    <h6 class="card-title">DPMPTSP KAB.
                                        BATUBARA</h6>
                                    <p class="card-text fw-medium">Loket A -
                                        Senin
                                        s.d
                                        Jum'at</p>
                                    <p class="card-text">
                                        <ul>
                                            <li>Pelayanan Perizina</li>
                                            <li>Pelayanan Non Perizinan</li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="https://placehold.co/600x400"
                                    class="card-img-top" alt="placeholder">
                                <div class="card-body">
                                    <h6 class="card-title">DPMPTSP KAB.
                                        BATUBARA</h6>
                                    <p class="card-text fw-medium">Loket A -
                                        Senin
                                        s.d
                                        Jum'at</p>
                                    <p class="card-text">
                                        <ul>
                                            <li>Pelayanan Perizina</li>
                                            <li>Pelayanan Non Perizinan</li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="https://placehold.co/600x400"
                                    class="card-img-top" alt="placeholder">
                                <div class="card-body">
                                    <h6 class="card-title">DPMPTSP KAB.
                                        BATUBARA</h6>
                                    <p class="card-text fw-medium">Loket A -
                                        Senin
                                        s.d
                                        Jum'at</p>
                                    <p class="card-text">
                                        <ul>
                                            <li>Pelayanan Perizina</li>
                                            <li>Pelayanan Non Perizinan</li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="py-5 bg-info text-uppercase text-center">
                <div class="container py-4">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div
                                class="card card-body align-items-center justify-content-center rounded-5"
                                style="min-height: 250px;">
                                <h6 class="fs-6">Jumlah Loket</h6>
                                <h1 class="fs-1 fw-bold stats-value">20</h1>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div
                                class="card card-body align-items-center justify-content-center rounded-5"
                                style="min-height: 250px;">
                                <h6 class="fs-6">Jumlah Layanan</h6>
                                <h1 class="fs-1 fw-bold stats-value">20</h1>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div
                                class="card card-body align-items-center justify-content-center rounded-5"
                                style="min-height: 250px;">
                                <h6 class="fs-6">Total Kunjungan Terlayani</h6>
                                <h1 class="fs-1 fw-bold stats-value">20</h1>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div
                                class="card card-body align-items-center justify-content-center rounded-5"
                                style="min-height: 250px;">
                                <h6 class="fs-6">Kunjungan Hari Ini</h6>
                                <h1 class="fs-1 fw-bold stats-value">20</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-5 bg-body-secondary">
                <div class="container py-4">
                    <h2
                        class="fs-2 fw-bold py-3 px-5 bg-white m-0 rounded-top-4 border"
                        style="width: fit-content;">Berita</h2>

                    <div class="row">
                        <div class="col-12">
                            <div
                                class="card rounded-top-0 rounded-bottom-4 rounded-end-4">
                                <div
                                    class="d-flex flex-column flex-md-row gap-3 align-items-start align-items-md-center p-3 border-bottom">
                                    <img src="https://placehold.co/600x400"
                                        width="200"
                                        class="rounded-5 img-fluid"
                                        alt="placeholder">
                                    <div>
                                        <h5>Layanan
                                            Contact Center Libur Hari Raya
                                            Nyepi dan Hari Raya Idul
                                            Fitri 1446 H</h5>
                                        <p
                                            class="card-text text-body-secondary">26-03-2025</p>
                                    </div>
                                </div>
                                <div
                                    class="d-flex flex-column flex-md-row gap-3 align-items-start align-items-md-center p-3 border-bottom">
                                    <img src="https://placehold.co/600x400"
                                        width="200"
                                        class="rounded-5 img-fluid"
                                        alt="placeholder">
                                    <div>
                                        <h5>Layanan
                                            Contact Center Libur Hari Raya
                                            Nyepi dan Hari Raya Idul
                                            Fitri 1446 H</h5>
                                        <p
                                            class="card-text text-body-secondary">26-03-2025</p>
                                    </div>
                                </div>

                                <div
                                    class="bg-body-secondary text-end p-3 rounded-bottom-4">
                                    <a href
                                        class="text-black font-normal">Selengkapnya</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
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

        <div class="modal fade" id="boardingModal" aria-labelledby="boardingModalLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="boardingModalLabel">Form Reservasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">Tanggal Reservasi</label>
                            <input type="date" class="form-control" id="date" onchange="loadOpd()" min="{{strtotime('now') < strtotime(date('Y-m-d 17:00:00')) ? date('Y-m-d') : date('Y-m-d', strtotime('now +1d'))}}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">OPD / Layanan Tujuan</label>
                            <select name="" id="organization_id" class="form-control opd-list">
                                <option value="">Pilih</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">No HP</label>
                            <input type="tel" class="form-control" id="phone">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" onclick="reservation()">Buat Reservasi</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="reservationModal" aria-labelledby="reservationModalLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reservationModalLabel">Form Reservasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <h2>Kode Reservasi Anda:</h2>
                        <h1 class="reservation-content"></h1>
                        <p>Silahkan salin kode ini dan gunakan pada saat boarding di Mall Pelayanan Publik</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <script>
            function loadOpd()
            {
                const date = document.querySelector('#date').value
                fetch('/working-opd?date='+date)
                    .then(res => res.json())
                    .then(res => {
                        document.querySelector('.opd-list').innerHTML = `<option value="">Pilih</option>`
                        res.data.forEach(opd => {
                            document.querySelector('.opd-list').innerHTML += `<option value="${opd.id}">${opd.name}</option>`
                        })
                    })
            }

            function reservation()
            {
                const data = {
                    name: document.querySelector('#name').value,
                    phone: document.querySelector('#phone').value,
                    date: document.querySelector('#date').value,
                    organization_id: document.querySelector('#organization_id').value,
                }

                if(!data.name || !data.phone || !data.date || !data.organization_id)
                {
                    alert('Form tidak boleh kosong')
                    return
                }

                const formData = new FormData;
                formData.append('_token', document.querySelector('[name="_token"]').value)
                formData.append('name', data.name)
                formData.append('phone', data.phone)
                formData.append('date', data.date)
                formData.append('organization_id', data.organization_id)
                fetch('/reservation', {
                    method: 'POST',
                    body: formData
                })
                    .then(res => res.json())
                    .then(res => {
                        if(res.message == 'reservation fail')
                        {
                            alert('Reservasi gagal karena sudah mencapai limit')
                            return
                        }
                        document.querySelector('#name').value = ''
                        document.querySelector('#phone').value = ''
                        document.querySelector('#date').value = ''
                        document.querySelector('#organization_id').value = ''
                        document.querySelector('.reservation-content').innerHTML = res.data.code

                        var reservationModal = new bootstrap.Modal(document.getElementById('reservationModal'))
                        reservationModal.show()
                        
                    })
            }
        </script>
    </body>
</html>