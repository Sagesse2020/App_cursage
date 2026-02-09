<?php
use App\Models\Journal;

function logAction($action, $details = null)
{
    Journal::create([
        'action' => $action,
        'auteur' => auth()->user()->name ?? 'Système',
        'details' => $details,
    ]);
}

