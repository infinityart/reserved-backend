<?php

/**
 * -Valideren-
 * @todo strings max 255 chars
 * @todo validate telephone number (check lengte en strip tekens)
 * @todo validate scheduled At dat tijd minuten deelbaar is door 15min
 * @todo kijk dat hairdresser en treatments bestaan
 */

namespace App\Http\Controllers;

use App\Appointment;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'hairdresserID' => 'required|numeric',
            'treatmentIDs' => 'required|array',
            'treatmentIDs.*' => 'numeric',
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email:rfc,dns,filter',
            'phoneNumber' => 'required',
            'scheduledAt' => 'required|date_format:d-m-Y H:i|after_or_equal:today'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $data = $validator->validated();

        $appointment = new Appointment;

        $insertedAppointment = $appointment->client()->create([
            'HairdresserID' => $data['hairdresserID'],
            'FirstName' => $data['firstName'],
            'LastName' => $data['lastName'],
            'Email' => $data['email'],
            'PhoneNumber' => $data['phoneNumber'],
        ]);

        var_dump($appointment);
        var_dump($insertedAppointment);
        // Vul appointment

        // save appointment

        return response()->json(['message' => 'Appointment has been stored.']);
    }

}
