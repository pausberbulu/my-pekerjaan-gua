<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WorkspaceRequest;

class WorkspaceController extends Controller
{
    public function index()
    {
        $workspaces = Workspace::where('owner_id', Auth::user()->id)->get();
        $joinedWorkspace = Auth::user()->members()->get();
        return view('dashboard.workspace.workspace', compact('workspaces', 'joinedWorkspace'));
    }

    public function show($id)
    {
        $workspace = Workspace::find($id);
        return view('dashboard.workspace.show', compact('workspace'));
    }

    public function store(WorkspaceRequest $request)
    {
        try {
            $data = $request->validated();
            Workspace::create($data);

            return redirect()->route('workspace')->with('success', 'Workspace berhasil dibuat');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('workspace')->with('error', 'Workspace gagal dibuat');
        }
    }

    public function join(Request $request)
    {
        try {
            $code = Workspace::where('code', $request->code)->first();
            if($code)
            {
                $code->users()->attach(Auth::user()->id);
                return redirect()->route('workspace')->with('success', 'Berhasil bergabung ke workspace');
            }
            return redirect()->route('workspace')->with('error', 'Workspace tidak ditemukan');
        } catch (\Throwable $th) {
           Log::error($th);
           return redirect()->route('workspace')->with('error', 'Gagal bergabung ke workspace');
        }
    }
}
