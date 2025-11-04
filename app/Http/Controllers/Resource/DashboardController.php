<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // View
    public function index(){
        $user = Auth::user();
        $role = $user->role;
        switch($role){
            case 'admin':
                $data = $this->adminData();
                break;
            case 'instructor':
                $data = $this->instructorData($user);
                break;
            case 'learner':
                $data = $this->learnerData($user);
                break;

            default:
                abort(403,'Unauthorized');
        }

        return view($role. '.dashboard', $data);
    }

    private function adminData(){
        return [

        ];
    }
    private function instructorData($user){
        return [

        ];
    }
    private function learnerData($user){
        return [

        ];
    }
}
