<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>@yield('title', 'Antrian')</title>
    <style>
        body {
            background-image: url('/modules/antrian/img/home-bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1;
        }

        .content {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center; /*centers items on the line (the x-axis by default)*/
            align-items: center;
            height: 100%;
        }

        .content h1, .content p {
            color: #FFF;
        }

        .content p {
            font-size: 24px;
        }

        .btn-ambil-antrian {
            font-size: 48px;
        }

        .opd-list {
            display: flex;
            gap:10px;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .opd-list .card {
            flex: 0 0 calc(33% - 5px);
            justify-content: center; /*centers items on the line (the x-axis by default)*/
            align-items: center;
        }
        .opd-list .card .card-body {
            width: 100%;
            flex: 0;
            
        }
        .boarding-code {
            font-size: 32px;
        }
    </style>
  </head>
  <body>
    <!-- Optional JavaScript; choose one of the two! -->
    <div class="overlay"></div>

    <section class="content">
        <div class="container">
            <div class="text-center">
                <img src="{{config('app.logo')}}" alt="" height="200px">
    
                <h1 class="app-name">Selamat Datang di Sistem {{config('app.name')}}</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque culpa distinctio sapiente, rerum quo maxime quos. Nobis est vero dolorem accusamus, inventore quisquam quam minima dicta et aspernatur numquam eveniet.</p>

                <button class="btn btn-success btn-ambil-antrian" data-bs-toggle="modal" data-bs-target="#boardingModal">Reservasi Disini</button>
            </div>
        </div>
    </section>

    <div class="modal fade" id="boardingModal" aria-hidden="true" aria-labelledby="boardingModalLabel" tabindex="-1">
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
                        <label for="">Nama</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">No HP</label>
                        <input type="tel" class="form-control" id="phone">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">OPD / Layanan Tujuan</label>
                        <select name="" id="organization_id" class="form-control opd-list">
                            <option value="">Pilih</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary" onclick="reservation()">Buat Reservasi</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="reservationModal" aria-hidden="true" aria-labelledby="reservationModalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reservationModalLabel">Form Reservasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body reservation-content">
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
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
                document.querySelector('.reservation-content').innerHTML = `<h2>Kode Reservasi Anda : ${res.data.code}</h2>`

                var boardingModal = new bootstrap.Modal(document.getElementById('boardingModal'))
                boardingModal.hide()

                setTimeout(() => {
                    var reservationModal = new bootstrap.Modal(document.getElementById('reservationModal'))
                    reservationModal.show()
                }, 500);
                
            })
    }

    </script>
  </body>
</html>