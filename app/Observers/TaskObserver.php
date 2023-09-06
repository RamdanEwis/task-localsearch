<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Facades\Cache;

class TaskObserver
{
    public function created(Task $task): void
    {
        $this->clearCourseCache();
    }

    /**
     * Handle the Course "updated" event.
     *
     * @param \App\Models\Task $task
     *
     * @return void
     */
    public function updated(Task $task): void
    {
        $this->clearCourseCache();
    }

    /**
     * Handle the Course "deleted" event.
     *
     * @param  \App\Models\Task $task
     * @return void
     */
    public function deleted(Task $task): void
    {
        $this->clearCourseCache();
    }

    /**
     * Handle the Course "created" event.
     *
     * @return void
     */

    protected function clearCourseCache(): void
    {
        $key = 'http://localhost/task-localsearch/public/tasks';
        if (Cache::has($key)){
            Cache::forget($key);
        }
    }
}
