<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;

class PartnerProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Partner $profile)
    {
        return view('dashboard.partner.profile.index', [
            'profile' => $profile
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $profile)
    {
        $this->authorize('update', $profile);

        return view('dashboard.partner.profile.update', [
            'profile' => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $profile)
    {
        $this->authorize('update', $profile);

        $validated = $request->validate([
            'partner_address' => 'required|string|max:255',
            'partner_location_url' => 'nullable|url',
            'partner_bussiness_name' => 'required|string|max:255',
            'partner_phone' => 'required|string|max:20|unique:partners,partner_phone,' . $profile->id,
            'partner_description' => 'required|string',
        ]);

        $profile->update($validated);

        return redirect()->route('profile.show', ['profile' => $profile->id])
        ->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        //
    }
}
