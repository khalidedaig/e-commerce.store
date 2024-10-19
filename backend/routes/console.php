<?php

use App\Console\Commands\MoveDelivered;
use Illuminate\Support\Facades\Schedule;



Schedule::command(MoveDelivered::class)
    ->dailyAt("12:00");
