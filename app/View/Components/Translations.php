<?php

namespace App\View\Components;

use Illuminate\Support\Arr;
use Illuminate\View\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class Translations extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
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
        // });

        return view('components.translations', [
            'translations' => $translations
        ]);
    }
}
