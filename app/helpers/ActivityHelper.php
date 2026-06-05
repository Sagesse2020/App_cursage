<?php

namespace App\Helpers;

use App\Models\Activite;
use Illuminate\Support\Facades\Log;

class ActivityHelper
{
    public static function log(
        $action,
        $module,
        $model = null,
        $severity = 'info'
    )
    {
        try {

            $ancienEtat = null;
            $nouvelEtat = null;

            if ($model) {

                if (
                    strtoupper($action) === 'UPDATE'
                    && method_exists($model, 'getChanges')
                ) {

                    $ancienEtat = collect(
                        $model->getOriginal()
                    )
                    ->only(
                        array_keys(
                            $model->getChanges()
                        )
                    )
                    ->map(function ($value, $key) {

                        return ucfirst($key)
                            .' : '
                            .$value;

                    })
                    ->implode("\n");

                    $nouvelEtat = collect(
                        $model->getChanges()
                    )
                    ->map(function ($value, $key) {

                        return ucfirst($key)
                            .' : '
                            .$value;

                    })
                    ->implode("\n");

                } else {

                    $nouvelEtat = collect(
                        $model->getAttributes()
                    )
                    ->map(function ($value, $key) {

                        return ucfirst($key)
                            .' : '
                            .$value;

                    })
                    ->implode("\n");
                }
            }

            Activite::create([

                'user_id' => auth()->id(),

                'action' => strtoupper($action),

                'module' => $module,

                'reference_id' => $model->id ?? null,

                'ancien_etat' => $ancienEtat,

                'nouvel_etat' => $nouvelEtat,

                'severity' => $severity,

                'ip' => request()->ip(),

                'user_agent' => request()->userAgent(),

            ]);

        } catch (\Exception $e) {

            Log::error(
                'Erreur log activité : '
                .$e->getMessage()
            );
        }
    }
}