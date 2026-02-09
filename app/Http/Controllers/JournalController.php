<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;

class JournalController extends Controller
{
      public function index()
    {
        return view('journal.index', [
            'logs' => Journal::latest()->paginate(20),
        ]);
    }
}
