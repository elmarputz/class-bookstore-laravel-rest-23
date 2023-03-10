<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'url', 'title'
    ];

    /**
     * image belongs exactly to one book
     * @return BelongsTo
     */
    public function book() : BelongsTo {
        return $this->belongsTo(Book::class);
    }

}
