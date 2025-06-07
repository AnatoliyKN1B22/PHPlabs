<?php

namespace App\Models;

use App\Models\Organizer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'date', 'location', 'organizer_id'];
    protected $casts = [
        'date' => 'datetime',
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    /**
     * Подія може мати багатьох учасників (багато до багатьох).
     */
    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'event_participant'); // Другий параметр - назва проміжної таблиці
    }
}