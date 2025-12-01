<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        $modules = [];

        switch ($role) {
            case 'admin':
                // Admin sees ALL modules in the system
                $modules = Module::with('User')
                    ->withCount('ClassroomModule') // Optional: keeps track of usage
                    ->latest()
                    ->get();
                break;

            case 'instructor':
                // Instructor sees ONLY the modules they created (Management View)
                $modules = Module::with('User')
                    ->where('owner_id', $user->id)
                    ->withCount('ClassroomModule')
                    ->latest()
                    ->get();
                break;

            case 'learner':
                // Learner sees ALL modules (Library View)
                // Removed the "ClassroomModule" filter so they see everything
                $modules = Module::with('User')
                    ->latest()
                    ->get();
                break;
        }

        return view($role . '.modules', [
            'modules' => $modules
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModuleRequest $request)
    {
        $user = Auth::User();
        $this->authorize('create', Module::class);
        $validated = $request->validated();
        $validated['owner_id'] = $user->id;

        $module = $user->Module()->create($validated);

        return back()->with('success','Successfully created '.$module->name);
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        $user = Auth::user();
        $this->authorize('view',$module);
        return view($user->role.'.module_view',compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateModuleRequest $request, Module $module)
    {
        $user = Auth::user();
        $this->authorize('update',$module);
        $validated= $request->validated();
        $module->update($validated);

        return back()->with('success','Successfully updated '.$module->name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $user = Auth::user();
        $this->authorize('delete',$module);
        $message = 'Successfully deleted '.$module->name;
        $module->delete();

        return back()->with('success',$message);
    }
}
