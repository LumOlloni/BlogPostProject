<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('friends_users', function (Blueprint $table) {

            $table->bigInteger('friend_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('request_id')->unsigned();
            $table->integer('status');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('friend_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('request_id')->references('id')->on('users')->onDelete('cascade');

            $table->primary(array('user_id', 'friend_id', 'request_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friends_users');
    }
}
