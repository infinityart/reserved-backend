<?php

namespace App\Http\Controllers;

use App\Hairdresser;
use App\Http\Resources\HairdresserAppointmentsResource;
use App\Http\Resources\HairdresserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class HairdresserController extends Controller
{
    /**
     * Returns a JSON collection of treatments.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return HairdresserResource::collection(Hairdresser::all());
    }

    public function appointments(Request $request)
    {
        $validatedData = $this->validate($request, [
            'date' => ['required', 'date_format:d-m-Y', 'bail', 'after_or_equal:today']
        ]);

        $date = $validatedData['date'];
        $date = Carbon::createFromFormat('d-m-Y', $date);

        $hairdressers = Hairdresser::whereHas('appointments', function ($query) use ($date) {
            $query->whereDate('ScheduledAt', '=', $date->format('Y-m-d'));
        })->get();

        foreach ($hairdressers as $hairdresser) {
            foreach ($hairdresser->appointments as $appointment) {
                $endTime = $appointment->ScheduledAt;

                foreach ($appointment->treatments as $treatment) {
                    $duration = Carbon::createFromFormat('H:i:s', $treatment->Duration);

                    $endTime->addHours($duration->hour);
                    $endTime->addMinutes($duration->minute);
                }

                $appointment->endTime = $endTime;
            }
        }

        return HairdresserAppointmentsResource::collection($hairdressers);
    }
}
