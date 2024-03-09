<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        return Beat::withFilters($request)->orderBy('created_at', 'DESC')->with('demoFile')->paginate(9);
    }
}
