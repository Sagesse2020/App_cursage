<?php

namespace App\Observers;

use App\Models\Activite;
use App\Helpers\ActivityHelper;

class GlobalActivityObserver
{
    /*
    |--------------------------------------------------------------------------
    | TABLES EXCLUES
    |--------------------------------------------------------------------------
    */

    private $excluded = [

        Activite::class,

    ];

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function created($model)
    {
        $this->saveLog('CREATE', $model);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function updated($model)
    {
        $this->saveLog('UPDATE', $model);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function deleted($model)
    {
        $this->saveLog('DELETE', $model);
    }

    /*
    |--------------------------------------------------------------------------
    | SAVE LOG
    |--------------------------------------------------------------------------
    */

    private function saveLog($action, $model)
    {
        if (in_array(get_class($model), $this->excluded)) {
            return;
        }

        $severity = 'info';

        if ($action === 'UPDATE') {
            $severity = 'warning';
        }

        if ($action === 'DELETE') {
            $severity = 'critical';
        }

        ActivityHelper::log(
            $action,
            class_basename($model),
            $model,
            $severity
        );
    }
}