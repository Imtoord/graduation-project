<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $primaryKey = 'CampaignID'; // Set the primary key

    protected $fillable = [
        'CampaignName',
        'Description',
        'StartDate',
        'EndDate',
        'GoalAmount',
        'CurrentAmount',
        'CharityID',
        'ImageURL',
    ];

    // Define the relationship with the Charity model
    public function charity()
    {
        return $this->belongsTo(Charity::class, 'CharityID');
    }
}
