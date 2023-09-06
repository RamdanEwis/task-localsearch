<?php

namespace App\Http\Controllers;

use App\Enum\TaskStatus;
use App\Enum\UserType;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('super_admin', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $this->user();
        $tasks= Cache::remember($request->fullUrl(),10*60,function () use ($request,$user){
            $query = Task::when($this->user()->type === UserType::USER->value, function ($query) use ($user) {
                return $query->where('user_id', $user->id);
            });
            return $query->paginate(12);
        });
         return view('task.index' ,compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
       $tasks = Task::create(array_merge($request->validated(),[
           'user_id' => auth()->user()->id
       ]));
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('task.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Task $task)
    {
        if ($this->user()->type == UserType::USER->value && $this->user()->id != $task->user_id ){
            abort(403);
        }
        $task->update($request->validated());
        return redirect()->route('tasks.index');
    }
    public function status(Task $task)
    {
        $status = ($task->status == 'success') ?  TaskStatus::PROCESSING->value :  TaskStatus::SUCCESS->value ;
        $task->update([
            'status' => $status
        ]);
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task )
    {
        if ($this->user()->type == UserType::SUPER_ADMIN->value){
            $task->delete();
            return redirect()->route('tasks.index')->with('success');
        }
        abort(403);
    }

    public function user(  )
    {
    return Auth::user();
    }

}
