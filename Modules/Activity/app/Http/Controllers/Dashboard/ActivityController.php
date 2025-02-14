<?php

namespace Modules\Activity\App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list activity')->only(['index', 'datatable']);
        $this->middleware('permission:show activity')->only(['show']);
        //$this->middleware('permission:create activity')->only(['create', 'store']);
        // $this->middleware('permission:update activity')->only(['edit', 'update']);
        $this->middleware('permission:delete activity')->only(['destroy']);
        $this->middleware(\App\Http\Middleware\DataTableMiddleware::class)->only('datatable');
    }

    public function index()
    {
        return view('activity::dashboard.index', [
            'title'     => __('activity::dashboard.activity'),
            'result'    => []
        ]);
    }

    public function datatable()
    {
        $html = view('activity::dashboard.datatable', [
            'result'    => $result = Activity::query()
                ->when(request('search'), function ($q) {
                    //$q->where('name', 'LIKE', '%' . request('search') . '%');
                })
                ->orderBy(request('orderBy', 'id'), request('orderAs', 'desc'))
                ->paginate(request('perPage', 10))
        ]);
        return viewToDatatable($html, $result);
    }

    public function show($id)
    {
        $activity = Activity::findOrFail($id);
        return view('activity::dashboard.show', [
            'title' => $activity->name,
            'activity' => $activity
        ]);
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return back()->with('alert-success', trans('dashboard.delete.success'));
    }
}
