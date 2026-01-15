@extends('components.layout')
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>{{ $workspace->name }}</h3>
                    <h4 class="text-end"><i class="ti ti-crown"></i> {{ $workspace->owner->name }}</h4>
                </div>
                <h5><i class="ti ti-qrcode"></i> {{ $workspace->code }}</h5>
            </div>
            <div class="card-body">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe incidunt minus doloribus eos quisquam autem amet soluta unde labore asperiores?</p>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-md-12">
        <div class="card p-3">
            @if (session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2" role="alert">
                <i class="ti ti-circle-check fs-3"></i>
                <span class="mt-1">{{ session('success') }}</span>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger d-flex align-items-center gap-2" role="alert">
                <i class="ti ti-x fs-3"></i>
                <span class="mt-1">{{ session('error') }}</span>
            </div>
            @endif
            <div class="d-flex justify-content-between align-items-center">
                <h3>Tugas</h3>
                @if (Auth::user()->id == $workspace->owner_id)
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#makeTask" href="">Buat Tugas</button>
                @endif
            </div>
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Ditugaskan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tenggat Waktu</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($workspace->tasks as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td>
                            @if ($task->user->username == Auth::user()->username)
                            <h3>
                                <span class="badge bg-success">
                                {{ $task->user->name.' ('.$task->user->username.')' }}
                                </span>
                            </h3>
                            @else
                            {{ $task->user->name.' ('.$task->user->username.')' }}
                            @endif
                        </td>
                        <td>
                            @if($task->status == 'todo')
                            <div class="position-relative">
                                <button @if (Auth::user()->id != $task->user_id && Auth::user()->id != $task->workspace->owner_id) disabled @endif class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTask-{{ $task->id }}" aria-expanded="false" aria-controls="collapseTask-{{ $task->id }}" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                    Ditugaskan
                                </button>
                                <div class="collapse position-absolute" id="collapseTask-{{ $task->id }}">
                                    <div class="card card-body">
                                        <div class="d-flex gap-3">
                                            <div>
                                                <form action="{{ route('task.update-status') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                    <input type="hidden" class="btn-check" name="status" value="todo" id="todo">
                                                    <button type="submit" class="btn btn-secondary" for="todo">Todo</button>
                                                </form>
                                            </div>
                                            <div>
                                                <form action="{{ route('task.update-status') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                    <input type="hidden" class="btn-check" name="status" value="in_progress" id="proses">
                                                    <button type="submit" class="btn btn-outline-warning" for="proses">Proses</button>
                                                </form>
                                            </div>
                                            <div>
                                                <form action="{{ route('task.update-status') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                    <input type="hidden" class="btn-check" name="status" value="completed" id="selesai">
                                                    <button type="submit" class="btn btn-outline-success" for="selesai">Selesai</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif($task->status == 'in_progress')
                            <div class="position-relative">
                                <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTask-{{ $task->id }}" aria-expanded="false" aria-controls="collapseTask-{{ $task->id }}" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                    Proses
                                </button>
                                <div class="collapse position-absolute" id="collapseTask-{{ $task->id }}">
                                    <div class="card card-body">
                                        <div class="d-flex gap-2">
                                            <div>
                                                <form action="{{ route('task.update-status') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                    <input type="hidden" class="btn-check" name="status" value="todo" id="todo">
                                                    <button type="submit" class="btn btn-outline-secondary" for="todo">Todo</button>
                                                </form>
                                            </div>
                                            <div>
                                                <form action="{{ route('task.update-status') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                    <input type="hidden" class="btn-check" name="status" value="in_progress" id="proses">
                                                    <button type="submit" class="btn btn-warning" for="proses">Proses</button>
                                                </form>
                                            </div>
                                            <div>
                                                <form action="{{ route('task.update-status') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                    <input type="hidden" class="btn-check" name="status" value="completed" id="selesai">
                                                    <button type="submit" class="btn btn-outline-success" for="selesai">Selesai</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="position-relative">
                                <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTask-{{ $task->id }}" aria-expanded="false" aria-controls="collapseTask-{{ $task->id }}" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                    Selesai
                                </button>
                                <div class="collapse position-absolute" id="collapseTask-{{ $task->id }}">
                                    <div class="card card-body">
                                        <div class="d-flex gap-2">
                                            <div>
                                                <form action="{{ route('task.update-status') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                    <input type="hidden" class="btn-check" name="status" value="todo" id="todo">
                                                    <button type="submit" class="btn btn-outline-secondary" for="todo">Todo</button>
                                                </form>
                                            </div>
                                            <div>
                                                <form action="{{ route('task.update-status') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                    <input type="hidden" class="btn-check" name="status" value="in_progress" id="proses">
                                                    <button type="submit" class="btn btn-outline-warning" for="proses">Proses</button>
                                                </form>
                                            </div>
                                            <div>
                                                <form action="{{ route('task.update-status') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                    <input type="hidden" class="btn-check" name="status" value="completed" id="selesai">
                                                    <button type="submit" class="btn btn-success" for="selesai">Selesai</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </td>
                        @php
                            $due_date = \Carbon\Carbon::parse($task->due_date)->translatedFormat('d F Y');
                        @endphp
                        <td>{{ $due_date }}</td>
                        <td>...</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada tugas yang dibuat</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-xl-4 col-md-12">
        <div class="card p-3">
            <h3>Anggota</h3>
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($workspace->users as $member)
                    <tr>
                        <td>{{ $member->name }}</td>
                        <td>Aktif</td>
                        <td>...</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada anggota yang bergabung</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="makeTask" tabindex="-1" aria-labelledby="makeTaskLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('task.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="makeTaskLabel">Buat Tugas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="hidden" name="workspace_id" value="{{ $workspace->id }}">
                            <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Nama Workspace" required />
                            <label for="floatingInput">Nama Tugas</label>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="assignFor" class="form-label">Tugaskan</label>
                            <select name="user_id" id="assignFor" class="form-select">
                                <option hidden>Pilih anggota...</option>
                                @forelse ($workspace->users as $member)
                                    <option value="{{ $member->id }}">{{ $member->name.' - '.$member->username }}</option>
                                @empty
                                <option>Tidak ada anggota</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="due_date">Tenggat Waktu</label>
                            @php
                                $dateNow = \Carbon\Carbon::now()->format('Y-m-d');
                            @endphp
                            <input type="date" id="due_date" name="due_date" min="{{ $dateNow }}" class="form-control" placeholder="Tenggat">
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
@endsection