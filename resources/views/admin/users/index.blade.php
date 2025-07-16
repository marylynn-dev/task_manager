<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Manage Users</h2>
    </x-slot>

    <div class="p-4">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add User</a>

            <form method="GET" action="{{ route('admin.users.index') }}" class="flex space-x-2">
                <input type="text" name="search" placeholder="Search users..." value="{{ $search ?? '' }}"
                    class="border rounded px-3 py-1 focus:outline-none focus:ring focus:border-blue-300">
                <button type="submit" class="bg-gray-600 text-white px-3 py-1 rounded">Search</button>
            </form>
        </div>

        <table class="mt-4 w-full border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-3 py-2">Name</th>
                    <th class="px-3 py-2">Email</th>
                    <th class="px-3 py-2">Role</th>
                    <th class="px-3 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-3 py-2">{{ $user->name }}</td>
                        <td class="px-3 py-2">{{ $user->email }}</td>
                        <td class="px-3 py-2">{{ $user->role }}</td>
                        <td class="px-3 py-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-500">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500" onclick="return confirm('Delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- <div class="mt-4">
            {{ $users->appends(['search' => $search])->links() }}
        </div> -->
    </div>
</x-app-layout>
