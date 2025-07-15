@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">All Tasks</h2>

    <a href="{{ route('admin.tasks.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Assign New Task</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-xl shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-600">
                <tr>
                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Assigned To</th>
                    <th class="px-6 py-3">Deadline</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
                @forelse($tasks as $task)
                    <tr>
                        <td class="px-6 py-4">{{ $task->title }}</td>
                        <td class="px-6 py-4">{{ $task->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $task->deadline }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-white {{ 
                                $task->status === 'Pending' ? 'bg-yellow-500' : (
                                $task->status === 'In Progress' ? 'bg-blue-500' : 'bg-green-600') }}">
                                {{ $task->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('admin.tasks.edit', $task) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form method="POST" action="{{ route('admin.tasks.destroy', $task) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline" onclick="return confirm('Delete this task?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No tasks available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
