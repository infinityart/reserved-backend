<?php

namespace App\Http\Controllers;

use App\Http\Resources\TreatmentResource;
use App\Treatment;

class TreatmentController extends Controller
{
    /**
     * Returns a JSON collection of treatments.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return TreatmentResource::collection(Treatment::all());
    }
}
