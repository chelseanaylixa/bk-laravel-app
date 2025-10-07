<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipKelulusan;

class ArsipKelulusanController extends Controller
{
    public function index()
    {
        $arsip = ArsipKelulusan::all();
        return view('arsip-lulusan.index', compact('arsip'));
    }
}
