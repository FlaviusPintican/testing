<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateFilmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('film', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->text('body');
            $table->text('cast');
            $table->string('cert', 10);
            $table->string('class', 10);
            $table->text('directors');
            $table->unsignedSmallInteger('duration');
            $table->text('genres');
            $table->string('headline', 100);
            $table->string('source_id', 50);
            $table->char('lastUpdated', 20);
            $table->string('quote', 100);
            $table->unsignedSmallInteger('rating');
            $table->string('reviewAuthor', 20)->nullable();
            $table->string('skyGoId', 50);
            $table->string('sum', 100);
            $table->text('synopsis');
            $table->unsignedSmallInteger('year');
            $table->text('viewingWindow');
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
        Schema::dropIfExists('film');
    }
}
