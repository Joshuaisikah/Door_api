<?php
namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function toggleLight(Request $request) {
        // Assuming there's only one office, you might fetch it directly
        $office = Office::firstOrFail();
        $office->lights_state = !$office->lights_state;
        $office->save();

        return response()->json(['message' => 'Lights state toggled', 'lights_state' => $office->lights_state]);
    }

    public function toggleDoor(Request $request) {
        // Assuming there's only one office, you might fetch it directly
        $office = Office::firstOrFail();
        $office->door_state = !$office->door_state;
        $office->save();

        return response()->json(['message' => 'Door state toggled', 'door_state' => $office->door_state]);
    }

    public function checkStates() {
        // Assuming there's only one office, you might fetch it directly
        $office = Office::firstOrFail();

        return response()->json(['lights_state' => $office->lights_state, 'door_state' => $office->door_state]);
    }
}
