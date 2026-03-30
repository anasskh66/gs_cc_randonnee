<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - Welcome</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/api/placeholder/1200/600');
            background-size: cover;
            background-position: center;
            height: 80vh;
        }
    </style>


</head>
<body class="bg-gray-100 font-sans">
<!-- Header Navigation -->
<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <!-- Logo -->
                    <a href="{{ route('welcome') }}" class="text-2xl font-bold text-indigo-600">TRIPS ORGANISER</a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <!-- Navigation Links -->
                    <a href="#home" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Home
                    </a>
                    <a href="#about" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        About Us
                    </a>
                    <a href="#destinations" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Destinations
                    </a>
                    <a href="#contact" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Contact
                    </a>
                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <!-- Auth Links -->
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 px-3 py-2">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            For Admin
                        </a>
                    @endauth
                @endif
            </div>
            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu icon -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="sm:hidden hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <a href="#home" class="bg-indigo-50 border-indigo-500 text-indigo-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Home
            </a>
            <a href="#about" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                About Us
            </a>
            <a href="#destinations" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Destinations
            </a>
            <a href="#contact" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Contact
            </a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('dashboard') }}" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        For Admin
                    </a>
                @endauth
            @endif
        </div>
    </div>
</nav>

<!-- Hero Section -->
<!-- Hero Section -->
<div class="hero-section flex items-center justify-center relative" id="home">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
         style="background-image: url('{{ asset('images/beach-666122_1280.jpg') }}');">
    </div>

    <!-- Dark Overlay for better text readability -->
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    <!-- Content -->
    <div class="relative z-10 text-center text-white px-4">
        <h1 class="text-4xl tracking-tight font-extrabold sm:text-5xl md:text-6xl">
            Discover Amazing Destinations
        </h1>
        <p class="mt-3 max-w-md mx-auto text-base sm:text-lg md:mt-5 md:text-xl">
            Plan your perfect trip with our expert guides and personalized itineraries.
        </p>
        <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
            <div class="rounded-md shadow">
                <a href="#destinations" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                    Explore Destinations
                </a>
            </div>
        </div>
    </div>
</div>

<!-- About Us Section -->
<div id="about" class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">About Us</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Your Trusted Travel Partner
            </p>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                We help travelers discover the world's most amazing destinations with carefully curated trips and expert guides.
            </p>
        </div>

        <div class="mt-10">
            <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                            <!-- Icon -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Global Destinations</h3>
                        <p class="mt-2 text-base text-gray-500">
                            We offer trips to destinations all around the world, from popular tourist spots to hidden gems.
                        </p>
                    </div>
                </div>

                <div class="flex">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                            <!-- Icon -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Expert Planning</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Our team of travel experts will help you plan every detail of your trip to ensure a smooth experience.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Destinations Section -->



<div id="destinations" class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Destinations</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Popular Trips
            </p>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                Explore our most popular destinations and start planning your next adventure.
            </p>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3" id="trips-container">
            <!-- Trips will be loaded here dynamically -->
            <div class="text-center py-8 col-span-full">
                <p class="text-gray-500">Loading trips...</p>
            </div>
        </div>

        <!-- Show More Button -->
        <div class="mt-12 text-center" id="show-more-container" style="display: none;">
            <a href="{{ route('trips.all') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                <svg class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                Show All Trips
            </a>
        </div>
    </div>
</div>

<script>
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                const expanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !expanded);
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Fetch and display trips from the backend
        fetchTrips();
    });

    // Function to truncate text to a specific length
    function truncateText(text, maxLength = 100) {
        if (!text) return 'Discover the beauty and culture of this amazing destination.';
        if (text.length <= maxLength) return text;
        return text.substring(0, maxLength).trim() + '...';
    }

    // Function to fetch trips from the API (limit to 6 for home page)
    async function fetchTrips() {
        console.log('Starting to fetch trips...');

        try {
            console.log('Making API call to: /api/trips/public?limit=6');
            const response = await fetch('/api/trips/public?limit=6');

            console.log('Response status:', response.status);
            console.log('Response ok:', response.ok);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            console.log('Raw response data:', data);

            // Handle the response structure from your controller
            const trips = data.trips || data;
            const total = data.total || trips.length;

            console.log('Parsed trips:', trips);
            console.log('Total trips available:', total);
            console.log('Trips being displayed:', trips.length);

            if (trips.length > 0) {
                displayTrips(trips);

                // Show the "Show More" button if there are more than 6 trips total
                console.log('Checking if should show more button. Total:', total, 'Displayed:', trips.length);
                if (total > trips.length) {
                    const showMoreContainer = document.getElementById('show-more-container');
                    console.log('Show more container element:', showMoreContainer);
                    if (showMoreContainer) {
                        showMoreContainer.style.display = 'block';
                        console.log('Show more button displayed');
                    } else {
                        console.error('Could not find show-more-container element');
                    }
                } else {
                    console.log('Not showing more button - total trips:', total, 'displayed trips:', trips.length);
                }
            } else {
                console.log('No trips found');
                document.getElementById('trips-container').innerHTML = `
                <div class="text-center py-8 col-span-full">
                    <p class="text-gray-500">No trips available at the moment.</p>
                </div>
            `;
            }
        } catch (error) {
            console.error('Error fetching trips:', error);
            document.getElementById('trips-container').innerHTML = `
            <div class="text-center py-8 col-span-full">
                <p class="text-red-500">Error loading trips. Please try again later.</p>
                <p class="text-sm text-gray-400 mt-2">Error: ${error.message}</p>
            </div>
        `;
        }
    }

    // Function to display trips
    function getTripTypeBadge(type) {
        const typeText = type === 'hiking' ? 'Hiking' : 'Trip';
        const badgeClass = type === 'hiking'
            ? 'bg-green-100 text-green-800'
            : 'bg-blue-100 text-blue-800';

        return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${badgeClass}">${typeText}</span>`;
    }

    // Function to display trips
    function displayTrips(trips) {
        console.log('Displaying trips:', trips.length);
        const container = document.getElementById('trips-container');

        if (!container) {
            console.error('Could not find trips-container element');
            return;
        }

        container.innerHTML = trips.map(trip => `
        <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-lg transition-shadow duration-200 flex flex-col h-full">
            <div class="h-48 w-full relative">
                <img src="${trip.image_url}" alt="${trip.title}" class="w-full h-full object-cover">
                <!-- Trip type badge overlay -->
                <div class="absolute top-3 left-3">
                    ${getTripTypeBadge(trip.type)}
                </div>
            </div>
            <div class="px-4 py-5 sm:p-6 flex flex-col flex-grow">
                <div class="flex-grow">
                    <div class="flex items-start justify-between">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">${trip.title}</h3>
                        <!-- Additional trip type badge (optional) -->
                        <div class="ml-2 flex-shrink-0">
                            ${getTripTypeBadge(trip.type)}
                        </div>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 font-medium">${trip.location}</p>
                    ${trip.price ? `<p class="mt-1 text-sm font-bold text-green-600">$${trip.price}</p>` : ''}
                    <p class="mt-2 text-sm text-gray-500 line-clamp-3">
                        ${truncateText(trip.description, 120)}
                    </p>
                    ${trip.description && trip.description.length > 120 ?
            `<a href="/trips/${trip.id}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Read more</a>` : ''
        }
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                        ${trip.duration}
                    </span>
                    <a href="/trips/${trip.id}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    `).join('');

        console.log('Trips displayed successfully');
    }
</script>

<!-- Contact Section -->
<div id="contact" class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Contact Us</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Get in Touch
            </p>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                Have questions about our trips? Want to book a custom itinerary? Reach out to our team through the form below or connect with us on social media.
            </p>
        </div>

        <div class="mt-10 lg:grid lg:grid-cols-12 lg:gap-8">
            <!-- Contact Form -->
            <div class="lg:col-span-7">
                <div class="max-w-lg mx-auto lg:max-w-none">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('messages.store') }}" method="POST" class="grid grid-cols-1 gap-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <div class="mt-1">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <input type="email" name="email" id="email" value="{{ old('email') }}" autocomplete="email" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                            <div class="mt-1">
                                <textarea id="message" name="message" rows="4" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">{{ old('message') }}</textarea>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Contact Info and Social Media -->
            <div class="lg:col-span-5 mt-12 lg:mt-0">
                <div class="max-w-lg mx-auto lg:max-w-none">
                    <!-- Contact Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-indigo-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-gray-600">tripsorganiser.info@gmail.com</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-indigo-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-gray-600">+212 688-59-8963</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-indigo-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-gray-600">123 Hay Riad, Rabat City, Morocco</span>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Section -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Follow Us</h3>
                        <p class="text-gray-600 mb-6">Connect with us on social media for travel inspiration, trip updates, and exclusive offers!</p>

                        <div class="flex space-x-4">
                            <!-- Facebook -->
                            <a href="https://facebook.com/tripsorganiser" target="_blank" rel="noopener noreferrer" class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full transition-colors duration-200">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>

                            <!-- Instagram -->
                            <a href="https://instagram.com/tripsorganiser" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white p-3 rounded-full transition-colors duration-200">
                                <span class="sr-only">Instagram</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C23.004 5.367 17.637.001 12.017.001zM8.449 16.988c-1.297 0-2.348-1.051-2.348-2.348s1.051-2.348 2.348-2.348 2.348 1.051 2.348 2.348-1.051 2.348-2.348 2.348zm3.568 0c-1.297 0-2.348-1.051-2.348-2.348s1.051-2.348 2.348-2.348 2.348 1.051 2.348 2.348-1.051 2.348-2.348 2.348zm3.568 0c-1.297 0-2.348-1.051-2.348-2.348s1.051-2.348 2.348-2.348 2.348 1.051 2.348 2.348-1.051 2.348-2.348 2.348z"/>
                                </svg>
                            </a>

                            <!-- Twitter/X -->
                            <a href="https://twitter.com/tripsorganiser" target="_blank" rel="noopener noreferrer" class="bg-black hover:bg-gray-800 text-white p-3 rounded-full transition-colors duration-200">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                            </a>

                            <!-- LinkedIn -->
                            <a href="https://linkedin.com/company/tripsorganiser" target="_blank" rel="noopener noreferrer" class="bg-blue-700 hover:bg-blue-800 text-white p-3 rounded-full transition-colors duration-200">
                                <span class="sr-only">LinkedIn</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>

                            <!-- Google+ (Note: Google+ was discontinued, you might want to replace with YouTube or another platform) -->
                            <a href="https://plus.google.com/tripsorganiser" target="_blank" rel="noopener noreferrer" class="bg-red-600 hover:bg-red-700 text-white p-3 rounded-full transition-colors duration-200">
                                <span class="sr-only">Google+</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M7.635 10.909v2.619h4.335c-.173 1.125-1.31 3.295-4.335 3.295-2.612 0-4.747-2.164-4.747-4.833s2.135-4.833 4.747-4.833c1.498 0 2.499.647 3.068 1.202l2.058-1.98C11.104 4.965 9.253 4 7.635 4 3.42 4 .057 7.363.057 11.578S3.42 19.155 7.635 19.155c4.338 0 7.226-3.052 7.226-7.347 0-.492-.054-.867-.12-1.24H7.635zm17.027 0h-2.244V8.664h-2.244v2.245H17.93v2.244h2.244v2.244h2.244v-2.244H24v-2.244z"/>
                                </svg>
                            </a>
                        </div>

                        <!-- Alternative: Display social links in a list format -->
                        <div class="mt-6 space-y-3">
                            <p class="text-sm text-gray-500">Or find us on:</p>
                            <div class="space-y-2">
                                <a href="https://facebook.com/tripsorganiser" target="_blank" rel="noopener noreferrer" class="flex items-center text-gray-600 hover:text-blue-600 transition-colors duration-200">
                                    <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                    @TripsOrganiser
                                </a>
                                <a href="https://instagram.com/tripsorganiser" target="_blank" rel="noopener noreferrer" class="flex items-center text-gray-600 hover:text-pink-600 transition-colors duration-200">
                                    <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C23.004 5.367 17.637.001 12.017.001zM8.449 16.988c-1.297 0-2.348-1.051-2.348-2.348s1.051-2.348 2.348-2.348 2.348 1.051 2.348 2.348-1.051 2.348-2.348 2.348zm3.568 0c-1.297 0-2.348-1.051-2.348-2.348s1.051-2.348 2.348-2.348 2.348 1.051 2.348 2.348-1.051 2.348-2.348 2.348zm3.568 0c-1.297 0-2.348-1.051-2.348-2.348s1.051-2.348 2.348-2.348 2.348 1.051 2.348 2.348-1.051 2.348-2.348 2.348z"/>
                                    </svg>
                                    @tripsorganiser
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
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
</body>
</html>
