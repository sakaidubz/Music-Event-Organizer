<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'event_id',
        'description',
        'date'
    ];
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
