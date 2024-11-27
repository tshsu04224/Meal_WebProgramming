<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;
use Carbon\Carbon;

Schedule::call(function () {
    $now = Carbon::now();
    $currentDate = $now->toDateString();
    $currentTime = $now->toTimeString();

    DB::table('posts')
        ->where('date', '<=', $currentDate)
        ->where('time', '<=', $currentTime)
        ->where('status', 0) 
        ->update(['status' => 1]);
})->everySecond();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
