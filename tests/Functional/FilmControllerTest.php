<?php declare(strict_types=1);

namespace Functional;

use App\Models\Film;
use Dotenv\Repository\RepositoryBuilder;
use TestCase;
use Dotenv\Dotenv;

class FilmControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function setUp() : void
    {
        parent::setUp();
        $repository = RepositoryBuilder::create()->make();
        Dotenv::create($repository, base_path(), '.env.testing')->load();
        $this->artisan('migrate:fresh');
    }

    /**
     * @test
     *
     * @return void
     */
    public function itReturnsEmptyFilmList(): void
    {
        $response = $this->call('GET', '/films');
        static::assertEquals([], json_decode($response->getContent()));
        static::assertEquals(200, $response->getStatusCode());
    }

    /**
     * @test
     *
     * @return void
     */
    public function itReturnsFilmList(): void
    {
        $film = factory(Film::class)->create();
        $response = $this->call('GET', '/films');
        static::assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getContent(), true);
        static::assertSame($film->body, $data[0]['body']);
        static::assertSame($film->synopsis, $data[0]['synopsis']);
        static::assertSame($film->year, $data[0]['year']);
    }

    /**
     * @test
     *
     * @return void
     */
    public function itReturnsNotFoundFilm(): void
    {
        $response = $this->call('GET', '/films/4');
        static::assertEquals(404, $response->getStatusCode());
    }

    /**
     * @test
     *
     * @return void
     */
    public function itReturnsSpecificFilm(): void
    {
        $film = factory(Film::class)->create();
        $response = $this->call('GET', '/films/1');
        static::assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getContent(), true);
        static::assertSame($film->id, $data['id']);
    }
}

