<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class MonitorController extends Controller
{
    
    
    function __construct() {
        
    }
    
    
    public function index() {
        
    }
    
    public function message(Request $request) {
        
        /***
         * echo '<pre>';
            print_r($request->input());
            echo '</pre>';
            exit();

         */
        
        $message = new \App\Models\MonitorMessages();
        
        $message->source_id = $request->input('id') ;
        // poller
        $message->poller = $request->input('poller');
        // time
        $message->time = $request->input('time');
        //type
        $message->type = $request->input('type');
        //status
        $message->status = $request->input('status');
        //service
        $message->service = $request->input('service');
        //host
        $message->alert_id = $request->input('alert_id');
        //host
        $message->host = $request->input('host');
        //IP
        $message->ip = $request->input('ip');
        
        //output
        $message->out_1 = $request->input('output_1');
        $message->out_2 = $request->input('output_2');
        $message->out_3 = $request->input('output_3');
        
        //thruk link
        $message->thruk_url = $request->input('url_1');
        //sca
        $message->sca_url = $request->input('url_2');
        
        $message->save();
        
    }

   public function message2(Request $request) {
        $message2 = new \App\Models\MonitorMessages();

        //dd($message2->all());
	return View::make('viewdata')->with('itsqd_mon_messages', $message2->all());
   }

}
