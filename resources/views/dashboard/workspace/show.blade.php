@extends('components.layout')
@section('content')
<div class="col-sm-12">
    <div class="card">
            @include('components.partials.alerts')
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>{{ $workspace->name }}</h3>
                    <h4 class="text-end">
                        <i class="ti ti-crown"></i> {{ $workspace->owner->name }}
                        @if (Auth::user()->id == $workspace->owner_id)
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editWorkspace"><i class="ti ti-edit"></i></button>
                        @endif
                    </h4>
                </div>
                <h5><i class="ti ti-qrcode"></i> {{ $workspace->code }}</h5>
            </div>
            <div class="card-body">
                <p>{{ $workspace->description ? $workspace->description : 'Belum ada deskripsi' }}</p>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-md-12">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Tugas</h3>
                @if (Auth::user()->id == $workspace->owner_id)
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#makeTask">Buat Tugas</button>
                @endif
            </div>
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Ditugaskan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tenggat Waktu</th>
                    @if (Auth::user()->id == $workspace->owner_id)
                    <th scope="col">Aksi</th>
                    @endif
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
                        @if (Auth::user()->id == $workspace->owner_id)
                        <td>
                        @if (Auth::user()->id == $workspace->owner_id)
                            <button class="btn btn-light" data-bs-toggle="modal" data-id="{{ $task->id }}" data-task-name="{{ $task->name }}" data-due="{{ $task->due_date }}" data-user-id="{{ $task->user_id }}" data-bs-target="#editTask">...</button>
                        @endif
                        </td>
                        @endif
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
                        <td>
                            @if($member->isActive == 1)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Tidak Aktif</span>
                            @endif
                        </td>
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
    <div class="modal fade" id="editWorkspace" tabindex="-1" aria-labelledby="editWorkspaceLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('workspace.update', ['id' => $workspace->id]) }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="makeTaskLabel">Sunting Workspace</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nameWorkspace" name="name" value="{{ $workspace->name }}" placeholder="Nama Workspace" required />
                            <label for="nameWorkspace">Nama Workspace</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ $workspace->description }}</textarea>
                            <label for="description">Deskripsi</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editTask" tabindex="-1" aria-labelledby="editTaskLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content py-3">
            <form id="editTaskForm" method="post">
                @csrf
                @method('PUT')

                <div class="modal-header">
                <h1 class="modal-title fs-5">Sunting Tugas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="task_name" name="name" required>
                    <label for="task_name">Nama Tugas</label>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tugaskan</label>
                    <select name="user_id" id="assignFor" class="form-select">
                    <option hidden>Pilih anggota...</option>
                    @foreach ($workspace->users as $member)
                        <option value="{{ $member->id }}">
                        {{ $member->name }} - {{ $member->username }}
                        </option>
                    @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tenggat Waktu</label>
                    <input type="date" id="task_due" name="due_date" class="form-control">
                </div>
                </div>

                <div class="modal-footer" id="edit-footer">
                <button type="button" id="btn-delete-toggle" class="btn btn-danger">
                    Hapus Tugas
                </button>
                <button type="button" id="btn-close" class="btn btn-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
                <button type="submit" id="btn-save" class="btn btn-primary">
                    Simpan
                </button>
                </div>
            </form>

            <div class="modal-footer d-none" id="delete-footer">
                <form id="form-destroy-task" method="post">
                @csrf
                @method('DELETE')

                <div class="d-flex gap-3 align-items-center">
                    <span>Apakah kamu yakin menghapus tugas ini?</span>
                    <button type="submit" class="btn btn-danger">
                    Ya, saya yakin
                    </button>
                </div>
                </form>
            </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const editModal = document.getElementById('editTask')

        const editForm   = document.getElementById('editTaskForm')
        const deleteForm = document.getElementById('form-destroy-task')

        const editFooter   = document.getElementById('edit-footer')
        const deleteFooter = document.getElementById('delete-footer')

        const btnDeleteToggle = document.getElementById('btn-delete-toggle')
        const btnClose = document.getElementById('btn-close')
        const btnSave  = document.getElementById('btn-save')

        let deleteMode = false

        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget

            const id     = button.getAttribute('data-id')
            const name   = button.getAttribute('data-task-name')
            const due    = button.getAttribute('data-due')
            const userId = button.getAttribute('data-user-id')

            editModal.querySelector('#task_name').value = name
            editModal.querySelector('#task_due').value  = due
            editModal.querySelector('#assignFor').value = userId

            editForm.action   = `/ubah-tugas/${id}`
            deleteForm.action = `/hapus-tugas/${id}`

            resetDeleteMode()
        })

        btnDeleteToggle.addEventListener('click', function () {
            deleteMode = !deleteMode

            if (deleteMode) {
            deleteFooter.classList.remove('d-none')

            btnDeleteToggle.textContent = 'Batal'
            btnDeleteToggle.classList.replace('btn-danger', 'btn-warning')

            btnClose.disabled = true
            btnSave.disabled  = true
            } else {
            resetDeleteMode()
            }
        })

        editModal.addEventListener('hidden.bs.modal', resetDeleteMode)

        function resetDeleteMode () {
            deleteMode = false
            deleteFooter.classList.add('d-none')

            btnDeleteToggle.textContent = 'Hapus Tugas'
            btnDeleteToggle.classList.remove('btn-warning')
            btnDeleteToggle.classList.add('btn-danger')

            btnClose.disabled = false
            btnSave.disabled  = false
        }
        })
    </script>


@endsection