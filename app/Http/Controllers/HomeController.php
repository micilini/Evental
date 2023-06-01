<?php

namespace App\Http\Controllers;

/* Requests */
use App\Http\Requests\SeeEventRequest;
use App\Http\Requests\NewEventRequest;
use App\Http\Requests\EditEventRequest;

/* Services */
Use App\Services\Event\EventService;

class HomeController extends Controller{

    protected $ajaxURL_See = '/data/seeEvent';
    protected $ajaxURL_Add = '/data/addEvent';
    protected $ajaxURL_Edit = '/data/updateEvent';
    protected $ajaxURL_Remove = '/data/removeEvent';

    /* GET ROUTES */
    
    public function home(){
        return view('dashboard/home', ['ajaxURL_See' => $this->ajaxURL_See, 'ajaxURL_Add' => $this->ajaxURL_Add, 'ajaxURL_Edit' => $this->ajaxURL_Edit, 'ajaxURL_Remove' => $this->ajaxURL_Remove, 'nextEvent' => EventService::getBrazilianDateFormat(EventService::returnNextEvent()), 'events' => EventService::returnEvents()]);
    }

    /* POST ROUTES */

    public function seeEvent(SeeEventRequest $request){
        $validated = $request->validated();
        return response()->json(['success' => true, 'infoEvent' => EventService::returnEventInfoByID($validated['id_event'])], 200);
    }

    public function addEvent(NewEventRequest $request){
        $validated = $request->validated();
        return EventService::addEvent($validated);
    }

    public function updateEvent(EditEventRequest $request){
        $validated = $request->validated();
        EventService::updateEvent($validated);
        return response()->json(['success' => true], 200);
    }

    public function removeEvent(SeeEventRequest $request){
        $validated = $request->validated();
        EventService::removeEventByID($validated['id_event']);
        return response()->json(['success' => true], 200);
    }

}
