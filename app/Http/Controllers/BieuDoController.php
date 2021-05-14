<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class BieuDoController extends Controller
{
    public function index()
    { 
        return view('bieudo.index');
    }
}
