<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\EnrolledUser;
use App\Http\Requests\StoreEnrolledUserRequest;
use App\Http\Requests\UpdateEnrolledUserRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EnrolledUserController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        return view($role.'.enrolledusers');
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
    public function store(StoreEnrolledUserRequest $request)
    {
        try {
            $validated = $request->validated();

            //check if empty ang user_id og naa ang email
            if(!isset($validated['user_id']) && isset($validated['email'])){
                $email = $validated['email'];
                $userID = User::where('email',$email)->value('id');

                if(!$userID){
                    Log::error('No User with Email:'.$email);
                    return back()->with('error','No such User');
                }

                $validated['user_id']=$userID;
            }

            $enrolleduser = EnrolledUser::create([
                'user_id' => $validated['user_id'],
                'classroom_id' =>$validated['classroom_id']
            ]);

            return back()->with('success','Successfully added '.$enrolleduser->user->name.' to '.$enrolleduser->classroom->name);

        } catch (\Throwable $e) {
            Log::error('Enrollment process failed', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'payload' => $request->all()
            ]);

            return back()->with('error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EnrolledUser $enrolleduser)
    {
        $auth = Auth::user();
        $user = $enrolleduser->user;
        $classroom = $enrolleduser->classroom;
        $progress = $enrolleduser->userProgress;

        return view($auth->role.'.user_view', compact('user', 'progress', 'classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EnrolledUser $enrolleduser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnrolledUserRequest $request, EnrolledUser $enrolleduser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(EnrolledUser $enrolleduser)
    {
        $enrolleduser->load('classroom');

        $this->authorize('delete', $enrolleduser);

        $enrolleduser->delete();

        return redirect('/classrooms')->with('success','Successfully removed '.$enrolleduser->user->name.' from '.$enrolleduser->classroom->name);
    }
}
