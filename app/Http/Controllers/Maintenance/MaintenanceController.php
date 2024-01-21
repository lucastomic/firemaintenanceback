<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use Illuminate\Http\Response;
use App\Models\Equipment;
use Tymon\JWTAuth\Facades\JWTAuth;

class MaintenanceController extends Controller
{
    public function getByUser()
    {
        $user = $this->getAuthenticatedUser();
        $equipment = $this->getMaintenancesByUser($user);
        return response()->json($equipment, Response::HTTP_OK);
    }

    public function getByEquipment($id)
    {
        $equipment = Equipment::find($id);
        if (!$equipment) {
            return response()->json(['message' => 'Equipment not found'], Response::HTTP_NOT_FOUND);
        }
        $maintenances = $this->getMaintenancesByEquipment( $equipment );
        return response()->json($maintenances, Response::HTTP_OK);
    }

    public function createMaintenance($id)
    {
        $user = $this->getAuthenticatedUser();
        $equipment = Equipment::find($id);
        if (!$equipment) {
            return response()->json(['message' => 'Equipment not found'], Response::HTTP_NOT_FOUND);
        }
        $maintenance = $this->createNewMaintenance($user, $equipment);
        return response()->json($maintenance, Response::HTTP_CREATED);
    }

    private function getAuthenticatedUser()
    {
        return JWTAuth::parseToken()->authenticate();
    }

    private function getMaintenancesByUser($user){
        return Maintenance::where('user_id', $user->id)->get();
    }

    private function getMaintenancesByEquipment($equipment){
        return Maintenance::where('equipment_id', $equipment->id)->get();
    }


    private function createNewMaintenance($user, $equipment)
    {
        return Maintenance::create([
            'description' => 'Descripción del mantenimiento',
            'datetime' => now(),
            'user_id' => $user->id,
            'equipment_id' => $equipment->id
        ]);
    }

}
