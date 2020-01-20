<?php

namespace App\Http\Controllers;

use App\Hairdresser;
use App\Http\Resources\HairdresserResource;

class HairdresserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Returns a JSON collection of treatments.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return HairdresserResource::collection(Hairdresser::all());
    }
}
