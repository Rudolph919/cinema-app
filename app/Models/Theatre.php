<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Theatre extends Model
{
    use HasFactory;

    protected $table = "theatres";

    protected $fillable = [
        'name'
    ];

    protected $with = [
        'cinema'
    ];

    /**
     * @return BelongsTo
     */
    public function cinema(): BelongsTo
    {
        return $this->belongsTo(Cinema::class);
    }

    /**
     * @return HasOne
     */
    public function films(): HasOne
    {
        return $this->hasOne(Film::class);
    }

    /**
     * @return HasMany
     */
    public function showTimes(): HasMany
    {
        return $this->hasMany(ShowTime::class);
    }
}
