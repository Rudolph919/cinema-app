<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cinema extends Model
{
    use HasFactory;

    protected $table = "cinemas";

    protected $fillable = [
        'cinema_company_id',
        'name',
        'location'
    ];

    public function cinemaCompany(): BelongsTo
    {
        return $this->belongsTo(CinemaCompany::class);
    }

    public function theatres(): HasMany
    {
        return $this->hasMany(Theatre::class);
    }
}
