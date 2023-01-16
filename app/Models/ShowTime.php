<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowTime extends Model
{
    use HasFactory;

    protected $table = "show_times";

    protected $fillable = [
        'show_time_text',
        'show_time_value'
    ];
}
