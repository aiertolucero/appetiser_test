<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\EventDetails;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    public function index(){
    	return view('event_generator');
    }

    public function saveEvent(Request $request){
	    try {
		    DB::beginTransaction();

	    	$event = new Event;
	        $event->name = $request->eventName;
	        $event->save();
	        $eventId = $event->id;

	        foreach ($request->dates as $date) {
		    	$eventDetails = new EventDetails;
		        $eventDetails->date = $date;
		        $eventDetails->event_id = $eventId;
		        $eventDetails->save();
	        }

		    DB::commit();
		} catch(\Exception $e){       
		    DB::rollback();

        	return response()->json([
    			'success' => false
    		]);
		}

    	return response()->json([
    		'success' => true,
    		'data' => ['event_name' => $event->name, 'event_id' => $eventId]
    	]);
    }

    public function getEvents(){
    	return Event::all()
    		->map(function ($events){
    			return [
		    		'event_name' => $events->name,
		    		'event_id'   => $events->id
		    	];
    		});
    }
}
