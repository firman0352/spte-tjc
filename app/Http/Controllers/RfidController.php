<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\RfidLocation;
use App\Models\Verifikasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RfidController extends Controller
{
    private function inputTag(Request $request)
    {
        $request->validate([
            'rfid_tag' => 'required|string',
        ]);

        $rfidTag = $request->input('rfid_tag');
        // Store $rfidTag in the cache
        Cache::put('rfid_tag', $rfidTag, now()->addMinutes(1)); // The tag will be stored for 1 minutes
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rfid_tag' => 'required|string',
            'location' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $rfidTag = $request->input('rfid_tag');
        $location = $request->input('location');

        // Check if the rfid_tag exists in the verifikasis table
        $verifikasi = Verifikasi::where('rfid_tag', $rfidTag)->first();

        if ($verifikasi) {
            $verifikasi->update(['location' => $location]);
            RfidLocation::create([
                'rfid_tag' => $rfidTag,
                'location' => $location,
            ]);

            return response()->json(['message' => 'Rfid location stored successfully']);
        } else {
            // If the rfid_tag does not exist, call the inputTag method
            $this->inputTag($request);

            return response()->json(['message' => 'Rfid tag stored to cache successfully']);
        }
    }
    public function show()
    {
        $rfidTag = Cache::get('rfid_tag');
        return response()->json(['rfid_tag' => $rfidTag]);
    }

    public function getLocation()
    {
        $location = Verifikasi::get('location');

        return response()->json(['location' => $location]);
    }

    public function findLocation($rfidTag)
    {
        $location = Verifikasi::where('rfid_tag', $rfidTag)->first('location');

        return response()->json(['location' => $location]);
    }
}
