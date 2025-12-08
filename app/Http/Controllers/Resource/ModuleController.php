<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Models\Log;
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
        $auth = Auth::user();
        $role = $auth->role;
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
                    ->where('owner_id', $auth->id)
                    ->withCount('ClassroomModule')
                    ->latest()
                    ->get();
                break;

            case 'learner':
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
        $auth = Auth::User();
        $this->authorize('create', Module::class);
        $validated = $request->validated();
        $validated['owner_id'] = $auth->id;

        $module = $auth->Module()->create($validated);

        $sysMsg = 'Successfully created '.$module->name;
        Log::create([
            'user_id' => $auth->id,
            'action' => $sysMsg
        ]);
        return back()->with('success',$sysMsg);
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        $auth = Auth::user();
        $this->authorize('view',$module);
        return view($auth->role.'.module_view',compact('module'));
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
        $auth = Auth::user();
        $validated= $request->validated();
        $module->update($validated);

        $sysMsg = 'Successfully updated '.$module->name;
        Log::create([
            'user_id' => $auth->id,
            'action' => $sysMsg
        ]);
        return back()->with('success',$sysMsg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $auth = Auth::user();
        $this->authorize('delete',$module);
        $module->delete();

        $sysMsg = 'Successfully deleted '.$module->name;
        Log::create([
            'user_id' => $auth->id,
            'action' => $sysMsg
        ]);
        return redirect('/dashboard')->with('success',$sysMsg);
    }
}
