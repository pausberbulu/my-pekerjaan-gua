@extends('components.layout')
@section('content')
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
                <tr>
                    <td colspan="6" class="text-center">Tidak ada tugas yang ditugaskan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection