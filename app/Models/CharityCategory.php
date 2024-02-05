<?php

// In the CharityCategory model file (e.g., app/Models/CharityCategory.php)
// CharityCategory model

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharityCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'CharityID',
        'CategoryID',
    ];

    public function charity()
    {
        return $this->belongsTo(Charity::class, 'CharityID');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID');
    }
}
