<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $search_results = [
            'user-results'=>User::search($request->keyword),
            'classroom-results'=>Classroom::search($request->keyword),
            'module-results'=>Module::search($request->keyword),
        ];
        return $search_results;
    }
}
