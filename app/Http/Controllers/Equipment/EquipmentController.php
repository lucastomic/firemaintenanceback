<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Response;

class EquipmentController extends Controller
{
    public function getAll()
    {
        $equipments = Equipment::all();
        return response()->json($equipments, Response::HTTP_OK);
    }
}
