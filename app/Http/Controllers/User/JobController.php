<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\SellReport;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\User\JobCreateRequest;
use App\Http\Requests\User\JobUpdateRequest;
use Carbon\Carbon;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("user.jobs.index");
    }
    public function ver_job(string $id)
    {

        $jobs_detail = Job::select("sr.total_mount", "sr.worker_pay","jobs.id", "jobs.status", "jobs.pay_status", "jobs.date", "jobs.end_datetime", "jobs.observations", "jobs.end_datetime", "jobs.created_at", "c.name", "c.owner")
            ->join('computers as c', 'c.id', '=', 'jobs.computer_id')
            ->join('sell_reports as sr', 'sr.job_id', '=', 'jobs.id')
            ->where("jobs.id","=",$id)
            ->get();

        return $jobs_detail;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function listar_jobs()
    {
        $jobs = Job::select("jobs.id", "jobs.status", "jobs.pay_status", "jobs.date", "jobs.end_datetime", "c.name", "c.owner")
            ->join('computers as c', 'c.id', '=', 'jobs.computer_id')
            ->get();

        return DataTables::of($jobs)
            ->editColumn('date', function ($job) {
                return $job->date ? Carbon::parse($job->date)->format('d/m/Y') : '';
            })
            ->editColumn('end_datetime', function ($job) {
                return $job->end_datetime ? Carbon::parse($job->end_datetime)->format('d/m/Y H:i:s') : 'No ha cerrado venta';
            })
            ->addColumn('action', function ($job) {
                if ($job->status == "activo" && $job->end_datetime == "") {
                    return '<a id="job_show" href="javascript:void(0)" class="btn btn-sm btn-info" data-id="' . $job->id . '"><i class="fas fa-eye"></i></a>&nbsp' .
                        '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $job->id . '" data-toggle="modal" data-target="#md_edit_job" id="bt_job_edit"><i class="fas fa-pen"></i></a>&nbsp'.
                        '<a id="job_close" href="javascript:void(0)" class="btn btn-sm btn-danger" data-id="' . $job->id . '"><i class="fas fa-arrow-circle-right"></i></a>'
                        ;
                } else {
                    return '<a id="job_show" href="javascript:void(0)" class="btn btn-sm btn-info" data-id="' . $job->id . '"><i class="fas fa-eye"></i></a>';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobCreateRequest $request)
    {
        $new_job =  Job::create([
            'date' => $request->date_start_create,
            'computer_id' => $request->select_computer_create,
            'user_id' => Auth::user()->id
        ]);

        SellReport::create([
            'job_id' => $new_job->id
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $job_edit = Job::select()->where("id", $id)->get();
        return $job_edit;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobUpdateRequest $request, string $id)
    {
        $job = Job::findOrFail($id);
        $job->update([
            "status"=> $request->status,
            "pay_status"=> $request->pay_status,
            "observations"=> $request->observations
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
