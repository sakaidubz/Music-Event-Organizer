<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class Plan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'event_id',
        'title',
        'description',
        'start_date',
        'end_date',
    ];
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    
    public static function getPlans()
    {
        return self::with('event')->get();
    }
}
