<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'type', // Added type field
        'date',
        'duration',
        'location',
        'description',
        'price',
        'max_places', // Added max_places field
        'image_path',
        'user_id',
    ];

    protected $casts = [
        'date' => 'date',
        'price' => 'decimal:2',
        'max_places' => 'integer',
    ];

    /**
     * The possible trip types.
     */
    public const TYPES = [
        'trip' => 'Trip',
        'hiking' => 'Hiking'
    ];

    /**
     * Get the user that owns the trip.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comments for the trip.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get only visible comments for the trip.
     */
    public function visibleComments()
    {
        return $this->hasMany(Comment::class)->where('is_visible', true);
    }

    /**
     * Get the bookings for the trip.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the total number of people booked for this trip.
     */
    public function getTotalPeopleAttribute()
    {
        return $this->bookings->sum('num_people');
    }

    /**
     * Get the total bookings count for this trip.
     */
    public function getBookingsCountAttribute()
    {
        return $this->bookings->count();
    }

    /**
     * Get available places remaining for this trip.
     */
    public function getAvailablePlacesAttribute()
    {
        if (!$this->max_places) {
            return null; // Unlimited places
        }

        return max(0, $this->max_places - $this->total_people);
    }

    /**
     * Check if the trip is fully booked.
     */
    public function getIsFullyBookedAttribute()
    {
        if (!$this->max_places) {
            return false; // Unlimited places
        }

        return $this->total_people >= $this->max_places;
    }

    /**
     * Get the formatted type name.
     */
    public function getTypeNameAttribute()
    {
        return self::TYPES[$this->type] ?? 'Trip';
    }

    /**
     * Scope a query to only include trips of a specific type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }


}
