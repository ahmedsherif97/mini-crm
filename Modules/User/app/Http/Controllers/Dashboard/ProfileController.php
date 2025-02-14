<?php

namespace Modules\User\App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\User\App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:show user')->only(['index', 'datatable']);
        // $this->middleware('permission:create user')->only(['create', 'store']);
        // $this->middleware('permission:update user')->only(['edit', 'update']);
        // $this->middleware('permission:delete user')->only(['destroy']);
    }

    public function show()
    {
        $user = auth()->user();
        return view('user::dashboard.profile', [
            'title' => __('dashboard.profile'),
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        return view('user::dashboard.edit');
    }

    public function update(Request $request)
    {
        auth()->user()->update(\request()->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|numeric|min:6',
        ]));
        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('user::dashboard.profile', [
            'title' => __('dashboard.profile'),
            'user' => $user
        ]);
        return $this->show(auth()->id());
    }


    public function uploadAvatar()
    {
        $filePath = $this->uploadFile('file', 'users/avatars');

        auth()->user()->update(['avatar' => $filePath]);

        return $this->successResponse(trans('dashboard.update.success'), [
            'filePath' => $filePath
        ]);
    }
}
