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
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ID';

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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'ScheduledAt',
        'endTime'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $casts = [
        'ScheduledAt' => 'datetime:d-m-Y H:i:s',
        'endTime' => 'datetime:H:i'
    ];

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
