// app/database/migrations/####_##_##_######_create_UserActions_table.php

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itsqd_user_actions', function (Blueprint $table) {
            
            $table->increments('action_id');
            $table->string('user_email',255);
            $table->string('user_name',255);
            $table->string('action_parameters',255);
            $table->string('action_description',255);
            $table->timestamp('action_date');
            
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
        Schema::drop('itsqd_user_actions');
    }
}