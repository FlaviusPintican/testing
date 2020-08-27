<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('image', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->text('url');
            $table->unsignedMediumInteger('heigth');
            $table->unsignedMediumInteger('width');
            $table->enum('type', ['keyArtImages', 'cardImages']);
            $table->unsignedMediumInteger('film_id');
            $table->timestamps();

            $table->foreign('film_id')
                  ->references('id')
                  ->on('film')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('image');
    }
}
