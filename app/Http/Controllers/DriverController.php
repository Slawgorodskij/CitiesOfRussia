<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Http\Controllers\Controller;
use App\Http\Requests\DriverFormRequest;

class DriverController extends Controller
{
    public function index(Request $request)
    {   
        dd($request->get('user_id'));
    }    
    public function store(DriverFormRequest $request)
    {
        Driver::create([
            'user_id' => $request->get('user_id'),
            'driving_license' => $request->get('driving_license'),
            'car' => $request->get('car'),
            'registration_number' => $request->get('registration_number'),
            'vehicle_registration_certificate' => $request->get('vehicle_registration_certificate'),
            'document_verification' => $request->get('document_verification'),
        ]);
       
        /* 
        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id;
        $created = Driver::create($validated);

        if ($created) {
            return back();
        }
        */
        return back()->withInput();
    }
    public function update(DriverFormRequest $request, Driver $driver)
    {
        $driver->update($request->validated());
        return to_route('driver');
    }
}


