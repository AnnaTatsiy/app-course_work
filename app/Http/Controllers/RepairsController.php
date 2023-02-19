<?php

namespace App\Http\Controllers;

use App\Models\repair;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RepairsController extends Controller
{
    // получить все записи
    public function repairs(): JsonResponse {
        return response()->json(repair::with('malfunction','worker','car','client','spare_part')->paginate());
    }
}
