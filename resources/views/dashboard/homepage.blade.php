@extends('components.layout')
@section('content')
    <div class="col-xl-4 col-md-6">
        <div class="card bg-secondary-dark dashnum-card text-white overflow-hidden">
            <span class="round small"></span>
            <span class="round big"></span>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                    <div class="avtar avtar-lg">
                        <i class="text-white ti ti-package"></i>
                    </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <span class="text-white d-block f-34 f-w-500 my-2">
                            @if (Auth::user()->role == 'superadmin')
                            {{ $getWorkspace }}
                            @else
                            {{ $sumWorkspace }}
                            @endif
                            <i class="ti ti-arrow-up-right-circle opacity-50"></i>
                        </span>
                        <p class="mb-0 opacity-50">Jumlah Workspace</p>
                    </div>
                    @if(Auth::user()->role != 'superadmin')
                    <div class="col p-0">
                        <div class="d-grid mb-2">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#makeWorkspace">Buat Workspace</button>
                        </div>
                        <div class="d-grid">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#joinWorkspace">Gabung Workspace</button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card bg-primary-dark dashnum-card text-white overflow-hidden">
            <span class="round small"></span>
            <span class="round big"></span>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                    <div class="avtar avtar-lg">
                        <i class="text-white ti ti-list"></i>
                    </div>
                    </div>
                </div>
                <span class="text-white d-block f-34 f-w-500 my-2">
                    0
                    <i class="ti ti-arrow-up-right-circle opacity-50"></i>
                </span>
                <p class="mb-0 opacity-50">Jumlah Tugas</p>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->role != 'superadmin')
    <div class="card p-2">
        <h2 class="mb-3">Tugasku</h2>
        <table class="table table-responsive table-hover bg-light">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Ditugaskan</th>
                <th scope="col">Tenggat Waktu</th>
                <th scope="col">Workspace</th>
                <th scope="col">Waktu Ditugaskan</th>
                <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->user->name }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>{{ $task->workspace->name }}</td>
                    @php
                        $due_date = \Carbon\Carbon::parse($task->due_date)->translatedFormat('d F Y');
                    @endphp
                    <td>{{ $due_date }}</td>
                    <td>
                        @if ($task->status == 'todo')
                            <span class="badge bg-secondary">Ditugaskan</span>
                        @elseif ($task->status == 'in_progress')
                            <span class="badge bg-primary">Dikerjakan</span>
                        @elseif ($task->status == 'completed')
                            <span class="badge bg-success">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                    
                @endforelse
            </tbody>
        </table>
        <a class="ms-auto btn btn-info" href="{{ route('task') }}">Lihat selengkapnya</a>
    </div>
    @endif
    <div class="modal fade" id="makeWorkspace" tabindex="-1" aria-labelledby="makeWorkspaceLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('workspace.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="makeWorkspaceLabel">Buat Workspace</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Nama Workspace" required />
                            <label for="floatingInput">Nama Workspace</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Buat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="joinWorkspace" tabindex="-1" aria-labelledby="joinWorkspaceLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('workspace.join') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="joinWorkspaceLabel">Gabung Workspace</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="code" placeholder="Kode Workspace" required />
                            <label for="floatingInput">Kode Workspace</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Gabung</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection