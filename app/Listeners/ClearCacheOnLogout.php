<?php

namespace App\Listeners;

use App\Events\UserLoggedOut;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class ClearCacheOnLogout
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserLoggedOut $event): void
    {
        $key = 'http://localhost/task-localsearch/public/tasks';
        if (Cache::has($key)){
            Cache::forget($key);
        }
    }
}
