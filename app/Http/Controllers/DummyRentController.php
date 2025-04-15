<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DummyRent;

class DummyRentController extends Controller
{
    public function index()
    {
        $rents = DummyRent::all();
        return view('rents.index', compact('rents'));
    }
}
