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

/**
$table->increments('message_id');
            $table->string('source_id',30);
            $table->string('alert_id',255)->nullable();
            $table->string('host',100)->nullable();
            $table->string('service',255)->nullable();
            $table->string('time',255)->nullable();
            $table->string('status',255)->nullable();
            $table->string('poller',255)->nullable();
            $table->string('output',255)->nullable();
            $table->string('thruk_url',255)->nullable();
            $table->string('sca_url',255)->nullable();
            $table->string('out_1',255)->nullable();
            $table->string('out_2',255)->nullable();
            $table->string('out_3',255)->nullable();
            $table->string('uid',20)->nullable();
            $table->string('gid',20)->nullable();
            $table->string('flg_stat',10)->nullable();
            $table->timestamps();
            */
