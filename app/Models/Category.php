<?php
// Category model

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'Description',
        'Image',
    ];

    public function charities()
    {
        return $this->belongsToMany(Charity::class, 'charity_categories', 'CategoryID', 'CharityID');
    }
}
