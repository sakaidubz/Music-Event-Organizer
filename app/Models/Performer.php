<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Performer extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'performer_name',
        'contact_details',
        'status',
        'start_time',
        'end_time',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($performer) {
            // 他の出演者と時間帯を重複させないためのチェック
            if ($performer->start_time && $performer->end_time) {
                $eventId = $performer->event_id;
                $performerId = $performer->id;

                $startRules = [
                    'start_time' => [
                        'required',
                        'date_format:H:i',
                        Rule::unique('performers', 'start_time')
                            ->where(function ($query) use ($eventId, $performerId) {
                                return $query->where('event_id', $eventId)
                                    ->where('id', '<>', $performerId);
                            }),
                    ],
                ];

                $endRules = [
                    'end_time' => [
                        'required',
                        'date_format:H:i',
                        Rule::unique('performers', 'end_time')
                            ->where(function ($query) use ($eventId, $performerId) {
                                return $query->where('event_id', $eventId)
                                    ->where('id', '<>', $performerId);
                            }),
                    ],
                ];

                $startValidator = \Validator::make($performer->toArray(), $startRules);
                $endValidator = \Validator::make($performer->toArray(), $endRules);

                if ($startValidator->fails() || $endValidator->fails()) {
                    return false;
                }
            }
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
