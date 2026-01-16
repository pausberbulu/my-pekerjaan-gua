@extends('components.layout')
@section('content')
<div class="card p-2">
        <h2 class="mb-3">Daftar Pengguna</h2>
        <table class="table table-responsive table-hover bg-light">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Nama Pengguna</th>
                <th scope="col">Email</th>
                <th scope="col">Workspace</th>
                <th scope="col">Waktu Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->ownedWorkspaces->count() == 0)
                            Tidak ada workspace
                        @else
                        {{ $user->ownedWorkspaces->count().' Workspace' }}
                        @endif
                    </td>
                    @php
                        $joined_at = \Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y');
                    @endphp
                    <td>{{ $joined_at }}</td>
                </tr>
                @empty
                    
                @endforelse
            </tbody>
        </table>
    </div>
@endsection