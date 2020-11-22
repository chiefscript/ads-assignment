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
        $data = [
            'countries'       => Country::all(),
            'offices'         => Office::all(),
            'readiness_types' => ReadinessType::all(),
            'statuses'        => Status::all(),
            'projects'        => Project::all(),
            'readiness_type'  => ReadinessType::all(),
        ];


        return view('projects.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $project = Project::create([
            'reference'          => $request->reference,
            'title'              => $request->title,
            'office_id'          => $request->office,
            'grant_amount'       => $request->grant,
            'gcf_date'           => $request->gcf_date,
            'start_date'         => $request->start_date,
            'end_date'           => $request->end_date,
            'first_disbursement' => $request->first_disbursement,
            'status_id'          => $request->status,
            'readiness_type_id'  => $request->readiness_type,
            'read_nap'           => $request->r_nap,
            'created_by'         => Auth::user()->id
        ]);

        if ($project && isset($request->country)) {
            foreach ($request->country as $item) {
                CountryProject::create([
                    'country_id' => $item,
                    'project_id' => $project->id
                ]);
            }
        }

        $data = [
            'countries'       => Country::all(),
            'offices'         => Office::all(),
            'readiness_types' => ReadinessType::all(),
            'statuses'        => Status::all(),
            'projects'        => Project::all(),
            'readiness_type'  => ReadinessType::all(),
        ];


        return view('projects.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        return Project::whereId($id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request)
    {
        Project::whereId($request->project_id)
            ->update([
                'reference'          => $request->reference,
                'title'              => $request->title,
                'grant_amount'       => $request->grant,
                'gcf_date'           => $request->gcf_date,
                'start_date'         => $request->start_date,
                'end_date'           => $request->end_date,
                'first_disbursement' => $request->first_disbursement,
                'status_id'          => $request->status,
                'readiness_type_id'  => $request->readiness_type,
                'read_nap'           => $request->r_nap,
            ]);

        if (isset($request->country)) {
            foreach ($request->country as $country) {
                CountryProject::firstOrCreate([
                    'country_id' => $country,
                    'project_id' => $request->project_id
                ]);
            }
        }

        $data = [
            'countries'       => Country::all(),
            'offices'         => Office::all(),
            'readiness_types' => ReadinessType::all(),
            'statuses'        => Status::all(),
            'projects'        => Project::all(),
            'readiness_type'  => ReadinessType::all(),
        ];


        return view('projects.index', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        Project::destroy($id);

        $data = [
            'countries'       => Country::all(),
            'offices'         => Office::all(),
            'readiness_types' => ReadinessType::all(),
            'statuses'        => Status::all(),
            'projects'        => Project::all(),
            'readiness_type'  => ReadinessType::all(),
        ];


        return view('projects.index', $data);
    }
}
