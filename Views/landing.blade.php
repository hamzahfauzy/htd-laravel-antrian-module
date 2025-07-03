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
            background-image: url('/modules/antrian/img/welcome-hero.png');
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
                <p>Sistem antrian ini dibuat untuk memudahkan pelayanan antrian pada Mall Pelayanan Public Kabupaten Batubara.</p>

                <button class="btn btn-primary btn-ambil-antrian" data-bs-toggle="modal" data-bs-target="#opdModal">Ambil Antrian</button>
                &nbsp;&nbsp;
                <button class="btn btn-success btn-ambil-antrian" data-bs-toggle="modal" data-bs-target="#boardingModal">Boarding</button>
                {{-- &nbsp;&nbsp;
                <button class="btn btn-success btn-ambil-antrian" onclick="speakNow()" id="btn-panggil">Panggil</button> --}}
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
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=R2qA371F"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.socket.io/4.8.1/socket.io.min.js" integrity="sha384-mkQ3/7FUtcGyoppY6bz/PORYoGqOl7/aSUMn2ymDOJcapfS6PHqxhRTMh1RR0Q6+" crossorigin="anonymous"></script>
    <script>
    responsiveVoice.enableWindowClickHook();
    window.SOCKET_URL  = "{{env('SOCKET_URL', 'http://localhost:3001')}}"; 
    window.SOCKET_PATH = "{{env('SOCKET_PATH', '') . env('SOCKET_IO_PATH', '')}}";
    window.SOCKET_ID   = "caller_device";
    window.calling_queue = []
    window.is_calling = false
    const socket = io(window.SOCKET_URL,{
        path: window.SOCKET_PATH
    });
    socket.on("connect", () => {
    
        socket.emit('subscribe', {userId:window.SOCKET_ID})
    
        socket.on('receive', data => {
            // window.calling_queue.push(data.message)
            // if(responsiveVoice.isPlaying())
            // {
            // }
            // else
            // {
            // }
            calling(data.message)
        })
    });

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

    function calling(text)
    {
        // window.is_calling = true
        responsiveVoice.cancel();
        responsiveVoice.speak(text,'Indonesian Female');
    }

    function voiceStartCallback() {
        console.log("Voice started");
    }

    function voiceEndCallback()
    {
        console.log("Voice Ended");
        window.calling_queue = window.calling_queue.shift()
        if(window.calling_queue.length)
        {
            setTimeout(() => {
                calling(window.calling_queue[0])
            }, 1000);
        }
        else
        {
            window.is_calling = false
        }
    }

    function speakNow() {
      if (!responsiveVoice.voiceSupport()) {
        console.log("Browser tidak mendukung ResponsiveVoice");
        return;
      }

      responsiveVoice.cancel();
      responsiveVoice.speak("Halo, ini pengujian responsive voice", "Indonesian Female", {
        onstart: () => console.log("🔊 Mulai bicara"),
        onend: () => console.log("✅ Bicara selesai"),
        onerror: (err) => console.error("❌ Terjadi error:", err)
      });
    }

    // setTimeout(function(){
    //     document.querySelector('#btn-panggil').click()
    // }, 2000)

    loadOpd()
    </script>
  </body>
</html>