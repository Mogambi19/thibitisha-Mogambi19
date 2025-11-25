<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practitioner extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'full_name',
        'profile_photo_url',
        'status_id',
        'speciality_id',
        'sub_speciality_id',
        'date_of_registration',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }

    public function subSpeciality()
    {
        return $this->belongsTo(SubSpeciality::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }
}
