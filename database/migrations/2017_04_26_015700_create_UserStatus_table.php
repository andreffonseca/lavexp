// app/database/migrations/####_##_##_######_create_UserStatus_table.php

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itsqd_user_status', function (Blueprint $table) {
            
            $table->increments('status_id');
            $table->string('user_email',255);
            $table->string('user_name',255)->nullable();
            $table->integer('last_status');
            $table->timestamp('last_status_change');
            
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
        Schema::drop('itsqd_user_status');
    }
}