<?php

namespace App\Http\Controllers;

use App;
use Auth;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function hasrole($role) {
        //validar solo admin
        $current_user = Auth::user();
        if($current_user->role == $role) {
            return true;
        } else {
            flash('No tiene permiso para acceder a esta área.', 'danger');
            return false;
        }
    }
}
