<?php

// app/Models/FavoriteCharity.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteCharity extends Model
{
    use HasFactory;

    protected $primaryKey = 'FavoriteCharityID';

    protected $fillable = [
        'UserID',
        'CharityID',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function charity()
    {
        return $this->belongsTo(Charity::class, 'CharityID');
    }
}
