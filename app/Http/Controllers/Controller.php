<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\interfaces\Inactivable;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function getActivos(Inactivable $model)
    {
        return $model::where('activo', 1);
    }

    public function disableModel(Inactivable $model)
    {
        $model->activo = 0;
        $model->save();
    }
}
