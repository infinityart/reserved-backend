<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Appointment';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['HairdresserID', 'ClientID', 'ScheduledAt'];

    /**
     * Get the client that has the appointment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo('App\Client', 'ClientID');
    }

    /**
     * Get the treatments that belongs to the appointment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function treatments()
    {
        return $this->belongsToMany('App\Treatment', 'ChosenTreatment', 'AppointmentID', 'TreatmentID')
            ->as('chosenTreatment');
    }
}
