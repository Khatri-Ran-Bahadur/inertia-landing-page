<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\AboutUs;
use App\Models\Service;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\StaticSection;
use Illuminate\Support\Carbon;
use App\Http\Resources\Frontend\AboutUsResource;
use App\Http\Resources\Frontend\ServiceResource;

class FrontendController extends Controller
{
    public function index()
    {
        $abouts = AboutUsResource::collection(AboutUs::active()->get());
        $services = ServiceResource::collection(Service::active()->get());
        $section = [];
        $locale =  app()->getLocale();
        $default = 'en';
        foreach (StaticSection::get() as $sec) {
            $value = json_decode($sec->value, true);
            $newvalue = [];
            foreach ($value[$locale] as $key => $v) {
                $newvalue[$key] = $v ?: ($value[$default][$key] ?? '');
            }
            $newvalue['banner'] = $value['banner'];
            $newvalue['contact_banner'] = $value['contact_banner'];
            $section[$sec->key] = $newvalue;
        }
        return Inertia::render('Frontend/Home', [
            'abouts' => $abouts,
            'services' => $services,
            'section' => $section
        ]);
    }

    public function feedback(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'phone_email' => 'required:255',
            'subject' => 'required|max:255',
            'message' => 'required|max:1000'
        ]);

        if (!Feedback::where('ip', $request->ip)->whereDate('created_at', Carbon::today())->exists()) {
            $data = $request->all();
            $data['ip'] = $request->ip();
            Feedback::create($data);
        }

        return back();
    }
}
