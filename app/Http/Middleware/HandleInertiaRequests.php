<?php

namespace App\Http\Middleware;

use stdClass;
use App\Models\Setting;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    public function rootView(Request $request)
    {
        if ($request->routeIs('admin.*') || $request->routeIs('login')) {
            return 'admin';
        }
        return 'app';
    }

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed[]
     */
    public function share(Request $request)
    {
        $activeRouteName = Route::current()->getName();
        $full_activeRouteName = $activeRouteName;
        $activeRouteName = str_replace('.index', '', $activeRouteName);
        $activeRouteName = str_replace('.create', '', $activeRouteName);
        $activeRouteName = str_replace('.show', '', $activeRouteName);
        $activeRouteName = str_replace('.edit', '', $activeRouteName);
        $activeRouteName = str_replace('admin.', '', $activeRouteName);



        $locales = config('translatable.locales');

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'locale' => function () {
                return app()->getLocale();
            },
            'translations' => $this->translations(),
            'websetting' => $this->getSetting(),
            'locales' => $locales,
            'ziggy' => function () use ($request, $activeRouteName) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                    'query' => $request->query(),
                    'activeRouteName' => $activeRouteName,

                ]);
            },
        ]);
    }

    public function translations()
    {
        $locale = App::getLocale();
        // $translations = Cache::rememberForever("translations_$locale", function () use ($locale) {
        $phpTranslation = [];
        $jsonTranslation = [];
        $translations = [];
        if (File::exists(base_path("lang/$locale"))) {
            $phpTranslation = collect(File::allFiles(base_path("lang/$locale")))->filter(function ($file) {
                return $file->getExtension() === 'php';
            })->flatMap(function ($file) {
                return Arr::dot(File::getRequire($file->getRealPath()));
            })->toArray();
        }

        if (File::exists(base_path("lang/$locale.json"))) {
            $jsonTranslation = json_decode(File::get(base_path("lang/$locale.json")), true);
        }

        $translations = array_merge($phpTranslation, $jsonTranslation);
        return $translations;
    }

    public function getSetting()
    {
        $setting = new stdClass();
        foreach (Setting::get() as $model) {
            $value = is_numeric($model->value) ? (int) $model->value : $model->value;
            $group_name = $model->group_name;
            $key_name = $model->key_name;
            if ($group_name != 'config') {
                if (!isset($setting->{$group_name})) {
                    $setting->{$group_name} = new stdClass();
                }
                $setting->{$group_name}->{$key_name} = $value;
            } else {
                $setting->{$key_name} = $value;
            }
        }
        return $setting;
    }
}
