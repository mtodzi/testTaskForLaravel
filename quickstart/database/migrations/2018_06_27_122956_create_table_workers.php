<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWorkers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('surname',100);
            $table->string('name',100);
            $table->string('patronymic',100);
            $table->date('date_receipt');
            $table->float('salary');
            $table->integer('id_position')->unsigned()->nullable();
            $table->integer('id_worker')->unsigned()->nullable();
            $table->timestamps();
            $table->index('id_position', 'ik_inedex_position');
            $table->index('id_worker', 'ik_index_workers');
            $table->foreign('id_position')
                    ->references('id')->on('positions')
                    ->onDelete('SET NULL');
            $table->foreign('id_worker')
                    ->references('id')->on('workers')
                    ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->dropForeign('workers_id_worker_foreign');
            $table->dropForeign('workers_id_position_foreign');
        });
        
        Schema::dropIfExists('workers');
    }
}
