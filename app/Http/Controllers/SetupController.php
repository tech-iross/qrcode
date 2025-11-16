<?php

namespace App\Http\Controllers;

use App\Models\Setup;

class SetupController extends Controller
{
    public function index()
    {
        $setups = Setup::with(['colaborador','produto'])->orderByDesc('created_at')->paginate(20);
        return view('setups.index', compact('setups'));
    }
}
