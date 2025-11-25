<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function practitioners()
    {
        // Update this relationship as needed
        return $this->hasMany(User::class, 'status_id');
    }
}
