<?php

namespace App\Http\Controllers\Status;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StatusController extends Controller
{
    public function getByEquipment($id)
    {
        $equipment = Equipment::find($id);
        if (!$equipment) {
            return $this->equipmentNotFoundResponse();
        }

        $maintenances = $this->getEquipmentStatus($equipment);
        return response()->json($maintenances, Response::HTTP_OK);
    }

    public function addStatus(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|string',      
        ]);

        $equipment = Equipment::find($id);
        if (!$equipment) {
            return $this->equipmentNotFoundResponse();
        }

        $status = $this->createStatus($validatedData, $equipment);
        return response()->json($status, Response::HTTP_CREATED);
    }

    public function getLastStatus($id)
    {
        $equipment = Equipment::find($id);
        if (!$equipment) {
            return $this->equipmentNotFoundResponse();
        }

        $latestStatus = $equipment->statuses()->latest('datetime')->first();
        if (!$latestStatus) {
            return response()->json(['message' => 'This equipment has no statuses yet'], Response::HTTP_BAD_REQUEST);
        }

        return response()->json($latestStatus, Response::HTTP_OK);
    }

    private function getEquipmentStatus($equipment)
    {
        return $equipment->statuses()->get();
    }

    private function createStatus($data, $equipment)
    {
        return $equipment->statuses()->create([
            "status"=> $data["status"],
            'datetime' => now(),
        ]);
    }

    private function equipmentNotFoundResponse()
    {
        return response()->json(['message' => 'Equipment not found'], Response::HTTP_NOT_FOUND);
    }
}
