<?php

namespace App\Http\Controllers\Admin;

use stdClass;
use Inertia\Inertia;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SettingController extends BaseController
{

    public function index()
    {
        $data = new stdClass();
        foreach (Setting::get() as $model) {
            $value = is_numeric($model->value) ? (int) $model->value : $model->value;
            $group_name = $model->group_name;
            $key_name = $model->key_name;
            if ($group_name != 'config') {
                if (!isset($data->{$group_name})) {
                    $data->{$group_name} = new stdClass();
                }
                $data->{$group_name}->{$key_name} = $value;
            } else {
                $data->{$key_name} = $value;
            }
        }
        return Inertia::render('Admin/Settings/Index', ['setting' => $data]);
    }

    public function cache_clear()
    {
        Artisan::call('cache:clear');
        return redirect()->back()->with('success', 'Cache cleared successfully');
    }

    public function update(Request $request)
    {
        $data = $request->except('_token', 'tab');
        foreach ($data as $group_name => $array) {
            if (!is_array($array)) {
                $array = [$group_name => $array];
                $group_name = 'config';
            }
            foreach ($array as $key_name => $value) {
                if ($key_name) {
                    $model = Setting::firstOrCreate(['key_name' => $key_name, 'group_name' => $group_name]);
                    if (in_array($key_name, ['logo', 'favicon'])) {
                        $model->value = $value;
                    } else {
                        $model->value = $value;
                    }
                    $model->save();
                }
            }
        }
        return back();
    }


    public function update_per_page_limit(Request $request)
    {
        $this->setEnvValue('PER_PAGE_LIMIT', $request->per_page ?? 10);
        return response()->json(['success' => 'Updated Successfully'], 200);
    }
    public function change_dir(Request $request)
    {
        $this->setEnvValue('ADMIN_DIR', $request->checked === 'true' ? 'rtl' : 'ltr');
        return response()->json(['success' => 'Updated Successfully'], 200);
    }
}
