<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Debug: Log the counts to see what's happening
            $tripCount = Trip::count();
            $bookingCount = Booking::count();
            $clientCount = Client::count();
            $commentCount = Comment::count();

            Log::info('Dashboard Debug - Counts:', [
                'trips' => $tripCount,
                'bookings' => $bookingCount,
                'clients' => $clientCount,
                'comments' => $commentCount
            ]);

            // Get dashboard statistics
            $stats = [
                'total_trips' => $tripCount,
                'total_bookings' => $bookingCount,
                'total_clients' => $clientCount,
                'total_comments' => $commentCount,
            ];

            // Get most booked trips (top 5) - simplified query for debugging
            $mostBookedTrips = Trip::leftJoin('bookings', 'trips.id', '=', 'bookings.trip_id')
                ->select('trips.*', DB::raw('COUNT(bookings.id) as bookings_count'))
                ->groupBy('trips.id')
                ->orderBy('bookings_count', 'desc')
                ->take(5)
                ->get();

            Log::info('Most booked trips count: ' . $mostBookedTrips->count());

            // Get recent bookings (last 5) - check if bookings table exists and has data
            $recentBookings = collect(); // Initialize as empty collection
            try {
                $recentBookings = Booking::with(['trip', 'client'])
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
                Log::info('Recent bookings count: ' . $recentBookings->count());
            } catch (\Exception $e) {
                Log::error('Error fetching recent bookings: ' . $e->getMessage());
            }

            // Get revenue statistics - simplified
            $totalRevenue = 0;
            try {
                $totalRevenue = DB::table('bookings')
                    ->join('trips', 'bookings.trip_id', '=', 'trips.id')
                    ->sum(DB::raw('bookings.num_people * trips.price'));
                Log::info('Total revenue: ' . $totalRevenue);
            } catch (\Exception $e) {
                Log::error('Error calculating revenue: ' . $e->getMessage());
                $totalRevenue = 0;
            }

            // Get monthly booking trends - simplified
            $monthlyBookings = collect();
            try {
                $monthlyBookings = DB::table('bookings')
                    ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('COUNT(*) as count'))
                    ->where('created_at', '>=', now()->subMonths(6))
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();
            } catch (\Exception $e) {
                Log::error('Error fetching monthly bookings: ' . $e->getMessage());
            }

            // Check which view to use - try both possibilities
            $viewName = view()->exists('admin.dashboard') ? 'admin.dashboard' : 'dashboard';
            Log::info('Using view: ' . $viewName);

            return view($viewName, compact(
                'stats',
                'mostBookedTrips',
                'recentBookings',
                'totalRevenue',
                'monthlyBookings'
            ));

        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            // Return with default values to prevent the error
            $stats = [
                'total_trips' => 0,
                'total_bookings' => 0,
                'total_clients' => 0,
                'total_comments' => 0,
            ];

            $mostBookedTrips = collect();
            $recentBookings = collect();
            $totalRevenue = 0;
            $monthlyBookings = collect();

            $viewName = view()->exists('admin.dashboard') ? 'admin.dashboard' : 'dashboard';

            return view($viewName, compact(
                'stats',
                'mostBookedTrips',
                'recentBookings',
                'totalRevenue',
                'monthlyBookings'
            ));
        }
    }
}
