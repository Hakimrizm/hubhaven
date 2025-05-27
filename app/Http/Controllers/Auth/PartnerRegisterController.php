<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PartnerRegisterController extends Controller
{
    public function index()
    {
        return view('auth.partnerRegister');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',

            'partner_address' => 'required|string',
            'partner_location_url' => 'nullable|url',
            'partner_bussiness_name' => 'required|string',
            'partner_phone' => 'required|string|unique:partners',
            'partner_description' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'partner',
        ]);

        Partner::create([
            'user_id' => $user->id,
            'partner_address' => $request->partner_address,
            'partner_location_url' => $request->partner_location_url,
            'partner_bussiness_name' => $request->partner_bussiness_name,
            'partner_phone' => $request->partner_phone,
            'partner_description' => $request->partner_description,
        ]);

        auth()->login($user);

        return redirect()->route('dashboard')->with('success', 'Registration complete and profile created!');
    }
}
