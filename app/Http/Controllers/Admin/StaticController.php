<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\StaticSection;
use App\Http\Controllers\Controller;
use App\Http\Resources\StaticSectionResource;

class StaticController extends Controller
{
    public function index()
    {
        $section = [];
        foreach (StaticSection::get() as $sec) {
            $section[$sec->key] = json_decode($sec->value);
        }
        return Inertia::render('Admin/Static/Index', ['section' => $section]);
    }

    public function update(Request $request)
    {
        $data = $request->except('key');
        if ($request->banner) {
            $data['banner'] = get_org_img($request->banner);
        }

        if ($request->contact_banner) {
            $data['contact_banner'] = get_org_img($request->contact_banner);
        }
        $section = StaticSection::where('key', $request->key)->first();
        if ($section) {
            $section->update([
                'value' => json_encode($data)
            ]);
        } else {
            StaticSection::create([
                'key' => $request->key,
                'value' => json_encode($data)
            ]);
        }
        return back();
    }
}
