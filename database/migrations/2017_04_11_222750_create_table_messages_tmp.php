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
            $table->string('msg_field_1',255)->nullable();
            $table->string('msg_field_2',255)->nullable();
            $table->string('msg_field_3',255)->nullable();
            $table->string('msg_field_4',255)->nullable();
            $table->string('msg_field_5',255)->nullable();
            $table->string('msg_field_6',255)->nullable();
            $table->string('msg_field_7',255)->nullable();
            $table->string('msg_field_8',255)->nullable();
            $table->string('msg_field_9',255)->nullable();
            $table->string('msg_field_10',255)->nullable();
            $table->string('msg_field_11',255)->nullable();
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
