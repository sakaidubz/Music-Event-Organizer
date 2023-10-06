<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'event_id',
        'description',
        'status'
    ];
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
