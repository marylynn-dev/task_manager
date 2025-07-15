@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">My Tasks</h2>

    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white shadow rounded-xl overflow-x-auto">
        <table class="min-w-full text-sm text-left divide-y divide-gray-200">
            <thead class="bg-gray-100 text-gray-600 font-semibold">
                <tr>
                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3">Deadline</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Update</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($tasks as $task)
                <tr>
                    <td class="px-6 py-4">{{ $task->title }}</td>
                    <td class="px-6 py-4">{{ $task->description ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $task->deadline }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-white {{ 
                                $task->status === 'Pending' ? 'bg-yellow-500' : (
                                $task->status === 'In Progress' ? 'bg-blue-500' : 'bg-green-600') }}">
                            {{ $task->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('tasks.update', $task) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PUT')
                            <select name="status" class="border rounded px-2 py-1 text-sm">
                                <option {{ $task->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option {{ $task->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option {{ $task->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            <button class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 text-xs">Save</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No tasks assigned to you.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection