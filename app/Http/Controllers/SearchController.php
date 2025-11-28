<?php
namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Module;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->q;

        $classrooms = Classroom::where('name', 'like', "%$q%")
            ->get()
            ->map(fn ($c) => [
                'id' => $c->id,
                'name' => "Classroom: " . $c->name,
                'url' => route('classrooms.show', $c->id),
            ]);

        $modules = Module::where('name', 'like', "%$q%")
            ->get()
            ->map(fn ($m) => [
                'id' => $m->id,
                'name' => "Module: " . $m->name,
                'url' => route('modules.show', $m->id),
            ]);

        return $classrooms->merge($modules)->values();
    }
}

