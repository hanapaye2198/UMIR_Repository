@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 flex items-center gap-3">
                <div class="p-3 bg-gradient-to-r from-red-500 to-red-600 rounded-lg shadow">
                    <i class="fas fa-user-shield text-white text-2xl"></i>
                </div>
                <span>Admin Dashboard</span>
            </h1>
            <p class="text-gray-500 mt-2">Manage your repository efficiently</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                <i class="fas fa-circle text-xs mr-1"></i> Online
            </span>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <a href="{{ route('submission.index') }}" class="bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white p-6 rounded-2xl shadow-lg transform hover:-translate-y-1 transition duration-300 flex items-center justify-between">
            <div>
                <h2 class="font-bold text-xl">Submissions</h2>
                <p class="text-indigo-100 text-sm mt-1">Manage submitted papers</p>
                <div class="mt-3 flex items-center">
                    <span class="text-2xl font-bold">{{ $submissionCount }}</span>
                    <span class="ml-2 text-sm bg-indigo-400 bg-opacity-30 px-2 py-1 rounded-full">  +{{ $newSubmissions }} new</span>
                </div>
            </div>
            <div class="p-4 bg-white bg-opacity-20 rounded-full">
                <i class="fas fa-tasks text-3xl"></i>
            </div>
        </a>

        <a href="{{ route('collections.index') }}" class="bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white p-6 rounded-2xl shadow-lg transform hover:-translate-y-1 transition duration-300 flex items-center justify-between" style="background-color: green;">
            <div>
                <h2 class="font-bold text-xl">Collections</h2>
                <p class="text-amber-100 text-sm mt-1">Organize your content</p>
                <div class="mt-3 flex items-center">
                    <span class="text-2xl font-bold">{{ $collectionCount }}</span>
                    <span class="ml-2 text-sm bg-amber-400 bg-opacity-30 px-2 py-1 rounded-full">{{ $activeCollections }} active</span>
                </div>
            </div>
            <div class="p-4 bg-white bg-opacity-20 rounded-full">
                <i class="fas fa-layer-group text-3xl"></i>
            </div>
        </a>

        <a href="{{ route('communities.index') }}" class="bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white p-6 rounded-2xl shadow-lg transform hover:-translate-y-1 transition duration-300 flex items-center justify-between" style="background-color: red;">
            <div>
                <h2 class="font-bold text-xl">Communities</h2>
                <p class="text-teal-100 text-sm mt-1">Manage departments</p>
                <div class="mt-3 flex items-center">
                    <span class="text-2xl font-bold">{{ $communityCount }}</span>
                    <span class="ml-2 text-sm bg-teal-400 bg-opacity-30 px-2 py-1 rounded-full">  {{ $newCommunities }} new</span>
                </div>
            </div>
            <div class="p-4 bg-white bg-opacity-20 rounded-full">
                <i class="fas fa-sitemap text-3xl"></i>
            </div>
        </a>
    </div>

    <!-- User Management Section -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div class="mb-4 sm:mb-0">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-3">
                    <div class="p-2 bg-gray-100 rounded-lg">
                        <i class="fas fa-users-cog text-gray-600"></i>
                    </div>
                    <span>User Management</span>
                </h2>
                <p class="text-gray-500 text-sm mt-1">Approve new users and manage permissions</p>
            </div>
            <div class="relative">
                <input type="text" placeholder="Search users..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <span class="text-blue-600 font-medium">{{ substr($user->first_name, 0, 1) }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</div>

                                        <div class="text-sm text-gray-500">Member since {{ $user->created_at->format('M Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' :
                                       ($user->role === 'librarian' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $user->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    <i class="fas {{ $user->status === 'approved' ? 'fa-check-circle' : 'fa-clock' }} mr-1"></i>
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
    <div class="flex justify-end space-x-2">
        @if($user->status !== 'approved')
        <form method="POST" action="{{ route('admin.users.approve', $user->id) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                <i class="fas fa-user-check mr-1"></i> Approve
            </button>
        </form>
        @endif

        <button
            onclick="openManageModal({{ $user->id }}, '{{ $user->role }}', '{{ $user->status }}')"
            class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50">
            <i class="fas fa-cog mr-1"></i> Manage
        </button>
    </div>
</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
            <div class="text-sm text-gray-500">
                Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">{{ count($users) }}</span> users
            </div>
            <div class="flex space-x-2">
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Previous
                </button>
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Next
                </button>
            </div>
        </div>
    </div>
</div>
<dialog id="manageModal" class="rounded-md max-w-md w-full p-0 overflow-hidden shadow-lg z-50">
    <form id="manageForm" method="POST" action="{{ route('admin.users.update') }}" class="bg-white p-6 space-y-4">
        @csrf
        @method('PATCH')
        <input type="hidden" name="user_id" id="user_id">

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select name="role" id="user_role" class="w-full border rounded p-2">
                <option value="student">Student</option>
                <option value="faculty">Faculty</option>
                <option value="librarian">Librarian</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" id="user_status" class="w-full border rounded p-2">
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
            </select>
        </div>

        <div class="flex justify-end gap-2 pt-4">
            <button type="button" onclick="document.getElementById('manageModal').close()" class="px-4 py-2 border border-gray-300 rounded-md">
                Cancel
            </button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Save
            </button>
        </div>
    </form>
</dialog>
<script>
    function openManageModal(userId, role, status) {
        document.getElementById('user_id').value = userId;
        document.getElementById('user_role').value = role;
        document.getElementById('user_status').value = status;
        document.getElementById('manageModal').showModal();
    }
</script>

@endsection
