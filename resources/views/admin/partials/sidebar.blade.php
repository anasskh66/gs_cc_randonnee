<div class="bg-gray-700 text-white w-64 min-h-screen p-4">
    <ul class="space-y-4">
        <li><a href="{{ route('dashboard') }}" class="block py-2 px-3 hover:bg-gray-600 rounded">Dashboard</a></li>
        <li><a href="{{ route('admin.trips.index') }}" class="block py-2 px-3 hover:bg-gray-600 rounded">Trips</a></li>
        <li><a href="{{ route('admin.trips.create') }}" class="block py-2 px-3 hover:bg-gray-600 rounded">Add Trip</a></li>
        <li><a href="{{ route('admin.comments.index') }}" class="block py-2 px-3 hover:bg-gray-600 rounded">Show Comments</a></li>
        <li><a href="{{ route('admin.clients.index') }}" class="block py-2 px-3 hover:bg-gray-600 rounded">Show Clients/Travelers</a></li>
    </ul>
</div>
