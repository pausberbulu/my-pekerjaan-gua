@extends('components.layout')
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>{{ $workspace->name }}</h3>
                    <h3 class="text-end"><i class="ti ti-crown"></i> {{ $workspace->owner->name }}</h3>
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
            <div class="d-flex justify-content-between align-items-center">
                <h3>Tugas</h3>
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#makeTask" href="">Buat Tugas</button>
            </div>
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Ditugaskan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tenggat Waktu</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        <td>@fat</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>John</td>
                        <td>Doe</td>
                        <td>@social</td>
                        <td>@social</td>
                        <td>@social</td>
                    </tr>
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
                            <td>Tidak ada anggota bergabung</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="makeTask" tabindex="-1" aria-labelledby="makeTaskLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="makeTaskLabel">Buat Tugas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Nama Workspace" required />
                            <label for="floatingInput">Nama Tugas</label>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="assignFor" class="form-label">Tugaskan</label>
                            <select id="assignFor" class="form-select">
                            <option selected>Pilih anggota...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="due_date">Tenggat Waktu</label>
                            <input type="date" id="due_date" class="form-control" placeholder="Tenggat">
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