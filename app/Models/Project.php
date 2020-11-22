<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'reference',
        'title',
        'office_id',
        'grant_amount',
        'gcf_date',
        'start_date',
        'end_date',
        'first_disbursement',
        'status_id',
        'readiness_type_id',
        'read_nap',
        'created_by'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public function readiness_type()
    {
        return $this->belongsTo(ReadinessType::class, 'readiness_type_id', 'id');
    }

    public function country_projects()
    {
        return $this->hasMany(CountryProject::class, 'project_id', 'id');
    }
}
