<?php

/**
 * -Valideren-
 * @todo validate telephone number (check lengte en strip tekens)
 */

namespace App\Http\Controllers;

use App\Appointment;
use App\Rules\AppointableTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * @todo controlleer of het niet tijdens een andere afpsraak is :)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'hairdresserID' => 'required|numeric|exists:Hairdresser,ID',
            'treatmentIDs' => 'required|array',
            'treatmentIDs.*' => 'numeric|exists:Treatment,ID',
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'email' => 'required|email:rfc,dns,filter|max:255',
            'phoneNumber' => 'required',
            'scheduledAt' => ['required', 'date_format:d-m-Y H:i', 'after_or_equal:tomorrow', new AppointableTime]
        ]);

        $appointment = new Appointment;

        DB::transaction(function () use ($appointment, $validatedData) {
            $insertedAppointment = $appointment->client()->create([
                'FirstName' => $validatedData['firstName'],
                'LastName' => $validatedData['lastName'],
                'Email' => $validatedData['email'],
                'PhoneNumber' => $validatedData['phoneNumber'],
            ]);

            $clientID = $insertedAppointment->getKey();

            $insertedAppointment = $appointment->create([
                'HairdresserID' => $validatedData['hairdresserID'],
                'ClientID' => $clientID,
                'ScheduledAt' => Carbon::createFromFormat('d-m-Y H:i', $validatedData['scheduledAt'])
            ]);

            $insertedAppointment->treatments()->attach($validatedData['treatmentIDs']);
        });

        return response()->json(['message' => 'Appointment has been stored.']);
    }
}
