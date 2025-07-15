@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-2xl shadow-md mt-6">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Assign New Task</h2>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
        <ul class="list-disc pl-5 text-sm">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.tasks.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-600 text-sm mb-1">Task Title</label>
            <input type="text" name="title" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:ring focus:border-blue-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 text-sm mb-1">Description</label>
            <textarea name="description" rows="4" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:ring focus:border-blue-300"></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 text-sm mb-1">Assign To</label>
            <select name="user_id" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:ring focus:border-blue-300" required>
                <option value="">Select a user</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-600 text-sm mb-1">Deadline</label>
            <input type="date" name="deadline" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:ring focus:border-blue-300" required>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.tasks.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">Cancel</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Assign Task</button>
        </div>
    </form>
</div>
@endsection