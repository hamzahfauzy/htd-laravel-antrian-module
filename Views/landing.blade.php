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

                <button class="btn btn-primary btn-ambil-antrian" data-bs-toggle="modal" data-bs-target="#opdModal">Ambil Antrian</button>
                &nbsp;&nbsp;
                <button class="btn btn-success btn-ambil-antrian" data-bs-toggle="modal" data-bs-target="#boardingModal">Boarding</button>
            </div>
        </div>
    </section>

    <!-- Full screen modal -->
    <div class="modal fade" id="opdModal" aria-hidden="true" aria-labelledby="opdModalLabel" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="opdModalLabel">Pilih OPD / Urusan yang ingin Anda tuju</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body opd-list">
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="boardingModal" aria-hidden="true" aria-labelledby="boardingModalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="boardingModalLabel">Masukkan Kode Reservasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="text" class="form-control boarding-code" id="boarding_code" placeholder="Masukkan kode reservasi di sini..." autofocus>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary btn-lg" onclick="doBoarding()">Boarding</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
    function loadOpd()
    {
        fetch('/working-opd')
            .then(res => res.json())
            .then(res => {
                res.data.forEach(opd => {
                    document.querySelector('.opd-list').innerHTML += `<div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">${opd.name}</h5>
                            <p class="card-text">${opd.initial_name}</p>
                            <button onclick="takeQueue(${opd.id})" class="btn btn-primary w-100">Ambil Antrian</button>
                        </div>
                    </div>`
                })
            })
    }

    function takeQueue(opdId)
    {
        fetch('/take-queue/' + opdId)
            .then(res => res.json())
            .then(res => {
                const formData = new FormData;
                formData.append('nomor', res.data.nomor)
                formData.append('nama_opd', res.data.organization.name)
                fetch('http://localhost:8080', {
                    method: 'POST',
                    body: formData
                })
            })
    }
    
    function doBoarding()
    {
        const formData = new FormData;
        formData.append('_token', document.querySelector('[name="_token"]').value)
        formData.append('code', document.querySelector('#boarding_code').value)
        fetch('/boarding', {
            method: 'POST',
            body: formData
        })
            .then(res => res.json())
            .then(res => {
                if(res.message == 'code is invalid')
                {
                    alert('Kode Reservasi tidak valid')
                    document.querySelector('#boarding_code').value = ''
                    return
                }
                const formData = new FormData;
                formData.append('nomor', res.data.nomor)
                formData.append('nama_opd', res.data.organization.name)
                fetch('http://localhost:8080', {
                    method: 'POST',
                    body: formData
                })
            }).catch(err => {
                console.log(err)
            })
    }

    loadOpd()
    </script>
  </body>
</html>