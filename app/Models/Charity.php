<?php
// Charity model

// Charity.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    use HasFactory;

    protected $primaryKey = 'CharityID';

    protected $fillable = [
        'CharityName',
        'Description',
        'Email',
        'Phone',
        'Address',
        'Logo',
        'RegistrationDate',
        'FounderName',
        'EstablishedYear',
        'DonationTotal',
        'IsActive',
    ];

    protected $casts = [
        'RegistrationDate' => 'date',
        'IsActive' => 'boolean',
    ];

    /**
     * The categories that belong to the charity.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'charity_categories', 'CharityID', 'CategoryID');
    }

    /**
     * Get the users who have marked this charity as a favorite.
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorite_charities', 'charity_id', 'user_id');
    }
}

