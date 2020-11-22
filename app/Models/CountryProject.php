<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryProject extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'project_id'];

    public function countries()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
