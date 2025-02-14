<?php

namespace Modules\User\app\Services;

use App\Models\User;
use App\Traits\CommonTrait;

class UserService
{
    use CommonTrait;

    public function index($modelId = null, $modelType = null)
    {
        $user = User::query();
        if ($modelId && $modelType) {
            $user->where('model_id', $modelId)->where('model_type', $modelType);
        } else {
            $user->whereNull('model_id')->whereNull('model_type');
        }
        return $user
            ->when(request('search'), function ($q) {
                $q->where('name', 'LIKE', '%' . request('search') . '%');
                $q->orWhere('email', 'LIKE', '%' . request('search') . '%');
            })
            ->orderBy(request('orderBy', 'id'), request('orderAs', 'desc'))
            ->paginate(request('perPage', 10));

    }


    public function store($modelId = null, $modelType = null)
    {
        $data = request()->validate([
            'name' => 'required|string|min:2|max:191',
            'email' => 'required|email|min:2|max:191|unique:users,email',
            'password' => 'required|string|min:8|max:191',
        ]);
        $data['model_id'] = $modelId;
        $data['model_type'] = $modelType;
        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return response()->json('success');
    }


    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(User $user)
    {
        $validated = request()->validate([
            'name' => 'required|string|min:2|max:191',
            'email' => 'required|email|unique:users,email,' . $user->id
        ]);
        $user->update($validated);

        return response()->json('success');
    }

    public function destroy(User $user): void
    {
        $user->delete();
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