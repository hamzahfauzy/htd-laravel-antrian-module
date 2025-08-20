<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Antrian MPP Batu Bara</title>
  <style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', sans-serif;
}

body {
  background-color: #f0f0f0;
}

header {
  background-color: #0a459e;
  padding: 20px;
  text-align: center;
  color: white;
}

.main-info {
  text-align: center;
  background-color: white;
  padding: 20px;
}

.main-info h2 {
  font-size: 2rem;
  margin-bottom: 10px;
}

.main-info .blue {
  color: #0a459e;
}

.grid-container {
  background-color: #f3c403;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
  padding: 30px;
}

.card {
  background-color: white;
  border-radius: 15px;
  display: flex;
  padding: 15px;
  gap: 15px;
  align-items: center;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.icon {
  width: 50px;
  height: 50px;
  background-color: gray;
  border-radius: 10px;
}

.info p {
  margin: 5px 0;
}

.status {
  background-color: #12b76a;
  color: white;
  font-size: 0.8rem;
  padding: 4px 8px;
  border-radius: 5px;
  margin-left: 10px;
}

  </style>
</head>
<body>
  <header>
    <h1>Data Kunjungan & Pelayanan Loket MPP Kab. Batu Bara</h1>
  </header>

  <section class="main-info">
    <h2>Antrian <span class="blue" id="no-antrian">-</span></h2>
    <p id="nama-loket">-</p>
    <p id="nama-opd">-</p>
  </section>

  <section class="grid-container">
    <!-- 8 Kartu Antrian -->
    <!-- Kamu bisa gunakan loop di JS untuk generate lebih banyak -->
    @foreach ($organizations as $organization)
    <div class="card">
      <div class="icon"></div>
      <div class="info">
        <p><strong>{{$organization->initial_name}} - {{$organization->name}}</strong></p>
        <p id="organization-{{$organization->id}}-status">-</p>
        {{-- <p id="organization-{{$organization->id}}-status">A1-001 <span class="status">Sedang Dilayani</span></p> --}}
      </div>
    </div>
    @endforeach
  </section>
  <script src="https://cdn.socket.io/4.8.1/socket.io.min.js" integrity="sha384-mkQ3/7FUtcGyoppY6bz/PORYoGqOl7/aSUMn2ymDOJcapfS6PHqxhRTMh1RR0Q6+" crossorigin="anonymous"></script>
  <script>
    var offlineCallerId = 0
    var onlineCallerId = 0

    window.SOCKET_URL  = "{{env('SOCKET_URL', 'http://localhost:3001')}}"; 
    window.SOCKET_PATH = "{{env('SOCKET_PATH', '') . env('SOCKET_IO_PATH', '')}}";
    window.SOCKET_ID   = "display_device";
    const socket = io(window.SOCKET_URL,{
        path: window.SOCKET_PATH
    });
    socket.on("connect", () => {
        socket.emit('subscribe', {userId:window.SOCKET_ID})

        socket.on('receive', data => {
          if(data.type == 'send' && data.hasOwnProperty('organization'))
          {
            if(data.hasOwnProperty('action') && data.action == 'clear_display')
            {
              document.querySelector('#organization-'+data.organization.id+'-status').innerHTML = '-'
            }
            else
            {
              document.querySelector('#no-antrian').innerHTML = data.message
              document.querySelector('#nama-loket').innerHTML = data.organization.initial_name
              document.querySelector('#nama-opd').innerHTML = data.organization.name
            }
          }
          // console.log(data)
          // document.querySelector('#nomor_antrian').innerHTML = data.message
        })
    });

    function loadServing()
    {
      fetch('/serving-load')
      .then(res => res.json())
      .then(res => {
        res.data.forEach(data => {
          const label = data.record_status == 'SERVING' ? 'MELAYANI' : data.record_status
          const badge = `<span class="${label == 'MELAYANI' ? 'status' : ''}">${label}</span>`
          document.querySelector('#organization-'+data.organization_id+'-status').innerHTML = data.queue_number + ' ' + badge
        })
      })
    }

    loadServing()

    setInterval(loadServing, 10000)
    </script>
</body>
</html>
