<?php

namespace App\Services\Event;

/* Models */
use App\Models\Event;

class EventService{

    public static function returnNextEvent(){
        return Event::select('start_date_event')->where('is_active', 1)->whereDate('start_date_event', '>=', date('Y-m-d'))->skip(0)->take(1)->get()->toArray();
    }

    public static function returnEvents($numberOfEvents = 6){
        return Event::where('is_active', 1)->whereDate('end_date_event', '>', date('Y-m-d'))->orderBy('start_date_event', 'ASC')->skip(0)->take($numberOfEvents)->get()->toArray();
    }

    public static function addEvent($data){
        try{
            $event = new Event();
            $event->title_event = $data['titulo_evento'];
            $event->description_event = $data['descricao_evento'];
            $event->start_date_event = $data['inicio_evento'];
            $event->end_date_event = $data['termino_evento'];
            $event->start_hour_event = $data['hora_inicio_evento'];
            $event->end_hour_event =  $data['hora_final_evento'];
            $event->is_active = true;
            $event->dt_datecreated = date_create()->format('Y-m-d H:i:s');
            $event->dt_dateupdated = date_create()->format('Y-m-d H:i:s');
            $event->save();

            return response()->json(['success' => true], 200);

        }catch(\Illuminate\Database\QueryException $e){ 
            return response()->json(['errors' => true, 'message' => 'Algo de errado aconteceu, recarregue a página ou tente novamente em alguns minutos.'], 422);
        }
    }

    public static function returnEventInfoByID($id_event){
        return Event::where('id_event', $id_event)->get()->toArray()[0];
    }

    public static function removeEventByID($id_event){
        Event::where('id_event', $id_event)->update(['is_active' => false]);
    }

    public static function updateEvent($data){
        Event::where('id_event', $data['id_evento'])->update([
            'title_event' => $data['titulo_evento'],
            'description_event' => $data['descricao_evento'],
            'start_date_event' => $data['inicio_evento'],
            'end_date_event' => $data['termino_evento'],
            'start_hour_event' => $data['hora_inicio_evento'],
            'end_hour_event' => $data['hora_final_evento'],
            'dt_dateupdated' => date_create()->format('Y-m-d H:i:s')
        ]);
    }

    /* Help Methods */

    public static function getBrazilianDateFormat($date){
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        if(isset($date[0]['start_date_event'])){
            return strftime('%d de %B', strtotime($date[0]['start_date_event']));
        }else if(!empty($date)){
            return strftime('%d de %B', strtotime($date));
        }else{
            return null;
        }
        
        
    }

}