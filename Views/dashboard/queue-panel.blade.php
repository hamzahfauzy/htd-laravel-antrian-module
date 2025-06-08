@if(\App\Modules\Antrian\Libraries\Utility::getUserOrganization(auth()->user()))
<div class="container p-0">
    <div class="row">
        <div class="col-12 text-center">
            <h2 id="organization_name">{{\App\Modules\Antrian\Libraries\Utility::getUserOrganization(auth()->user())?->organization?->name}}</h2>
            <div class="d-none" id="pos_number">{{\App\Modules\Antrian\Libraries\Utility::getUserOrganization(auth()->user())?->organization?->pos_number}}</div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h3>Sekarang</h3>
                    <h1 style="font-size: 82px" id="now-serve">000</h1>
                    <button class="btn btn-info" id="btn-serving" style="display: none" onclick="doServing()">Layani</button>
                    <button class="btn btn-warning" id="btn-next" style="display: none" onclick="skipQueue()">Lewati</button>
                    <button class="btn btn-danger" id="btn-done" style="display: none" onclick="done()">Selesai</button>
                    <!--
                    <button class="btn btn-success" id="btn-call">Panggil</button>
                    -->
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>Antrian Offline</h3>

                    <button class="btn btn-success w-100" id="offline-caller" onclick="caller('offline')">Panggil</button>

                    <table class="table table-striped" id="offline-queue">
                        <thead>
                            <tr>
                                <th>No Antrian</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>Antrian Online</h3>

                    <button class="btn btn-success w-100" id="online-caller" onclick="caller('online')">Panggil</button>

                    <table class="table table-striped" id="online-queue">
                        <thead>
                            <tr>
                                <th>No Antrian</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <h3>Panggilan</h3>
                    <table class="table table-striped" id="caller-queue">
                        <thead>
                            <tr>
                                <th>No Antrian</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.socket.io/4.8.1/socket.io.min.js" integrity="sha384-mkQ3/7FUtcGyoppY6bz/PORYoGqOl7/aSUMn2ymDOJcapfS6PHqxhRTMh1RR0Q6+" crossorigin="anonymous"></script>
<script>
var offlineCallerId = 0
var onlineCallerId = 0

window.SOCKET_URL  = "{{env('SOCKET_URL', 'http://localhost:3001')}}"; 
window.SOCKET_PATH = "{{env('SOCKET_PATH', '') . env('SOCKET_IO_PATH', '')}}";
window.SOCKET_ID   = "{{auth()->id()}}";
window.calling_queue = []
const socket = io(window.SOCKET_URL,{
    path: window.SOCKET_PATH
});
socket.on("connect", () => {
    socket.emit('subscribe', {userId:window.SOCKET_ID})
});

function loadQueue(type, target)
{
    fetch('/load-queue/'+type)
        .then(res => res.json())
        .then(res => {
            document.querySelector(target + ' tbody').innerHTML = ''
            res.data.forEach(queue => {
                document.querySelector(target + ' tbody').innerHTML += `<tr data-status="${queue.record_status}" data-number="${queue.queue_number}" data-id="${queue.id}" data-organization="${queue.organization_id}"><td>${queue.queue_number}</td><td>${queue.record_status}</td></tr>`
            })
        })
}

function caller(type)
{
    const selectedRow = document.querySelector('#'+type+'-queue tbody tr[data-status="ON QUEUE"]')
    if(!selectedRow)
    {
        document.querySelector('#now-serve').innerHTML = '000'
        document.querySelector('#btn-serving').style.display = 'none'
        document.querySelector('#btn-next').style.display = 'none'

        socket.emit('send', {
            target: 'display-'+window.SOCKET_ID,
            message: '-'
        })
        
        return
    }
    const queueNumber = selectedRow.dataset.number
    if(type == 'offline')
    {
        offlineCallerId = selectedRow.dataset.id
        onlineCallerId = 0
    }
    if(type == 'online')
    {
        offlineCallerId = 0
        onlineCallerId = selectedRow.dataset.id
    }
    document.querySelector('#now-serve').innerHTML = queueNumber
    document.querySelector('#btn-serving').style.display = 'inline'
    document.querySelector('#btn-next').style.display = 'inline'

    socket.emit('send', {
        target:'caller_device',
        message: 'Antrian dengan nomor ' + queueNumber + ' agar segera menuju ke loket ' + document.querySelector('#pos_number').innerHTML
    })

    socket.emit('send', {
        target: 'display-'+window.SOCKET_ID,
        message: queueNumber
    })
}

function skipQueue()
{
    if(!offlineCallerId && !onlineCallerId)
    {
        return
    }

    fetch('/skip-queue/'+(offlineCallerId ? offlineCallerId : onlineCallerId))
    const target = (offlineCallerId ? 'offline' : 'online')
    loadQueue(target.toUpperCase(),'#'+target+'-queue')
    setTimeout(() => {
        caller(target)
    }, 1000);
}

function doServing()
{
    if(!offlineCallerId && !onlineCallerId)
    {
        return
    }

    fetch('/serve-queue/'+(offlineCallerId ? offlineCallerId : onlineCallerId))
    const target = (offlineCallerId ? 'offline' : 'online')
    loadQueue(target.toUpperCase(),'#'+target+'-queue')

    document.querySelector('#btn-serving').style.display = 'none'
    document.querySelector('#btn-next').style.display = 'none'
    document.querySelector('#btn-done').style.display = 'inline'
}

function loadServing()
{
    var type = 'offline'
    var selectedRow = document.querySelector('#offline-queue tbody tr[data-status="SERVING"]')
    if(!selectedRow)
    {
        type = 'online'
        selectedRow = document.querySelector('#online-queue tbody tr[data-status="SERVING"]')
    }

    if(selectedRow)
    {
        console.log('load serving')
        const queueNumber = selectedRow.dataset.number
        if(type == 'offline')
        {
            offlineCallerId = selectedRow.dataset.id
            onlineCallerId = 0
        }
        if(type == 'online')
        {
            offlineCallerId = 0
            onlineCallerId = selectedRow.dataset.id
        }

        document.querySelector('#now-serve').innerHTML = queueNumber
        document.querySelector('#btn-done').style.display = 'inline'
    }
}

function done()
{
    fetch('/done-queue/'+(offlineCallerId ? offlineCallerId : onlineCallerId))
    const target = (offlineCallerId ? 'offline' : 'online')
    loadQueue(target.toUpperCase(),'#'+target+'-queue')
    document.querySelector('#btn-done').style.display = 'none'

    setTimeout(() => {
        caller(target)
    }, 1000);
}

loadQueue('ONLINE','#online-queue')
loadQueue('OFFLINE','#offline-queue')

setTimeout(() => {
    loadServing()
}, 2000);

setInterval(function(){
    loadQueue('ONLINE','#online-queue')
    loadQueue('OFFLINE','#offline-queue')
}, 10000)
</script>
@endif