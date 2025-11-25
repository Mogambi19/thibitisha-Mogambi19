<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Akaunting\Sortable\Sortable;

class Speciality extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['name'];
    public $sortable = ['name'];

    public function subSpecialities()
    {
        return $this->hasMany(SubSpeciality::class);
    }
}
