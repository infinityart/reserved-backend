<?php

/**
 * -Valideren-
 * @todo validate telephone number (check lengte en strip tekens)
 */

namespace App\Http\Controllers;

use App\Appointment;
use App\Rules\AppointableTime;
use App\Rules\TimeIsModuloOfFifteen;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{

    /**
     * Store a new Appointment.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Support\MessageBag
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hairdresserID' => 'required|numeric|exists:Hairdresser,ID',
            'treatmentIDs' => 'required|array',
            'treatmentIDs.*' => 'numeric|exists:Treatment,ID',
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'email' => 'required|email:rfc,dns,filter|max:255',
            'phoneNumber' => 'required',
            'scheduledAt' => ['required', 'date_format:d-m-Y H:i', 'after_or_equal:now+2hours', new AppointableTime]
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $data = $validator->validated();

        $appointment = new Appointment;

        DB::transaction(function () use ($appointment, $data) {
            $insertedAppointment = $appointment->client()->create([
                'FirstName' => $data['firstName'],
                'LastName' => $data['lastName'],
                'Email' => $data['email'],
                'PhoneNumber' => $data['phoneNumber'],
            ]);

            $clientID = $insertedAppointment->getKey();

            $scheduledAt = Carbon::createFromFormat('d-m-Y H:i', $data['scheduledAt']);

            $insertedAppointment = $appointment->create([
                'HairdresserID' => $data['hairdresserID'],
                'ClientID' => $clientID,
                'ScheduledAt' => $scheduledAt->format('Y-m-d H:i')
            ]);

            $insertedAppointment->treatments()->attach($data['treatmentIDs']);
        });

        return response()->json(['message' => 'Appointment has been stored.']);
    }

}
