<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Place;
use Illuminate\Http\Request;

use Carbon\Carbon;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function checkTime($request)
    {
        try {
            $open = Carbon::createFromFormat('H:i', $request->place_open_time);
            $close = Carbon::createFromFormat('H:i', $request->place_close_time);
        } catch (\Exception $e) {
            return back()->withErrors(['time_format' => 'Invalid time format.'])->withInput();
        }

        // Jika jam tutup lebih awal atau sama dengan jam buka, anggap melewati tengah malam
        if ($close->lte($open)) {
            $close->addDay();
        }

        // Validasi ulang jika masih salah (misalnya waktu sama)
        if ($close->lte($open)) {
            return back()->withErrors(['place_close_time' => 'Closing hours must be after opening hours.'])->withInput();
        }
    }

    public function index()
    {
        $partner_id = auth()->user()->partner->id;

        return view('dashboard.partner.place.index', [
            'places' => Place::where('partner_id', $partner_id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.partner.place.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $partner_id = auth()->user()->partner->id;

        $request->validate([
            'place_name' => 'required',
            'place_price_per_hour' => 'required|numeric',
            'place_open_time' => 'required|date_format:H:i',
            'place_close_time' => 'required|date_format:H:i',
            'place_address' => 'required',
            'place_type' => 'required',
            'place_description' => 'required'
        ]);

        $this->checkTime($request);

        $place = Place::create([
            'partner_id' => $partner_id,
            'place_name' => $request->place_name,
            'place_price_per_hour' => $request->place_price_per_hour,
            'place_open_time' => $request->place_open_time,
            'place_close_time' => $request->place_close_time,
            'place_address' => $request->place_address,
            'place_type' => $request->place_type,
            'place_description' => $request->place_description,
            'place_location_url' => $request->place_location_url
        ]);

        return redirect('/dashboard/place')->with([
            'success' => 'Place has been added',
            'place_id' => $place->id,
            'status' => 'Added'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        return view('dashboard.partner.place.place', [
            'place' => $place
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        $this->authorize('update', $place);

        return view('dashboard.partner.place.update', [
            'place' => $place
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        $partner_id = auth()->user()->partner->id;

        $request->validate([
            'place_name' => 'required',
            'place_price_per_hour' => 'required|numeric',
            'place_open_time' => 'required|date_format:H:i',
            'place_close_time' => 'required|date_format:H:i',
            'place_address' => 'required',
            'place_location_url' => 'nullable|url',
            'place_type' => 'required',
            'place_description' => 'required',
        ]);

        $this->checkTime($request);

        $place->update([
            'partner_id' => $partner_id,
            'place_name' => $request->place_name,
            'place_price_per_hour' => $request->place_price_per_hour,
            'place_open_time' => $request->place_open_time,
            'place_close_time' => $request->place_close_time,
            'place_address' => $request->place_address,
            'place_location_url' => $request->place_location_url,
            'place_type' => $request->place_type,
            'place_description' => $request->place_description,
        ]);

        return redirect('/dashboard/place')->with([
            'success' => 'Place has been Updated',
            'place_id' => $place->id,
            'status' => 'Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        $place->delete();
        return redirect('/dashboard/place')->with('success', 'Place has been deleted.');
    }
}
