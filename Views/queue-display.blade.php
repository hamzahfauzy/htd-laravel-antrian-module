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

        .content h1 {
            font-size: 72px;
        }

        .content h1, .content p {
            color: #FFF;
        }

        .content p {
            font-size: 24px;
        }

        .content-antrian {
            min-width: 500px;
            min-height: 300px;
            background: #FFF;
            border-radius: 1rem;
            margin:auto;
            padding:24px;
        }

        .content-antrian p {
            color:#000;
            margin: 0;
            font-size: 62px;
            line-height: 1;
        }

        .content-antrian h2 {
            line-height: 120px;
            font-size: 150px;
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
    
                <h1 id="organization_name">{{\App\Modules\Antrian\Libraries\Utility::getUserOrganization(auth()->user())?->organization?->name}}</h1>

                <div class="content-antrian">
                    <p>Nomor Antrian Sekarang</p>
                    <h2 id="nomor_antrian">000-000</h2>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.socket.io/4.8.1/socket.io.min.js" integrity="sha384-mkQ3/7FUtcGyoppY6bz/PORYoGqOl7/aSUMn2ymDOJcapfS6PHqxhRTMh1RR0Q6+" crossorigin="anonymous"></script>
    <script>
    var offlineCallerId = 0
    var onlineCallerId = 0

    window.SOCKET_URL  = "{{env('SOCKET_URL', 'http://localhost:3001')}}"; 
    window.SOCKET_PATH = "{{env('SOCKET_PATH', '') . env('SOCKET_IO_PATH', '')}}";
    window.SOCKET_ID   = "display-{{auth()->id()}}";
    const socket = io(window.SOCKET_URL,{
        path: window.SOCKET_PATH
    });
    socket.on("connect", () => {
        socket.emit('subscribe', {userId:window.SOCKET_ID})

        socket.on('receive', data => {
            document.querySelector('#nomor_antrian').innerHTML = data.message
        })
    });
    </script>
  </body>
  </html>