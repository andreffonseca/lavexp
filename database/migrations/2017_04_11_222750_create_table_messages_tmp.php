<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMessagesTmp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itsqd_mon_messages', function (Blueprint $table) {
            
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('itsqd_mon_messages');
    }
}

/****
create table itsqd_mondb.itsqd_mon_messages ( 
id int not null auto_increment primary key,
source_id int not null,
alert_id varchar(100),
host varchar(100),
service varchar(100),
time varchar(100),
status varchar(100),
poller varchar(100),
output varchar(100),
thruk_url varchar(100),
sca_url varchar(100),
out_1 varchar(100),
out_2 varchar(100),
out_3 varchar(100),
uid varchar(100),
gid varchar(100),
flg_stat varchar(100),
created_at timestamp,
updated_at timestamp);
*/
