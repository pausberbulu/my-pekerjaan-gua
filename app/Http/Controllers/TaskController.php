<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function task()
    {
        $tasks = Auth::user()->tasks()->get();

        return view('dashboard.task.task', compact('tasks'));
    }
    public function store(TaskRequest $request)
    {
        try {
            $data = $request->validated();
            Task::create($data);

            return redirect()->back()->with('success', 'Task berhasil dibuat');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Task gagal dibuat');
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $task = Task::find($request->task_id);
            $task->status = $request->status;
            $task->save();
            return redirect()->back()->with('success', 'Status task berhasil diubah');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Status task gagal diubah');
        }
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::find($id);
        try {
            $data = $request->validated();
            $task->update($data);

            return redirect()->back()->with('success', 'Berhasil mengubah task');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Gagal mengubah task');
        }
    }

    public function destroy($id)
    {
        try {
            Task::find($id)->delete();
            return redirect()->back()->with('success', 'Task berhasil dihapus');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Task gagal dihapus');
        }
    }
}
