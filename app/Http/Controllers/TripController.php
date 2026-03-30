<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TripController extends Controller
{
    /**
     * Display a listing of trips.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all trips for the current user
        $trips = Trip::where('user_id', auth()->id())->latest()->get();

        // Return the trips index view with trips data
        return view('dashboard.trips.index', compact('trips'));
    }

    /**
     * Get all trips for public display (API endpoint)
     * Can return limited trips for homepage or all trips for all-trips page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPublicTrips(Request $request)
    {
        $limit = $request->get('limit');

        if ($limit) {
            // Get limited trips for homepage
            $trips = Trip::orderBy('created_at', 'desc')
                ->limit((int)$limit)
                ->get();

            $total = Trip::count();

            // Format the trips for frontend
            $formattedTrips = $trips->map(function ($trip) {
                return [
                    'id' => $trip->id,
                    'title' => $trip->title,
                    'type' => $trip->type, // Added trip type
                    'location' => $trip->location,
                    'duration' => $trip->duration,
                    'description' => $trip->description,
                    'price' => $trip->price ? number_format($trip->price, 2) : null,
                    'max_places' => $trip->max_places, // Added max_places
                    'available_places' => $trip->available_places, // Added available places
                    'is_fully_booked' => $trip->is_fully_booked, // Added booking status
                    // Fix: Use a working placeholder service or a default image
                    'image_url' => $trip->image_path
                        ? asset('storage/' . $trip->image_path)
                        : 'https://via.placeholder.com/400x320/4F46E5/FFFFFF?text=Trip+Image',
                    'date' => $trip->date,
                    'created_at' => $trip->created_at,
                ];
            });

            return response()->json([
                'trips' => $formattedTrips,
                'total' => $total,
                'showing' => $trips->count()
            ]);
        } else {
            // Get all trips for the all-trips page
            $trips = Trip::orderBy('created_at', 'desc')
                ->get();

            // Format the trips for frontend
            $formattedTrips = $trips->map(function ($trip) {
                return [
                    'id' => $trip->id,
                    'title' => $trip->title,
                    'type' => $trip->type, // Added trip type
                    'location' => $trip->location,
                    'duration' => $trip->duration,
                    'description' => $trip->description,
                    'price' => $trip->price ? number_format($trip->price, 2) : null,

                    // Fix: Use a working placeholder service or a default image
                    'image_url' => $trip->image_path
                        ? asset('storage/' . $trip->image_path)
                        : 'https://via.placeholder.com/400x320/4F46E5/FFFFFF?text=Trip+Image',
                    'date' => $trip->date,
                    'created_at' => $trip->created_at,
                ];
            });

            return response()->json($formattedTrips);
        }
    }

    /**
     * Show the form for creating a new trip.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the create trip form view
        return view('dashboard.trips.create');
    }

    /**
     * Store a newly created trip in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:trip,hiking',
            'date' => 'required|date',
            'duration' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'max_places' => 'nullable|integer|min:1', // Added max_places validation
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('trip-images', 'public');
        }

        // Create a new trip
        $trip = Trip::create([
            'title' => $validated['title'],
            'type' => $validated['type'],
            'date' => $validated['date'],
            'duration' => $validated['duration'],
            'location' => $validated['location'],
            'price' => $validated['price'] ?? null,
            'max_places' => $validated['max_places'] ?? null, // Added max_places
            'description' => $validated['description'],
            'image_path' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.trips.index')
            ->with('success', 'Trip created successfully.');
    }

    /**
     * Display the specified trip (for authenticated users).
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        // Check if the trip belongs to the user
        if ($trip->user_id !== auth()->id()) {
            abort(403);
        }

        // Load the trip with its visible comments
        $trip->load('visibleComments');

        return view('dashboard.trips.show', compact('trip'));
    }

    /**
     * Display the specified trip for public view.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function showPublic(Trip $trip)
    {
        // Load the trip with its visible comments for public viewing
        $trip->load('visibleComments');

        // This is for public viewing - no authentication required
        return view('trips.show', compact('trip'));
    }

    /**
     * Show the form for editing the specified trip.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        // Check if the trip belongs to the user
        if ($trip->user_id !== auth()->id()) {
            abort(403);
        }

        return view('dashboard.trips.edit', compact('trip'));
    }

    /**
     * Update the specified trip in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        // Check if the trip belongs to the user
        if ($trip->user_id !== auth()->id()) {
            abort(403);
        }

        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:trip,hiking', // Added type validation
            'date' => 'required|date',
            'duration' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'max_places' => 'nullable|integer|min:1',
            'description' => 'nullable|string', // Added description validation
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($trip->image_path) {
                Storage::disk('public')->delete($trip->image_path);
            }

            $imagePath = $request->file('image')->store('trip-images', 'public');
            $trip->image_path = $imagePath;
        }

        // Update trip details
        $trip->title = $validated['title'];
        $trip->type = $validated['type']; // Added type to update
        $trip->date = $validated['date'];
        $trip->duration = $validated['duration'];
        $trip->location = $validated['location'];
        $trip->price = $validated['price'] ?? $trip->price;
        $trip->max_places = $validated['max_places'] ?? null;
        $trip->description = $validated['description']; // Added description to update
        $trip->save();

        return redirect()->route('admin.trips.index')
            ->with('success', 'Trip updated successfully.');
    }

    /**
     * Remove the specified trip from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        // Check if the trip belongs to the user
        if ($trip->user_id !== auth()->id()) {
            abort(403);
        }

        // Delete the trip image if exists
        if ($trip->image_path) {
            Storage::disk('public')->delete($trip->image_path);
        }

        // Delete the trip
        $trip->delete();

        return redirect()->route('admin.trips.index')
            ->with('success', 'Trip deleted successfully.');
    }

    /**
     * Show all trips page
     */
    public function allTrips()
    {
        return view('trips.all');
    }

    /**
     * Get paginated trips for the all-trips page
     */
    public function getAllTripsData(Request $request)
    {
        $perPage = $request->get('per_page', 12);
        $search = $request->get('search');
        $sort = $request->get('sort', 'newest');
        $type = $request->get('type'); // Added type filter

        $query = Trip::query();

        // Handle search
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Handle type filter
        if ($type && in_array($type, ['trip', 'hiking'])) {
            $query->where('type', $type);
        }

        // Handle sorting
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('title', 'asc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $trips = $query->paginate($perPage);

        // Format the trips data to match the frontend expectations
        $trips->getCollection()->transform(function ($trip) {
            return [
                'id' => $trip->id,
                'title' => $trip->title,
                'type' => $trip->type, // Trip type
                'location' => $trip->location,
                'duration' => $trip->duration,
                'description' => $trip->description,
                'price' => $trip->price ? number_format($trip->price, 2) : null,
                'max_places' => $trip->max_places,
                'available_places' => $trip->available_places,
                'is_fully_booked' => $trip->is_fully_booked,
                'image_url' => $trip->image_path ? asset('storage/' . $trip->image_path) : '/api/placeholder/400/320',
                'date' => $trip->date,
                'created_at' => $trip->created_at,
            ];
        });

        return response()->json($trips);
    }

    /**
     * Check trip availability for booking
     *
     * @param  \App\Models\Trip  $trip
     * @param  int  $requestedPeople
     * @return array
     */
    public function checkAvailability(Trip $trip, $requestedPeople = 1)
    {
        if (!$trip->max_places) {
            return [
                'available' => true,
                'message' => 'Unlimited places available'
            ];
        }

        $availablePlaces = $trip->available_places;

        if ($availablePlaces <= 0) {
            return [
                'available' => false,
                'message' => 'This trip has reached its maximum capacity and is fully booked.'
            ];
        }

        if ($requestedPeople > $availablePlaces) {
            return [
                'available' => false,
                'message' => "Only {$availablePlaces} places are available, but you requested {$requestedPeople} places."
            ];
        }

        return [
            'available' => true,
            'message' => "{$availablePlaces} places available"
        ];
    }

}
