<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ShowDate extends Model
{
    use HasFactory;

    protected $table = "show_dates";

    protected $fillable = [
        'film_id',
        'showing_date',
        'show_time_id'
    ];

    protected $with = [
        'showTimes'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'showing_date' => 'date:Y-m-d',
    ];

    /**
     * @return HasOne
     */
    public function showTimes(): HasOne
    {
        return $this->hasOne(ShowTime::class, 'id', 'show_time_id');
    }

}
