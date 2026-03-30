<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Booking Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Booking #{{ $booking->id }}</h3>
                        <a href="{{ route('admin.bookings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Bookings
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Booking Information -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h4 class="text-md font-semibold mb-3">Booking Information</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="font-medium">Booking ID:</span>
                                    <span>{{ $booking->id }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">Status:</span>
                                    <span class="px-2 py-1 rounded-full text-xs {{ $booking->getStatusBadgeClass() }}">
                                        {{ ucfirst($booking->status ?? 'pending') }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">Number of People:</span>
                                    <span>{{ $booking->num_people }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">Payment Method:</span>
                                    <span>{{ ucfirst($booking->payment_method) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">Booking Date:</span>
                                    <span>{{ $booking->created_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Client Information -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h4 class="text-md font-semibold mb-3">Client Information</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="font-medium">Name:</span>
                                    <span>{{ $booking->client->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">Email:</span>
                                    <span>{{ $booking->client->email }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">Phone:</span>
                                    <span>{{ $booking->client->phone }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">Address:</span>
                                    <span>{{ $booking->client->address }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trip Information -->
                    <div class="mt-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <h4 class="text-md font-semibold mb-3">Trip Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="font-medium">Trip Title:</span>
                                        <span>{{ $booking->trip->title }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium">Duration:</span>
                                        <span>{{ $booking->trip->duration }} days</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium">Price:</span>
                                        <span>${{ $booking->trip->price }}</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="font-medium">Total Amount:</span>
                                        <span class="text-lg font-bold">${{ $booking->trip->price * $booking->num_people }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Special Requests -->
                    @if($booking->special_requests)
                        <div class="mt-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h4 class="text-md font-semibold mb-3">Special Requests</h4>
                            <p class="text-gray-700 dark:text-gray-300">{{ $booking->special_requests }}</p>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="mt-6 flex space-x-4">
                        @if($booking->status !== 'completed')
                            <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Mark as Completed
                                </button>
                            </form>
                        @endif

                        @if($booking->status !== 'cancelled')
                            <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                    Cancel Booking
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this booking?')">
                                Delete Booking
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
