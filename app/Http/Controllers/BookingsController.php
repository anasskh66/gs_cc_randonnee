<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Client;
use App\Models\Trip;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingsController extends Controller
{
    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'num_people' => 'required|string',
            'payment_method' => 'required|in:card,cash,paypal',
            'special_requests' => 'nullable|string',
        ]);

        // Convert 'more' to a numeric value if needed
        $numPeople = $validated['num_people'] === 'more' ? 11 : (int)$validated['num_people'];

        // Create or find client
        $client = Client::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name' => $validated['full_name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
            ]
        );

        // Create booking
        $booking = Booking::create([
            'client_id' => $client->id,
            'trip_id' => $validated['trip_id'],
            'num_people' => $numPeople,
            'payment_method' => $validated['payment_method'],
            'special_requests' => $validated['special_requests'],
            'status' => Booking::STATUS_PENDING, // Set default status
        ]);

        // Generate PDF receipt
        $trip = Trip::findOrFail($validated['trip_id']);
        $pdf = Pdf::loadView('pdfs.booking_receipt', [
            'booking' => $booking,
            'client' => $client,
            'trip' => $trip,
        ]);

        // Simply return the PDF download without chaining with()
        return $pdf->download('booking_receipt.pdf');

    }

    /**
     * Display a listing of the bookings.
     */
    public function index()
    {
        $bookings = Booking::with(['client', 'trip'])->get();
        return view('dashboard.bookings.index', compact('bookings'));
    }

    /**
     * Show the specified booking.
     */
    public function show(Booking $booking)
    {
        $booking->load(['client', 'trip']);
        return view('dashboard.bookings.show', compact('booking'));
    }

    /**
     * Update the status of the specified booking.
     */
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        $statusMessage = match($request->status) {
            'completed' => 'Booking marked as completed successfully.',
            'cancelled' => 'Booking cancelled successfully.',
            default => 'Booking status updated successfully.'
        };

        return redirect()->route('admin.bookings.show', $booking)
            ->with('success', $statusMessage);
    }

    /**
     * Remove the specified booking from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }
}
