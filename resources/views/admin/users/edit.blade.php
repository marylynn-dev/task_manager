@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-2xl shadow-md mt-6">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Edit User</h2>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li class="text-sm">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-600 text-sm mb-1">Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:ring focus:border-blue-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 text-sm mb-1">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:ring focus:border-blue-300" required>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">Cancel</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Update User</button>
        </div>
    </form>
</div>
@endsection