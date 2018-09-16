<?php

namespace App\Http\Controllers;

use App\JobProposal;
use Illuminate\Http\Request;

class JobProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jobProposal = new JobProposal;
        $jobProposal->salary = $request->salary;
        $jobProposal->days_off = $request->days_off;
        $jobProposal->description = $request->notes;
        $jobProposal->application_id = $request->application_id;
        $jobProposal->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobProposal  $JobProposal
     * @return \Illuminate\Http\Response
     */
    public function show(JobProposal $JobProposal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobProposal  $JobProposal
     * @return \Illuminate\Http\Response
     */
    public function edit(JobProposal $JobProposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobProposal  $jobProposal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jobProposal = JobProposal::find($id);
        $jobProposal->salary = $request->salary;
        $jobProposal->days_off = $request->days_off;
        $jobProposal->description = $request->notes;
        $jobProposal->application_id = $request->application_id;
        $jobProposal->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobProposal  $JobProposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobProposal $JobProposal)
    {
        //
    }
}
