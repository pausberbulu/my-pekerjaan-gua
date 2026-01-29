@extends('components.layout')
@section('content')
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
    @if(Auth::user()->role != 'superadmin')
    <div class="row g-2 mb-3">
        <div class="col-6 d-grid">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#makeWorkspace">
                Buat Workspace
            </button>
        </div>
        <div class="col-6 d-grid">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#joinWorkspace">
                Gabung Workspace
            </button>
        </div>
    </div>
    <div class="card py-3 container-fluid">
    <h2 class="mb-4">Workspace saya</h2>
    
    <div class="row">
        @forelse ($workspaces as $workspace)
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card h-100"> <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="h3 mb-0">{{ $workspace->name }}</h3>
                            <h4 class="text-muted"><i class="ti ti-crown"></i> {{ $workspace->owner->name }}</h4>
                        </div>
                        <p class="h3 text-secondary mb-0 mt-2"><i class="ti ti-qrcode"></i> {{ $workspace->code }}</p>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <p class="card-text text-truncate">
                            {{ $workspace->description ? $workspace->description : 'Belum ada deskripsi' }}
                        </p>
                        
                        <div class="mt-auto"> <p class="h5 mb-2">
                                @if ($workspace->users->count() == 0)
                                    <i class="text-muted">Tidak ada anggota</i>
                                @else
                                    <i>{{ $workspace->users->count() }} Anggota</i>
                                @endif
                            </p>
                            <div class="d-grid">
                                <a class="btn btn-info" href="{{ route('workspace.show', ['id' => $workspace->id]) }}">Lihat</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center my-3">
                <span class="text-muted">Tidak ada workspace</span>
            </div>
        @endforelse
        </div>
    </div>
    <div class="card py-3">
        Workspace
        @forelse ($joinedWorkspace as $workspace)
            <div class="col-xl-4 col-md-6 col-sm-12 border mt-3">
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
                    @if ($workspace->users->count() == 0)
                        <i>Tidak ada anggota</i>
                    @else
                    <i>{{ $workspace->users->count() }} Anggota</i>
                    @endif
                    <div class="d-grid mt-3">
                        <a class="btn btn-info" href="{{ route('workspace.show', ['id' => $workspace->id]) }}">Lihat</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <span class="text-center my-3">Tidak ada workspace</span>
        @endforelse
    </div>
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
    @endif
    @if (Auth::user()->role == 'superadmin')
    <div class="card p-2">
        <h2 class="mb-3">List Workspace</h2>
        <table class="table table-responsive table-hover bg-light">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Workspace</th>
                <th scope="col">Kode</th>
                <th scope="col">Pemilik</th>
                <th scope="col">Anggota</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @forelse ($getWorkspaces as $workspace)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $workspace->name }}</td>
                    <td>{{ $workspace->code }}</td>
                    <td>{{ $workspace->owner->name }}</td>
                    <td>
                        @if ($workspace->users->count() == 0)
                            <i>Tidak ada anggota</i>
                        @else
                        <i>{{ $workspace->users->count() }} Anggota</i>
                        @endif
                    </td>
                    <td>...</td>
                </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada workspace yang dibuat</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif
@endsection