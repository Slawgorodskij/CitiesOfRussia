<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\ModelService;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $user = Auth::user();

        // $user = User::find(1);   // для отладки

        return view('profile', [
            'user' => $user]);
    }

    public function store(ProfileFormRequest $request)
    {
        Profile::create([
            'user_id' => $request->get('user_id'),
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'patronymic' => $request->get('patronymic'),
            'city' => $request->get('city'),
            'date_of_birth' => $request->get('date_of_birth'),
        ]);

        /*
        $validated = $request->validated();
         $created = Profile::create($validated);

         if ($created) {
             return to_route('profile');
         }
       */
        return back()->withInput();
    }

    public function update(ProfileFormRequest $request, Profile $profile)
    {
        $profile->update($request->validated());
        return to_route('profile');
    }
}

