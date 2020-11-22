<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CountryProject;
use App\Models\Office;
use App\Models\Project;
use App\Models\ReadinessType;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProjectAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $projects = Project::with(['readiness_type', 'office', 'status'])->get();

        return response()->json($projects);
    }

    public function projectStatus($status)
    {
        $status = Status::whereName($status)->first();
        $projects = Project::where('status_id', $status->id)->with(['readiness_type', 'office', 'status'])->get();

        return response()->json($projects);
    }

    public function countryProjects($country)
    {
        $country = Country::whereName($country)->first();
        $projects = Project::join('country_projects', 'projects.id', '=', 'country_projects.project_id')
            ->where('country_projects.country_id', $country->id)
            ->with(['readiness_type', 'office', 'status'])
            ->get();

        return response()->json($projects);
    }
}
