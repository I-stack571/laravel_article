<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examples', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->char('code', 4);
            $table->integer('age');
            $table->bigInteger('total');
            $table->decimal('price', 8, 2);
            $table->float('score', 8, 2);
            $table->date('birthday');
            $table->dateTime('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->boolean('is_active');
            $table->text('description');
            $table->longText('content');
            $table->json('options');
            $table->binary('data');
            $table->timestamps(); // created_at と updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examples');
    }
}
