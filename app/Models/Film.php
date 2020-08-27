<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    /**
     * @var string
     */
    protected $table = 'film';

    /**
     * @var string[]
     */
    protected $fillable = [
        'body',
	    'cast',
	    'cert',
	    'class',
	    'directors',
	    'duration',
	    'genres',
	    'headline',
	    'source_id',
	    'lastUpdated',
	    'quote',
	    'rating',
	    'reviewAuthor',
	    'skyGoId',
	    'sum',
	    'synopsis',
	    'year',
	    'viewingWindow',
    ];

    /**
     * Get the images for a specific film
     *
     * @return HasMany
     */
    public function images() : HasMany
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Get the videos for a specific film
     *
     * @return HasMany
     */
    public function videos() : HasMany
    {
        return $this->hasMany(Video::class);
    }
}
