<?php

namespace Modules\User\App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Middleware\DataTableMiddleware;
use App\Models\User;
use Exception;
use Modules\Country\App\Models\Country;
use Modules\User\app\Services\UserService;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
        $this->middleware('permission:list user')->only(['index', 'datatable']);
        $this->middleware('permission:show user')->only(['show']);
        $this->middleware('permission:create user')->only(['create', 'store']);
        $this->middleware('permission:update user')->only(['edit', 'update']);
        $this->middleware('permission:delete user')->only(['destroy']);
        $this->middleware(DataTableMiddleware::class)->only('datatable');
    }

    public function index()
    {
        return view('user::dashboard.index', [
            'title' => __('dashboard.user'),
            'result' => []
        ]);
    }

    public function datatable()
    {
        $users = $this->userService->index();
        $html = view('user::dashboard.datatable', [
            'result' => $result = $users
        ]);
        return viewToDatatable($html, $result);
    }

    public function create()
    {
        return view('user::dashboard.create', [
            'title' => __('user::dashboard.create') . ' ' . __('user::dashboard.user'),
            'role' => Role::query()->get(),
            'countries' => Country::active()->get(),
        ]);
    }

    /**
     * @throws Exception
     */
    public function store()
    {
        $response = $this->userService->store();
        $response = $response->getData();
        if ($response == 'success') {
            return back()->with('alert-success', trans('dashboard.create.success'));
        } else {
            throw new Exception('An error occurred: ' . json_encode($response));
        }
    }


    public function show($id)
    {
        $user = $this->userService->show($id)->getData();
        return view('user::dashboard.show', [
            'title' => $user->name,
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        $user = $this->userService->edit($id)->getData();

        if (auth()->id() == $id)
            return redirect()->route('dashboard.user.profile.show');

        return view('user::dashboard.edit', [
            'title' => $user->name,
            'user' => $user
        ]);
    }

    /**
     * @throws Exception
     */
    public function update(User $user)
    {
        $response = $this->userService->update($user);
        $response = $response->getData();
        if ($response == 'success') {
            return back()->with('alert-success', trans('dashboard.create.success'));
        } else {
            throw new Exception('An error occurred: ' . json_encode($response));
        }
    }

    public function destroy(User $user)
    {
        $this->userService->destroy($user);
        return back()->with('alert-success', trans('dashboard.delete.success'));
    }


    public function uploadAvatar()
    {
        return $this->userService->uploadAvatar();
    }
}
