<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    use HasFactory;

    protected $table = "films";

    protected $fillable = [
        'name',
        'genre',
        'overview',
        'runtime',
        'theatre_id',
        'start_date',
        'end_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'end_date'   => 'datetime:Y-m-d',
    ];


    /**
     * @return HasMany
     */
    public function theatre(): HasMany
    {
        return $this->hasMany(Theatre::class);
    }

    /**
     * @return HasMany
     */
    public function showTimes(): HasMany
    {
        return $this->hasMany(ShowTime::class);
    }
}
