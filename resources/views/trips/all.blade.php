<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Trips - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .search-container {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/api/placeholder/1200/400');
            background-size: cover;
            background-position: center;
        }
        .star-rating {
            color: #FFD700;
        }
        .trip-list-item {
            transition: all 0.2s ease-in-out;
        }
        .trip-list-item:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
<!-- Header Navigation (same as welcome page) -->
<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}" class="text-2xl font-bold text-indigo-600">TRIPS ORGANISER</a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('welcome') }}#home" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Home
                    </a>
                    <a href="{{ route('welcome') }}#about" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        About Us
                    </a>
                    <a href="#" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        All Trips
                    </a>
                    <a href="{{ route('welcome') }}#contact" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Contact
                    </a>
                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
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
        </div>
    </div>
</nav>

<!-- Hero Section with Search -->
<div class="search-container py-24 relative">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
         style="background-image: url('{{ asset('images/aircraft-8867083_1280.jpg') }}');">
    </div>

    <!-- Dark Overlay for better text readability -->
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center text-white">
            <h1 class="text-4xl tracking-tight font-extrabold sm:text-5xl md:text-6xl">
                All Our Amazing Trips
            </h1>
            <p class="mt-3 max-w-md mx-auto text-base sm:text-lg md:mt-5 md:text-xl">
                Discover all our incredible destinations and find your perfect adventure.
            </p>

            <!-- Search Bar -->
            <div class="mt-8 max-w-md mx-auto">
                <div class="flex rounded-md shadow-sm">
                    <input type="text" id="search-input" placeholder="Search destinations, locations..." class="flex-1 min-w-0 block w-full px-3 py-2 rounded-l-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900">
                    <button type="button" id="search-button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-r-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Trips List Section -->
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filter/Sort Controls -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 space-y-4 sm:space-y-0">
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600" id="trips-count">Loading trips...</span>
            </div>
            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                <!-- Trip Type Filter -->
                <div class="flex items-center space-x-2">
                    <label for="type-filter" class="text-sm font-medium text-gray-700">Filter by:</label>
                    <select id="type-filter" class="block w-32 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">All Types</option>
                        <option value="trip">Trips</option>
                        <option value="hiking">Hiking</option>
                    </select>
                </div>

                <!-- View Toggle Buttons -->
                <div class="flex items-center space-x-2">
                    <button id="view-grid" class="p-2 text-gray-500 hover:text-indigo-600 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                    </button>
                    <button id="view-list" class="p-2 text-indigo-600 hover:text-indigo-600 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <!-- Sort Dropdown -->
                <div class="flex items-center space-x-2">
                    <label for="sort-select" class="text-sm font-medium text-gray-700">Sort by:</label>
                    <select id="sort-select" class="block w-40 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="name">Name (A-Z)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Trips Container -->
        <div id="trips-container" class="space-y-4">
            <!-- Loading state -->
            <div class="text-center py-8">
                <p class="text-gray-500">Loading trips...</p>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-12" id="pagination-container">
            <!-- Pagination will be loaded here -->
        </div>

        <!-- Load More Button (alternative to pagination) -->
        <div class="mt-8 text-center" id="load-more-container" style="display: none;">
            <button id="load-more-button" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white hidden" id="loading-spinner" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Load More Trips
            </button>
        </div>
    </div>
</div>

<!-- Footer (same as welcome page) -->
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
    let currentPage = 1;
    let currentSearch = '';
    let currentSort = 'newest';
    let currentTypeFilter = ''; // Added type filter variable
    let isLoading = false;
    let viewMode = 'list'; // Default to list view

    document.addEventListener('DOMContentLoaded', function() {
        // Load initial trips
        loadTrips();

        // Search functionality
        const searchInput = document.getElementById('search-input');
        const searchButton = document.getElementById('search-button');

        searchButton.addEventListener('click', performSearch);
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        // Sort functionality
        document.getElementById('sort-select').addEventListener('change', function(e) {
            currentSort = e.target.value;
            currentPage = 1;
            loadTrips();
        });

        // Type filter functionality
        document.getElementById('type-filter').addEventListener('change', function(e) {
            currentTypeFilter = e.target.value;
            currentPage = 1;
            loadTrips();
        });

        // Load more functionality
        document.getElementById('load-more-button').addEventListener('click', function() {
            currentPage++;
            loadTrips(true);
        });

        // View mode toggles
        document.getElementById('view-grid').addEventListener('click', function() {
            document.getElementById('view-grid').classList.add('text-indigo-600');
            document.getElementById('view-grid').classList.remove('text-gray-500');
            document.getElementById('view-list').classList.add('text-gray-500');
            document.getElementById('view-list').classList.remove('text-indigo-600');
            viewMode = 'grid';
            currentPage = 1;
            loadTrips();
        });

        document.getElementById('view-list').addEventListener('click', function() {
            document.getElementById('view-list').classList.add('text-indigo-600');
            document.getElementById('view-list').classList.remove('text-gray-500');
            document.getElementById('view-grid').classList.add('text-gray-500');
            document.getElementById('view-grid').classList.remove('text-indigo-600');
            viewMode = 'list';
            currentPage = 1;
            loadTrips();
        });
    });

    function performSearch() {
        currentSearch = document.getElementById('search-input').value;
        currentPage = 1;
        loadTrips();
    }

    // Function to get trip type badge styling
    function getTripTypeBadge(type) {
        const typeText = type === 'hiking' ? 'Hiking' : 'Trip';
        const badgeClass = type === 'hiking'
            ? 'bg-green-100 text-green-800'
            : 'bg-blue-100 text-blue-800';

        return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${badgeClass}">${typeText}</span>`;
    }

    async function loadTrips(append = false) {
        if (isLoading) return;
        isLoading = true;

        const loadingSpinner = document.getElementById('loading-spinner');
        const loadMoreButton = document.getElementById('load-more-button');

        if (!append) {
            document.getElementById('trips-container').innerHTML = `
                <div class="text-center py-8">
                    <p class="text-gray-500">Loading trips...</p>
                </div>
            `;
        } else {
            loadingSpinner.classList.remove('hidden');
            loadMoreButton.disabled = true;
        }

        try {
            const params = new URLSearchParams({
                page: currentPage,
                per_page: 12,
                search: currentSearch,
                sort: currentSort,
                type: currentTypeFilter // Added type filter to API call
            });

            const response = await fetch(`/api/trips/all?${params}`);
            const data = await response.json();

            if (data.data && data.data.length > 0) {
                if (append) {
                    const existingTrips = document.getElementById('trips-container').innerHTML;
                    document.getElementById('trips-container').innerHTML = existingTrips + displayTrips(data.data);
                } else {
                    document.getElementById('trips-container').innerHTML = displayTrips(data.data);
                }

                // Update trip count with filter information
                let countText = `Showing ${data.from}-${data.to} of ${data.total} trips`;
                if (currentTypeFilter) {
                    const filterName = currentTypeFilter === 'hiking' ? 'hiking' : 'trip';
                    countText += ` (${filterName}s only)`;
                }
                document.getElementById('trips-count').textContent = countText;

                // Handle load more button
                if (data.current_page < data.last_page) {
                    document.getElementById('load-more-container').style.display = 'block';
                } else {
                    document.getElementById('load-more-container').style.display = 'none';
                }

            } else {
                if (!append) {
                    let noResultsMessage = 'No trips found. Try adjusting your search.';
                    if (currentTypeFilter) {
                        const filterName = currentTypeFilter === 'hiking' ? 'hiking' : 'trip';
                        noResultsMessage = `No ${filterName}s found. Try changing your filter or search terms.`;
                    }
                    document.getElementById('trips-container').innerHTML = `
                        <div class="text-center py-8">
                            <p class="text-gray-500">${noResultsMessage}</p>
                        </div>
                    `;
                }
                document.getElementById('load-more-container').style.display = 'none';
            }
        } catch (error) {
            console.error('Error fetching trips:', error);
            if (!append) {
                document.getElementById('trips-container').innerHTML = `
                    <div class="text-center py-8">
                        <p class="text-red-500">Error loading trips. Please try again later.</p>
                    </div>
                `;
            }
        } finally {
            isLoading = false;
            loadingSpinner.classList.add('hidden');
            loadMoreButton.disabled = false;
        }
    }

    function displayTrips(trips) {
        if (viewMode === 'grid') {
            return displayGridView(trips);
        } else {
            return displayListView(trips);
        }
    }

    function displayGridView(trips) {
        let html = '<div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">';

        html += trips.map(trip => `
            <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-lg transition-shadow duration-200">
                <div class="h-48 w-full relative">
                    <img src="${trip.image_url}" alt="${trip.title}" class="w-full h-full object-cover">
                    <!-- Trip type badge overlay -->
        <div class="absolute top-3 left-3">
        ${getTripTypeBadge(trip.type)}
        </div>
        </div>
        <div class="px-4 py-5 sm:p-6">
        <div class="flex items-start justify-between mb-2">
        <h3 class="text-lg leading-6 font-medium text-gray-900 flex-1">${trip.title}</h3>
        <div class="ml-2 flex-shrink-0">
        ${getTripTypeBadge(trip.type)}
        </div>
        </div>
        <p class="mt-1 text-sm text-gray-600 font-medium">${trip.location}</p>
        ${trip.price ? `<p class="mt-1 text-lg font-bold text-green-600">$${trip.price}</p>` : ''}
        <p class="mt-2 text-sm text-gray-500 line-clamp-3">
        ${trip.description || 'Discover the beauty and culture of this amazing destination.'}
        </p>
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

        html += '</div>';
        return html;
    }

    function displayListView(trips) {
        return trips.map(trip => {
            return `
        <div class="trip-list-item bg-white overflow-hidden shadow-sm rounded-lg mb-4">
        <div class="flex flex-col md:flex-row">
        <div class="md:w-64 h-48 md:h-auto relative">
        <img src="${trip.image_url}" alt="${trip.title}" class="w-full h-full object-cover">
        <!-- Trip type badge overlay -->
        <div class="absolute top-3 left-3">
        ${getTripTypeBadge(trip.type)}
        </div>
        </div>
        <div class="flex-1 p-4 md:p-6 flex flex-col">
        <div class="flex flex-col md:flex-row md:justify-between">
        <div class="flex-1">
        <div class="flex items-start justify-between mb-2">
        <h3 class="text-xl font-semibold text-gray-900 flex-1">${trip.title}</h3>
        <div class="ml-3 flex-shrink-0">
        ${getTripTypeBadge(trip.type)}
        </div>
        </div>
        <p class="mt-1 text-sm text-gray-600 flex items-center">
        <svg class="h-4 w-4 text-gray-500 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        ${trip.location}
        </p>
        </div>
        </div>

        <div class="mt-2 text-sm text-gray-500 flex-grow">
        ${trip.description || 'Discover the beauty and culture of this amazing destination.'}
        <a href="/trips/${trip.id}" class="ml-1 text-indigo-600 hover:text-indigo-800 font-medium">Show more</a>
        </div>

        <div class="mt-4 flex flex-col md:flex-row md:items-center md:justify-between">
        <div class="flex items-center">
        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
        ${trip.duration}
        </span>
        </div>
        <div class="mt-3 md:mt-0 flex items-center">
        <div class="text-right">
        <div class="text-sm text-gray-500">Price from</div>
        ${trip.price ?
        `<div class="text-xl font-bold text-green-600">$${trip.price}</div>` :
        '<div class="text-xl font-bold text-green-600">Contact us</div>'}
        <div class="text-xs text-gray-500">per person</div>
        </div>
        <a href="/trips/${trip.id}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
        Book Now
        </a>
        </div>
        </div>
        </div>
        </div>
        </div>
        `;
        }).join('');
    }
</script>
</body>
</html>
