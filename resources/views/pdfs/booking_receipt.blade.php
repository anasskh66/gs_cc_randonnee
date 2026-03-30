<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Receipt</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.2;
            color: #333;
            font-size: 12px;
        }

        .receipt {
            max-width: 800px;
            margin: 0 auto;
            background: white;
        }

        /* Header */
        .header {
            background: #4f46e5;
            color: white;
            padding: 20px 15px;
            text-align: center;
            position: relative;
        }

        .receipt-number {
            position: absolute;
            top: 15px;
            right: 20px;
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: bold;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 3px;
        }

        .receipt-title {
            font-size: 14px;
            opacity: 0.9;
        }

        /* Content */
        .content {
            padding: 20px 15px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #4f46e5;
            margin-bottom: 10px;
            padding-bottom: 3px;
            border-bottom: 2px solid #e5e7eb;
        }

        /* Info Table */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .info-table td {
            padding: 4px 0;
            vertical-align: top;
        }

        .info-label {
            font-weight: bold;
            color: #6b7280;
            width: 120px;
            font-size: 10px;
            text-transform: uppercase;
        }

        .info-value {
            color: #374151;
            font-weight: 500;
        }

        /* Two Column Layout */
        .two-column {
            width: 100%;
            border-collapse: collapse;
        }

        .two-column td {
            width: 50%;
            padding: 4px 8px 4px 0;
            vertical-align: top;
        }

        /* Trip Details Card */
        .trip-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-left: 4px solid #4f46e5;
            padding: 15px;
            margin: 10px 0;
        }

        .trip-title {
            font-size: 16px;
            font-weight: bold;
            color: #374151;
            margin-bottom: 10px;
        }

        /* Pricing Section */
        .pricing-section {
            background: #f8f9fa;
            border: 2px dashed #d1d5db;
            padding: 15px;
            margin: 15px 0;
        }

        .pricing-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pricing-table td {
            padding: 6px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .pricing-label {
            font-size: 12px;
            color: #6b7280;
        }

        .pricing-value {
            text-align: right;
            font-weight: bold;
            color: #374151;
        }

        .total-row td {
            padding: 10px 0 5px 0;
            border-bottom: none;
            border-top: 2px solid #4f46e5;
            font-size: 14px;
        }

        .total-row .pricing-label {
            font-size: 16px;
            font-weight: bold;
            color: #374151;
        }

        .total-row .pricing-value {
            font-size: 18px;
            font-weight: bold;
            color: #4f46e5;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-confirmed {
            background: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-paid {
            background: #dbeafe;
            color: #1e40af;
        }

        /* Special Requests */
        .special-requests {
            background: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 10px;
            margin: 15px 0;
        }

        .special-requests-title {
            font-weight: bold;
            color: #991b1b;
            margin-bottom: 5px;
            font-size: 12px;
        }

        .special-requests-text {
            color: #6b7280;
            font-size: 11px;
        }

        /* Thank You Section */
        .thank-you {
            text-align: center;
            padding: 15px;
            background: #f8fafc;
            margin: 20px 0;
        }

        .thank-you-text {
            font-size: 18px;
            font-weight: bold;
            color: #4f46e5;
            margin-bottom: 5px;
        }

        .thank-you-subtitle {
            color: #6b7280;
            font-size: 12px;
        }

        /* Footer */
        .footer {
            background: #374151;
            color: white;
            padding: 15px 15px;
            text-align: center;
        }

        .contact-info {
            margin-bottom: 5px;
            font-size: 12px;
        }

        .copyright {
            font-size: 10px;
            opacity: 0.8;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #6b7280;
        }

        /* Print Styles */
        @media print {
            .receipt {
                max-width: none;
            }
        }
    </style>
</head>
<body>
<div class="receipt">
    <!-- Header -->
    <div class="header">
        <div class="receipt-number">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</div>
        <div class="logo">TRIPS ORGANISER</div>
        <div class="receipt-title">Booking Confirmation Receipt</div>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Booking Information -->
        <div class="section">
            <h2 class="section-title">Booking Information</h2>
            <table class="two-column">
                <tr>
                    <td>
                        <table class="info-table">
                            <tr>
                                <td class="info-label">Booking ID</td>
                                <td class="info-value">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</td>
                            </tr>
                            <tr>
                                <td class="info-label">Booking Date</td>
                                <td class="info-value">{{ $booking->created_at->format('F d, Y \a\t g:i A') }}</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="info-table">
                            <tr>
                                <td class="info-label">Status</td>
                                <td class="info-value">
                                    <span class="status-badge status-{{ strtolower($booking->status ?? 'confirmed') }}">
                                        {{ ucfirst($booking->status ?? 'Confirmed') }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="info-label">Payment Method</td>
                                <td class="info-value">{{ ucfirst($booking->payment_method) }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Client Information -->
        <div class="section">
            <h2 class="section-title">Client Information</h2>
            <table class="two-column">
                <tr>
                    <td>
                        <table class="info-table">
                            <tr>
                                <td class="info-label">Full Name</td>
                                <td class="info-value">{{ $client->name }}</td>
                            </tr>
                            <tr>
                                <td class="info-label">Email Address</td>
                                <td class="info-value">{{ $client->email }}</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="info-table">
                            <tr>
                                <td class="info-label">Phone Number</td>
                                <td class="info-value">{{ $client->phone }}</td>
                            </tr>
                            <tr>
                                <td class="info-label">Address</td>
                                <td class="info-value">{{ $client->address }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Trip Details -->
        <div class="section">
            <h2 class="section-title">Trip Details</h2>
            <div class="trip-card">
                <div class="trip-title">{{ $trip->title }}</div>
                <table class="two-column">
                    <tr>
                        <td>
                            <table class="info-table">
                                <tr>
                                    <td class="info-label">Destination</td>
                                    <td class="info-value">{{ $trip->location }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Duration</td>
                                    <td class="info-value">{{ $trip->duration }}</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class="info-table">
                                @if($trip->date)
                                    <tr>
                                        <td class="info-label">Trip Date</td>
                                        <td class="info-value">{{ \Carbon\Carbon::parse($trip->date)->format('F d, Y') }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="info-label">Travelers</td>
                                    <td class="info-value">{{ $booking->num_people }} {{ $booking->num_people == 1 ? 'Person' : 'People' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Pricing Breakdown -->
        <div class="section">
            <h2 class="section-title">Pricing Breakdown</h2>
            <div class="pricing-section">
                <table class="pricing-table">
                    <tr>
                        <td class="pricing-label">Price per Person</td>
                        <td class="pricing-value">${{ number_format($trip->price ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="pricing-label">Number of People</td>
                        <td class="pricing-value">{{ $booking->num_people }}</td>
                    </tr>
                    <tr>
                        <td class="pricing-label">Subtotal</td>
                        <td class="pricing-value">${{ number_format(($trip->price ?? 0) * $booking->num_people, 2) }}</td>
                    </tr>
                    @if(isset($booking->discount_amount) && $booking->discount_amount > 0)
                        <tr>
                            <td class="pricing-label">Discount</td>
                            <td class="pricing-value">-${{ number_format($booking->discount_amount, 2) }}</td>
                        </tr>
                    @endif
                    @if(isset($booking->tax_amount) && $booking->tax_amount > 0)
                        <tr>
                            <td class="pricing-label">Tax</td>
                            <td class="pricing-value">${{ number_format($booking->tax_amount, 2) }}</td>
                        </tr>
                    @endif
                    <tr class="total-row">
                        <td class="pricing-label">Total Amount</td>
                        <td class="pricing-value">
                            ${{ number_format(
                                (($trip->price ?? 0) * $booking->num_people)
                                - ($booking->discount_amount ?? 0)
                                + ($booking->tax_amount ?? 0),
                                2
                            ) }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Special Requests -->
        @if($booking->special_requests)
            <div class="special-requests">
                <div class="special-requests-title">Special Requests</div>
                <div class="special-requests-text">{{ $booking->special_requests }}</div>
            </div>
        @endif

        <!-- Thank You Section -->
        <div class="thank-you">
            <div class="thank-you-text">Thank You for Choosing Us!</div>
            <div class="thank-you-subtitle">We're excited to make your trip unforgettable</div>
        </div>
    </div>

    <!-- Footer -->
   <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


    <br>
    <div class="footer">
        <div class="contact-info">
            <strong>Need Help?</strong> Contact our support team
        </div>
        <div class="contact-info">
            Email: info@tripsorganiser.com | Phone: +1234567890
        </div>
        <div class="contact-info">
            Website: www.tripsorganiser.com
        </div>
        <div class="copyright">
            &copy; 2025 Anass SAKKAH's Trips Organiser. All rights reserved.
        </div>
    </div>
</div>
</body>
</html>
