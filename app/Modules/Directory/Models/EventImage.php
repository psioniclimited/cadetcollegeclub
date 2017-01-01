<?php

namespace App\Modules\Directory\Models;

use Illuminate\Database\Eloquent\Model;

class EventImage extends Model {

	protected $table = 'event_images';
    
    public $timestamps = false;

	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_image',
    ];

    public function eventsDetail()
    {
    	return $this->belongsTo('App\Modules\Directory\Models\EventsDetail', 'events_id');
    }
}

