<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitorController extends Controller
{
    
    
    function __construct() {
        
    }
    
    
    public function index() {
        
    }
    
    public function message(Request $request) {
        
        
        //dd($request->input());
        
        $message = new \App\Models\MonitorMessages();
        
        $message->source_id = $request->input('id') ;
        // poller
        $message->msg_field_1 = $request->input('plr');
        // time
        $message->msg_field_2 = $request->input('t');
        //type
        $message->msg_field_3 = $request->input('tp');
        //status
        $message->msg_field_4 = $request->input('s');
        //service
        $message->msg_field_5 = $request->input('srv');
        //host
        $message->msg_field_6 = $request->input('h');
        //IP
        $message->msg_field_7 = $request->input('ip');
        //group
        $message->msg_field_8 = $request->input('g');
        //ot
        $message->msg_field_9 = $request->input('ot');
        //thruk link
        $message->msg_field_10 = $request->input('th');
        //sca
        $message->msg_field_11 = $request->input('sc');
        
        $message->save();
        
    }
}
