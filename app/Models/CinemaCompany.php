<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CinemaCompany extends Model
{
    use HasFactory;

    protected $table = "cinema_companies";

    protected $fillable = [
        'name',
    ];

    public function cinemas(): HasMany
    {
        return $this->hasMany(Cinema::class);
    }
}
