<?php

namespace App\Modules\Antrian\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Antrian\Libraries\Utility;
use App\Modules\Antrian\Models\Organization;
use App\Modules\Antrian\Models\QueueList;
use App\Modules\Antrian\Models\Reservation;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function welcome()
    {
        return view('antrian::index');
    }

    public function index($type)
    {
        $date = now()->format('Y-m-d');
        $organization = Utility::getUserOrganization(auth()->user());
        $queues = QueueList::where('organization_id', $organization->organization_id)->where('record_type',$type)->where('created_at','LIKE',"%$date%")->get();

        return response()->json([
            'message' => 'queue retrieved',
            'data' => $queues,
        ]);
    }

    public function getOpd()
    {
        $currentDay = \Carbon\Carbon::createFromDate(request('date', now()))->format('N');
        $organizations = Organization::whereHas('shifts', function($query) use ($currentDay){
            $query->where('active_day', $currentDay);
        })->get();

        return response()->json([
            'message' => 'opd retrieved',
            'data' => $organizations
        ]);
    }

    public function take($organization_id)
    {
        $date = now()->format('Y-m-d');
        $queue = QueueList::where('organization_id', $organization_id)->where('record_type','OFFLINE')->where('created_at','LIKE',"%$date%")->latest()->first();
        $organization = Organization::where('id', $organization_id)->first();
        $nextQueueNumber = $queue?->queue_number ? ((int) filter_var(str_replace($organization->initial_name.'-','',$queue->queue_number), FILTER_SANITIZE_NUMBER_INT))+1 : 1;

        $queue = QueueList::create([
            'organization_id' => $organization_id,
            'queue_number' => $organization->initial_name . '-'. str_pad($nextQueueNumber, 3, '0', STR_PAD_LEFT),
            'record_type' => 'OFFLINE',
            'record_status' => 'ON QUEUE',
        ]);

        $queue->organization;
        $queue->nomor = $queue->queue_number;

        return response()->json([
            'message' => 'queue success',
            'data' => $queue
        ]);
    }

    public function reservation(Request $request)
    {
        // check reservation limit
        $organization = Organization::where('id',$request->organization_id)->first();
        $reservations = Reservation::where('organization_id', $organization->id)->where('date', $request->date)->count();
        if($organization->queue_limit == $reservations)
        {
            return response()->json([
                'message' => 'reservation fail'
            ], 400);
        }
        
        $request->merge([
            'code' => strtoupper(substr(md5(now() . $request->organization_id), 0, 6)),
            'record_type' => 'ONLINE',
            'record_status' => 'RESERVATION',
        ]);

        $reservation = Reservation::create($request->all());

        return response()->json([
            'message' => 'reservation success',
            'data' => $reservation
        ]);
    }

    public function boarding(Request $request)
    {
        $reservation = Reservation::where('code', $request->code)->where('record_status','RESERVATION')->first();
        if(!$reservation)
        {
            return response()->json([
                'message' => 'code is invalid'
            ], 400);
        }

        $date = now()->format('Y-m-d');
        $queue = QueueList::where('organization_id', $reservation->organization_id)->where('record_type','ONLINE')->where('created_at','LIKE',"%$date%")->latest()->first();
        $organization = $reservation->organization;
        $nextQueueNumber = $queue?->queue_number ? ((int) filter_var(str_replace($organization->initial_name.'-','',$queue->queue_number), FILTER_SANITIZE_NUMBER_INT))+1 : 1;

        $queue = QueueList::create([
            'organization_id' => $reservation->organization_id,
            'queue_number' => $organization->initial_name.'-O.'.str_pad($nextQueueNumber, 3, '0', STR_PAD_LEFT),
            'record_type' => 'ONLINE',
            'record_status' => 'ON QUEUE',
        ]);

        $reservation->update([
            'record_status' => 'BOARDING',
            'list_id' => $queue->id,
        ]);

        $queue->organization;
        $queue->nomor = $queue->queue_number;

        return response()->json([
            'message' => 'queue success',
            'data' => $queue
        ]);
    }

    public function skipQueue($id)
    {
        QueueList::where('id', $id)->update([
            'record_status' => 'SKIP'
        ]);
    }
    
    public function serveQueue($id)
    {
        QueueList::where('id', $id)->update([
            'record_status' => 'SERVING'
        ]);
    }
    
    public function doneQueue($id)
    {
        QueueList::where('id', $id)->update([
            'record_status' => 'DONE'
        ]);
    }

    public function queueDisplay()
    {
        return view('antrian::queue-display');
    }
}