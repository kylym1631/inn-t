<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'status'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->locale('ru')->translatedFormat('d F Y, H:i');
    }
}
