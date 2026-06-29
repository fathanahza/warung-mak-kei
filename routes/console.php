<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Bersihkan visitor logs yang lebih dari 90 hari
Schedule::call(function () {
    \App\Models\VisitorLog::where('created_at', '<', now()->subDays(90))->delete();
    \App\Models\WhatsappClick::where('created_at', '<', now()->subDays(90))->delete();
})->daily()->at('02:00');
