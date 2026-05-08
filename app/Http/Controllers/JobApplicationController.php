<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobApplications = JobApplication::where('user_id', Auth::id())->latest()->get();
        return view('job_applications.index', compact('jobApplications'));        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('job_applications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'job_description' => 'nullable|string',
            'source' => 'nullable|string|max:255',
            'external_url' => 'nullable|url',
            'salary_range' => 'nullable|string|max:255',
            'applied_at' => 'required|date',
            'status' => 'required|string|max:50',
        ]);

        JobApplication::create([
            'user_id' => Auth::id(),
            'job_title' => $request->job_title,
            'company_name' => $request->company_name,
            'location' => $request->location,
            'job_description' => $request->job_description,
            'source' => $request->source,
            'external_url' => $request->external_url,   
            'salary_range' => $request->salary_range,
            'applied_at' => $request->applied_at,
            'status' => $request->status,
        ]);

        return redirect()->route('job_applications.index')->with('success', 'Job application created successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
