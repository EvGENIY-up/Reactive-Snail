<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Person;
use App\Models\Status;

class HomeController extends Controller
{
    public function index()
    {
        $allCars = Car::with('person')->with('status')->get();

        return response()->json([
            'success' => true,
            'data' => $allCars
        ]);
    }
}
