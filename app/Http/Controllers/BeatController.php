<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use Illuminate\Http\Request;

class BeatController extends Controller
{
    public function show(int $id)
    {
        return Beat::findOrFail($id)->load('demoFile');
    }
}
