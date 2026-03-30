<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $trip->title }} - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
<!-- Navigation - Same as welcome page -->
<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}" class="text-2xl font-bold text-indigo-600">TRIPS ORGANISER</a>
                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <a href="{{ route('welcome') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 px-3 py-2">
                    ← Back to Home
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Trip Details -->
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <!-- Back Button -->
    <div class="mb-8">
        <a href="{{ route('welcome') }}#destinations" class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Destinations
        </a>
    </div>

    <!-- Trip Image -->
    <div class="mb-8 relative">
        <img src="{{ $trip->image_path ? asset('storage/' . $trip->image_path) : '/api/placeholder/800/400' }}"
             alt="{{ $trip->title }}"
             class="w-full h-64 md:h-96 object-cover rounded-lg shadow-lg">

        <!-- Trip Type Badge Overlay -->
        <div class="absolute top-4 left-4">
            @if($trip->type === 'hiking')
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 shadow-lg">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l14 9-14 9V3z"></path>
                    </svg>
                    Hiking
                </span>
            @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 shadow-lg">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    Trip
                </span>
            @endif
        </div>

        <!-- Availability Badge Overlay -->
        @if($trip->max_places)
            <div class="absolute top-4 right-4">
                @if($trip->is_fully_booked)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 shadow-lg">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Fully Booked
                    </span>
                @elseif($trip->available_places <= 3)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 shadow-lg">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        Only {{ $trip->available_places }} Left
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 shadow-lg">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ $trip->available_places }} Places Available
                    </span>
                @endif
            </div>
        @endif
    </div>

    <!-- Trip Information -->
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-6">
            <div class="flex-1">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $trip->title }}</h1>
            </div>
            <div class="mt-4 md:mt-0 md:ml-6">
                @if($trip->type === 'hiking')
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-base font-medium bg-green-100 text-green-800">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l14 9-14 9V3z"></path>
                        </svg>
                        Hiking Adventure
                    </span>
                @else
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-base font-medium bg-blue-100 text-blue-800">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Travel Experience
                    </span>
                @endif
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-4 mb-6">
            <div class="flex items-center text-gray-600">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="text-lg">{{ $trip->location }}</span>
            </div>

            <div class="flex items-center text-gray-600">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-lg">{{ $trip->duration }}</span>
            </div>

            @if($trip->date)
                <div class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-lg">{{ \Carbon\Carbon::parse($trip->date)->format('F d, Y') }}</span>
                </div>
            @endif

            @if($trip->price)
                <div class="flex items-center text-green-600 font-bold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-lg">${{ number_format($trip->price, 2) }}</span>
                </div>
            @endif

            <!-- Places Information -->
            @if($trip->max_places)
                <div class="flex items-center {{ $trip->is_fully_booked ? 'text-red-600' : ($trip->available_places <= 3 ? 'text-yellow-600' : 'text-green-600') }}">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="text-lg font-medium">
                        @if($trip->is_fully_booked)
                            Fully Booked ({{ $trip->max_places }} places)
                        @else
                            {{ $trip->available_places }} of {{ $trip->max_places }} places available
                        @endif
                    </span>
                </div>
            @endif
        </div>

        <!-- Availability Alert -->
        @if($trip->max_places)
            @if($trip->is_fully_booked)
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Trip Fully Booked</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <p>This {{ $trip->type === 'hiking' ? 'hiking adventure' : 'trip' }} has reached its maximum capacity of {{ $trip->max_places }} people and is currently fully booked. Please check back later or contact us to be added to the waiting list.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($trip->available_places <= 3)
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Limited Availability</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>Only {{ $trip->available_places }} {{ $trip->available_places == 1 ? 'place' : 'places' }} remaining for this {{ $trip->type === 'hiking' ? 'hiking adventure' : 'trip' }}. Book now to secure your spot!</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        <!-- Trip Type Description -->
        <div class="bg-gray-50 rounded-lg p-4 mb-8">
            @if($trip->type === 'hiking')
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-green-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l14 9-14 9V3z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-green-800">Hiking Adventure</h3>
                        <p class="text-green-700 text-sm">This is an outdoor hiking experience that will take you through beautiful natural landscapes, trails, and scenic routes. Perfect for nature lovers and adventure seekers!</p>
                    </div>
                </div>
            @else
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-blue-800">Travel Experience</h3>
                        <p class="text-blue-700 text-sm">This is a comprehensive travel experience that includes sightseeing, cultural exploration, and comfortable accommodations. Ideal for those who want to explore destinations in comfort!</p>
                    </div>
                </div>
            @endif
        </div>

        @if($trip->description)
            <div class="prose max-w-none mb-8">
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">About This {{ $trip->type === 'hiking' ? 'Hiking Adventure' : 'Trip' }}</h2>
                <p class="text-gray-700 text-lg leading-relaxed">{{ $trip->description }}</p>
            </div>
        @endif

        <!-- Booking Section -->
        <div class="border-t pt-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Book This {{ $trip->type === 'hiking' ? 'Hiking Adventure' : 'Trip' }}</h2>

            @if($trip->is_fully_booked)
                <div class="text-center py-8">
                    <div class="bg-red-50 rounded-lg p-6 max-w-md mx-auto">
                        <svg class="mx-auto h-12 w-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-red-900">Booking Unavailable</h3>
                        <p class="mt-2 text-sm text-red-700">This trip has reached its maximum capacity and is currently fully booked.</p>
                        <div class="mt-4">
                            <a href="tel:+1234567890"
                               class="inline-flex items-center px-4 py-2 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                Join Waiting List
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-gray-600 mb-6">Ready to experience this amazing {{ $trip->type === 'hiking' ? 'hiking adventure' : 'destination' }}? Book your spot now!</p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#booking-form" onclick="scrollToBookingForm()"
                       class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-lg font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Book Now
                        @if($trip->available_places && $trip->available_places <= 3)
                            <span class="ml-2 px-2 py-1 text-xs bg-yellow-200 text-yellow-800 rounded-full">
                                {{ $trip->available_places }} left
                            </span>
                        @endif
                    </a>

                    <a href="tel:+1234567890"
                       class="inline-flex items-center justify-center px-6 py-3 border border-indigo-300 text-lg font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Call Now
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>


<!-- Comments Section -->
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Comments</h2>

        <!-- Add Comment Form -->
        <div class="mb-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Leave a Comment</h3>

            @if (session('comment_success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('comment_success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('comments.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="trip_id" value="{{ $trip->id }}">

                <div>
                    <label for="comment_email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="comment_email" name="email" required value="{{ old('email') }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="comment_text" class="block text-sm font-medium text-gray-700">Comment</label>
                    <textarea id="comment_text" name="comment" rows="4" required
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                              placeholder="Share your thoughts about this {{ $trip->type === 'hiking' ? 'hiking adventure' : 'trip' }}...">{{ old('comment') }}</textarea>
                </div>

                <div>
                    <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Post Comment
                    </button>
                </div>
            </form>
        </div>

        <!-- Display Comments -->
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Comments ({{ $trip->visibleComments->count() }})</h3>

            @if($trip->visibleComments->count() > 0)
                <div class="space-y-4">
                    @foreach($trip->visibleComments->sortByDesc('created_at') as $comment)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-3">
                                    <div class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center">
                                        <span class="text-white text-sm font-medium">
                                            {{ strtoupper(substr($comment->email, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $comment->email }}</p>
                                        <p class="text-xs text-gray-500">{{ $comment->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <p class="text-gray-700">{{ $comment->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">No comments yet. Be the first to share your thoughts!</p>
            @endif
        </div>
    </div>
</div>


            <!-- Booking Form Section - Only show if not fully booked -->
            @if(!$trip->is_fully_booked)
                <div id="booking-form" class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Book Your {{ $trip->type === 'hiking' ? 'Hiking Adventure' : 'Trip' }}</h2>

                        @if (session('booking_success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                {{ session('booking_success') }}
                            </div>

                        @endif

                        @if (session('booking_error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                {{ session('booking_error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Availability reminder for limited spots -->
                        @if($trip->max_places && $trip->available_places <= 5)
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">Hurry! Limited Spots Available</h3>
                                        <div class="mt-2 text-sm text-yellow-700">
                                            <p>Only {{ $trip->available_places }} {{ $trip->available_places == 1 ? 'spot' : 'spots' }} remaining for this {{ $trip->type === 'hiking' ? 'hiking adventure' : 'trip' }}. Complete your booking quickly to secure your place!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6" id="bookingForm">
                            @csrf
                            <input type="hidden" name="trip_id" value="{{ $trip->id }}">

                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <input type="text" id="full_name" name="full_name" required value="{{ old('full_name') }}"
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                <input type="text" id="address" name="address" required value="{{ old('address') }}"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" required value="{{ old('phone') }}"
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>

                                <div>
                                    <label for="num_people" class="block text-sm font-medium text-gray-700">Number of People</label>
                                    <select id="num_people" name="num_people" required onchange="checkAvailability()"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="">Select...</option>
                                        @php
                                            $maxBookable = $trip->max_places ? min($trip->available_places, 10) : 10;
                                        @endphp
                                        @for ($i = 1; $i <= $maxBookable; $i++)
                                            <option value="{{ $i }}" {{ old('num_people') == $i ? 'selected' : '' }}>
                                                {{ $i }} {{ $i == 1 ? 'person' : 'people' }}
                                                @if($trip->max_places && $i > $trip->available_places)
                                                    (Not available)
                                                @endif
                                            </option>
                                        @endfor
                                        @if($maxBookable < 10 && !$trip->max_places)
                                            @for ($i = $maxBookable + 1; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ old('num_people') == $i ? 'selected' : '' }}>{{ $i }} people</option>
                                            @endfor
                                        @endif
                                        @if(!$trip->max_places || $trip->available_places > 10)
                                            <option value="more" {{ old('num_people') == 'more' ? 'selected' : '' }}>More than {{ $maxBookable }}</option>
                                        @endif
                                    </select>
                                    @if($trip->max_places)
                                        <p class="mt-1 text-xs text-gray-500">Maximum {{ $trip->available_places }} {{ $trip->available_places == 1 ? 'person' : 'people' }} can be booked for this trip</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Availability Warning for Selected Number -->
                            <div id="availability-warning" class="hidden bg-red-50 border border-red-200 rounded-lg p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">Booking Not Available</h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <p id="warning-message">The number of people you selected exceeds the available spots for this trip.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                    <div class="flex items-center">
                                        <input type="radio" id="payment_card" name="payment_method" value="card" required
                                               {{ old('payment_method') == 'card' ? 'checked' : '' }}
                                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                        <label for="payment_card" class="ml-3 block text-sm font-medium text-gray-700">
                                            Credit/Debit Card
                                        </label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" id="payment_cash" name="payment_method" value="cash" required
                                               {{ old('payment_method') == 'cash' ? 'checked' : '' }}
                                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                        <label for="payment_cash" class="ml-3 block text-sm font-medium text-gray-700">
                                            Cash
                                        </label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" id="payment_paypal" name="payment_method" value="paypal" required
                                               {{ old('payment_method') == 'paypal' ? 'checked' : '' }}
                                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                        <label for="payment_paypal" class="ml-3 block text-sm font-medium text-gray-700">
                                            PayPal
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="special_requests" class="block text-sm font-medium text-gray-700">Special Requests (Optional)</label>
                                <textarea id="special_requests" name="special_requests" rows="3"
                                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                          placeholder="Any special requirements or requests for this {{ $trip->type === 'hiking' ? 'hiking adventure' : 'trip' }}...">{{ old('special_requests') }}</textarea>
                            </div>

                            <div>
                                <button type="submit" id="bookingSubmitBtn"
                                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:bg-gray-400 disabled:cursor-not-allowed">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Complete Booking
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <!-- Fully Booked Message -->
                <div id="booking-unavailable" class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <div class="text-center py-8">
                            <div class="bg-red-50 rounded-lg p-8 max-w-md mx-auto">
                                <svg class="mx-auto h-16 w-16 text-red-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <h3 class="text-2xl font-bold text-red-900 mb-4">Trip Fully Booked</h3>
                                <p class="text-red-700 mb-6">
                                    Unfortunately, this {{ $trip->type === 'hiking' ? 'hiking adventure' : 'trip' }} has reached its maximum capacity of
                                    <span class="font-semibold">{{ $trip->max_places }} {{ $trip->max_places == 1 ? 'person' : 'people' }}</span>
                                    and is currently fully booked.
                                </p>
                                <div class="space-y-3">
                                    <p class="text-sm text-red-600">
                                        We apologize for the inconvenience. Please check back later or contact us to be added to our waiting list.
                                    </p>
                                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                                        <a href="tel:+1234567890"
                                           class="inline-flex items-center px-4 py-2 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            Join Waiting List
                                        </a>
                                        <a href="{{ route('welcome') }}#destinations"
                                           class="inline-flex items-center px-4 py-2 border border-indigo-300 text-sm font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                            </svg>
                                            Browse Other Trips
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Footer - Same as welcome page -->
<footer class="bg-gray-800">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex justify-center md:justify-start">
                <a href="{{ route('welcome') }}" class="text-xl font-bold text-white">TRIPS ORGANISER</a>
            </div>
            <div class="mt-8 md:mt-0">
                <p class="text-center text-base text-gray-400">&copy; 2025 Anass SAKKAH's Trips Organiser. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
<script>
    function scrollToBookingForm() {
        const bookingForm = document.getElementById('booking-form');
        if (bookingForm) {
            bookingForm.scrollIntoView({
                behavior: 'smooth'
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        checkAvailability();

        // Clear form after successful booking
        @if(session('booking_success'))
        const form = document.getElementById('bookingForm');
        if (form) {
            form.reset();
            // Also clear any selected radio buttons
            const radioButtons = form.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(radio => radio.checked = false);
            // Reset select dropdown to default
            const selectElements = form.querySelectorAll('select');
            selectElements.forEach(select => select.selectedIndex = 0);
        }
        @endif
    });

    function checkAvailability() {
        const numPeopleSelect = document.getElementById('num_people');
        const warningDiv = document.getElementById('availability-warning');
        const warningMessage = document.getElementById('warning-message');
        const submitBtn = document.getElementById('bookingSubmitBtn');

        const selectedValue = numPeopleSelect.value;
        const availablePlaces = {{ $trip->available_places ?? 999 }};
        const hasMaxPlaces = {{ $trip->max_places ? 'true' : 'false' }};

        if (hasMaxPlaces && selectedValue && selectedValue !== 'more') {
            const selectedNum = parseInt(selectedValue);
            if (selectedNum > availablePlaces) {
                warningDiv.classList.remove('hidden');
                warningMessage.textContent = `You selected ${selectedNum} ${selectedNum === 1 ? 'person' : 'people'}, but only ${availablePlaces} ${availablePlaces === 1 ? 'spot is' : 'spots are'} available for this trip.`;
                submitBtn.disabled = true;
                submitBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                submitBtn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
            } else {
                warningDiv.classList.add('hidden');
                submitBtn.disabled = false;
                submitBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                submitBtn.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
            }
        } else if (selectedValue === 'more' && hasMaxPlaces) {
            warningDiv.classList.remove('hidden');
            warningMessage.textContent = `For groups larger than ${Math.min(availablePlaces, 10)} people, please contact us directly as we only have ${availablePlaces} ${availablePlaces === 1 ? 'spot' : 'spots'} available.`;
            submitBtn.disabled = true;
            submitBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
            submitBtn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
        } else {
            warningDiv.classList.add('hidden');
            submitBtn.disabled = false;
            submitBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
            submitBtn.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
        }
    }

    // Initialize the availability check on page load if there's a pre-selected value

</script>
</body>
</html>
