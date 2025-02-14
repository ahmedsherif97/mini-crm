<?php

namespace Modules\Setting\App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Modules\Setting\App\Models\Setting;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list setting')->only(['index', 'datatable']);
        $this->middleware('permission:create setting')->only(['create', 'store']);
        $this->middleware('permission:update setting')->only(['edit', 'update']);
        $this->middleware('permission:delete setting')->only(['destroy']);
        $this->middleware(\App\Http\Middleware\DataTableMiddleware::class)->only('datatable');
    }

    public function index()
    {
        $title = __('setting::dashboard.settings');
        $settings = Setting::all();
        return view('setting::dashboard.index', compact('settings', 'title'));
    }

    public function datatable()
    {
        $html = view('setting::dashboard.datatable', [
            'result' => $result = Setting::query()
                ->when(request('search'), function ($q) {
                    $q->where('slug', 'LIKE', '%' . request('search') . '%');
                    $q->orWhere('value', 'LIKE', '%' . request('search') . '%');
                })
                ->orderBy(request('orderBy', 'id'), request('orderAs', 'desc'))
                ->paginate(request('perPage', 10))
        ]);
        return viewToDatatable($html, $result);
    }

    public function create()
    {
        return view('setting::dashboard.create', [
            'title' => __('setting::dashboard.settings'),
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'primary-color' => 'required|string|max:255',
            'secondary-color' => 'required|string|max:255',
            'logo' => 'nullable|mimes:jpeg,jpg,png,svg,icon',
            'remove_logo' => 'nullable|boolean',
            'favicon' => 'nullable|mimes:jpeg,jpg,png,svg,icon',
            'remove_favicon' => 'nullable|boolean',
        ]);
        if (request()->has('remove_logo') && request()->remove_logo) {
            $logo = app('settings')->find('logo');
            if ($logo) {
                $path = str_replace('/uploads/', '', app('settings')->find('logo'));
                Storage::disk('uploads')->delete($path);
                Setting::query()->where('slug', 'logo')->first()->update([
                    'value' => null,
                ]);
            }
        }

        if (request()->hasFile('logo')) {
            $logo = app('settings')->find('logo');
            if ($logo) {
                $path = str_replace('/uploads', '', $logo);
                Storage::disk('uploads')->delete($path);
            }

            $logo = $this->uploadFile('logo', 'img', 'nullable|image|mimes:jpeg,jpg,png,svg,icon', 'uploads');
            Setting::query()->where('slug', 'logo')->first()->update([
                'value' => $logo,
            ]);
        }
        if (request()->has('remove_favicon') && request()->remove_favicon) {
            $favicon = app('settings')->find('favicon');
            if ($favicon) {
                $path = str_replace('/uploads/', '', $favicon);
                Storage::disk('uploads')->delete($path);
                Setting::query()->where('slug', 'favicon')->first()->update([
                    'value' => null,
                ]);
            }
        }

        if (request()->hasFile('favicon')) {
            $favicon = app('settings')->find('favicon');
            if ($favicon) {
                $path = str_replace('/uploads', '', $favicon);
                Storage::disk('uploads')->delete($path);
            }

            $favicon = $this->uploadFile('favicon', '', 'nullable|image|mimes:jpeg,jpg,png,svg,icon', 'uploads');
            Setting::query()->where('slug', 'favicon')->first()->update([
                'value' => $favicon
            ]);
        }

        $settings = [
            'name' => request()->input('name'),
            'primary-color' => request()->input('primary-color'),
            'secondary-color' => request()->input('secondary-color'),
        ];

        foreach ($settings as $slug => $value) {
            Setting::query()
                ->where('slug', $slug)
                ->update(['value' => $value]);
        }
        (new Setting)->reloadCache();
        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function financials()
    {
        request()->validate([
            'currency' => 'required|string|max:255',
            'currency_symbol' => 'required|string|max:5'
        ]);
        $settings = Setting::all();
        $settings->where('slug', 'currency')->first()->update([
            'value' => request()->input('currency'),
        ]);
        $settings->where('slug', 'currency-symbol')->first()->update([
            'value' => request()->input('currency_symbol'),
        ]);
        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function siteSettings()
    {
        request()->validate([
            'site-link' => 'required|url',
            'site-phone' => 'required|string',
            'site-email' => 'required|email',
            'site-address' => 'required|string',
        ]);

        $settings = Setting::all();
        $settings->where('slug', 'site-link')->first()->update([
            'value' => request()->input('site-link'),
        ]);
        $settings->where('slug', 'site-phone')->first()->update([
            'value' => request()->input('site-phone'),
        ]);
        $settings->where('slug', 'site-email')->first()->update([
            'value' => request()->input('site-email'),
        ]);
        $settings->where('slug', 'site-address')->first()->update([
            'value' => request()->input('site-address'),
        ]);

        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function edit(Setting $setting)
    {
        return view('setting::dashboard.edit', [
            'title' => 'edit setting',
            'setting' => $setting
        ]);
    }

    public function update(Setting $setting)
    {
        $setting->update(request()->validate([
            'slug' => 'required|string|min:2|max:255|unique:slug',
            'type' => 'required|string|min:2|max:255',
            'value' => 'nullable|string|max:999999',
        ]));

        return back()->with('alert-success', trans('dashboard.update.success'));
    }

    public function destroy(Setting $setting)
    {
        //here should check if file delete it

        $setting->delete();
        return back()->with('alert-success', trans('dashboard.delete.success'));
    }

    public function upload()
    {
        $filePath = $this->uploadFile('file', 'settings');

        return $this->successResponse(trans('dashboard.update.success'), [
            'filePath' => $filePath
        ]);
    }
}
