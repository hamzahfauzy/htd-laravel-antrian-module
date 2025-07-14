@extends('antrian::layouts')

@section('content')

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

                    <div class="row" id="loket-opd">
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
                                <h1 class="fs-1 fw-bold stats-value" id="jumlah_loket">20</h1>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div
                                class="card card-body align-items-center justify-content-center rounded-5"
                                style="min-height: 250px;">
                                <h6 class="fs-6">Jumlah Layanan</h6>
                                <h1 class="fs-1 fw-bold stats-value" id="jumlah_layanan">20</h1>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div
                                class="card card-body align-items-center justify-content-center rounded-5"
                                style="min-height: 250px;">
                                <h6 class="fs-6">Total Kunjungan Terlayani</h6>
                                <h1 class="fs-1 fw-bold stats-value" id="jumlah_kunjungan_terlayani">20</h1>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div
                                class="card card-body align-items-center justify-content-center rounded-5"
                                style="min-height: 250px;">
                                <h6 class="fs-6">Kunjungan Hari Ini</h6>
                                <h1 class="fs-1 fw-bold stats-value" id="kunjungan_hari_ini">20</h1>
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
                                class="card rounded-top-0 rounded-bottom-4 rounded-end-4" >

                                <div id="posts"></div>

                                <div
                                    class="bg-body-secondary text-end p-3 rounded-bottom-4">
                                    <a href="berita"
                                        class="text-black font-normal">Selengkapnya</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

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
@endsection

@section('scripts')


        <script>

            loadPosts()
            loadStatistics()

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

            function loadPosts()
            {
                fetch('/get-posts')
                    .then(res => res.json())
                    .then(res => {
                        res.data.forEach(post=>{
                            document.querySelector('#posts').innerHTML += ` <div
                                    class="d-flex flex-column flex-md-row gap-3 align-items-start align-items-md-center p-3 border-bottom">
                                    <img src="${post.thumbnail ? "storage/"+post.thumbnail.filename : 'https://placehold.co/600x400'}"
                                        width="200"
                                        class="rounded-5 img-fluid"
                                        alt="placeholder">
                                    <div>
                                        <a href="berita/${post.slug}" class="text-reset link-underline link-underline-opacity-0">
                                            <h5>${post.title}</h5>
                                        </a>
                                        <p
                                            class="card-text text-body-secondary">${post.created_at}</p>
                                    </div>
                                </div>`
                        })
                    })
            }

            function loadStatistics()
            {
                fetch('/get-statistics')
                    .then(res => res.json())
                    .then(res => {
                        console.log(res)

                        
                        res.data.opd.forEach(opd=>{
                            document.querySelector('#loket-opd').innerHTML += `
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="https://placehold.co/600x400"
                                        class="card-img-top" alt="placeholder">
                                    <div class="card-body">
                                        <h6 class="card-title">${opd.name}</h6>
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
                            </div>`
                        })

                        document.querySelector('#jumlah_loket').innerHTML = res.data.opd.length
                        document.querySelector('#jumlah_layanan').innerHTML = res.data.opd.length
                        document.querySelector('#jumlah_kunjungan_terlayani').innerHTML = res.data.antrianFinish
                        document.querySelector('#kunjungan_hari_ini').innerHTML = res.data.kunjunganToday
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

@endsection