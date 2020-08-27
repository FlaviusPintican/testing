<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * @var string
     */
    protected $table = 'image';

    /**
     * @var string[]
     */
    protected $fillable = [
        'url',
        'heigth',
        'width',
        'type',
        'film_id',
    ];

    /**
     * Get the film that own this file
     *
     * @return BelongsTo
     */
    public function film() : BelongsTo
    {
        return $this->belongsTo(Film::class);
    }
}
