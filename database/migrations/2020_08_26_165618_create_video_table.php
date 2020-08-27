<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('video', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->string('title', 25);
            $table->text('alternatives');
            $table->text('url');
            $table->enum('type', ['trailer', 'clip']);
            $table->unsignedMediumInteger('film_id');
            $table->foreign('film_id')
                  ->references('id')
                  ->on('film')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('video');
    }
}
