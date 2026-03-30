<div class="bg-gray-750 text-white w-64 min-h-screen p-4">
    <h2 class="text-xl font-bold mb-6">TRIPS ORGANISATOR</h2>
    <ul class="space-y-4">
        <li><a href="{{ route('dashboard') }}" class="block py-2 px-3 hover:bg-gray-600 rounded">Dashboard</a></li>
        <li><a href="{{ route('admin.trips.index') }}" class="block py-2 px-3 hover:bg-gray-600 rounded">Trips</a></li>
        <li><a href="{{ route('admin.trips.create') }}" class="block py-2 px-3 hover:bg-gray-600 rounded">Add Trip</a></li>
        <li><a href="{{ route('admin.comments.index') }}" class="block py-2 px-3 hover:bg-gray-600 rounded">Comments</a></li>
        <li><a href="{{ route('admin.clients.index') }}" class="block py-2 px-3 hover:bg-gray-600 rounded">Clients</a></li>
        <li><a href="{{ route('admin.bookings.index') }}" class="block py-2 px-3 hover:bg-gray-600 rounded">Bookings</a></li>
        <li><a href="{{ route('admin.messages.index') }}" class="block py-2 px-3 hover:bg-gray-600 rounded">Messages</a></li>
    </ul>
</div>
