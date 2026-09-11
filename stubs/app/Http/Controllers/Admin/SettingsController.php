<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SettingsRegistry;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function __invoke(SettingsRegistry $settings): View
    {
        $panels = collect($settings->all())
            ->map(fn (array $panel) => [...$panel, 'label' => __($panel['label'])])
            ->all();

        return view('admin.settings', ['panels' => $panels]);
    }
}
