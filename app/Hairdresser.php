<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hairdresser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Hairdresser';

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
     * Get the appointments of the hairdresser.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany('App\Appointment', 'HairdresserID');
    }
}
