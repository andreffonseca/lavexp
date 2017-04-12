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
        
        
        echo '<pre>';
        print_r($request->input());
        echo '</pre>';
        exit();
        
        $message = new \App\Models\MonitorMessages();
        
        $message->source_id = $request->input('id') ;
        // poller
        $message->poller = $request->input('plr');
        // time
        $message->time = $request->input('t');
        //type
        //$message->type = $request->input('tp');
        //status
        $message->status = $request->input('s');
        //service
        $message->service = $request->input('srv');
        //host
        $message->host = $request->input('h');
        //IP
        //$message->ip = $request->input('ip');
        //group
        //output
        $message->out_1 = $request->input('ot1');
        $message->out_2 = $request->input('ot2');
        $message->out_3 = $request->input('ot3');
        //thruk link
        $message->thruk_url = $request->input('th');
        //sca
        $message->sca_url = $request->input('sc');
        
        $message->save();
        
    }
}