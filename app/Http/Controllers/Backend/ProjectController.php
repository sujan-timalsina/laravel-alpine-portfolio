<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $skills = Skill::all();
        return view('projects.create', compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request): RedirectResponse
    {
        /*
        $project = new Project();
        $project->name = $request->name;
        $project->image = $request->image->store('images');
        $project->project_url = $request->project_url;
        $project->skill_id = $request->skill_id;
        $project->save();

        return redirect()->route('projects.index');
        */

        if($request->hasFile('image')){
            $image = $request->file('image')->store('projects');

            Project::create([
                'name' => $request->name,
                'image' => $image,
                'project_url' => $request->project_url,
                'skill_id' => $request->skill_id
            ]);

            return to_route('projects.index');
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project): View
    {
        $skills = Skill::all();
        return view('projects.edit', compact('project', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3',
            'image' => 'nullable|image',
            'project_url' => 'nullable|url',
            'skill_id' => 'required|exists:skills,id',
        ]);

        $image = $project->image;
        if($request->hasFile('image')){
            Storage::delete($project->image);
            $image = $request->file('image')->store('projects');
        }

        $project->update([
            'name' => $request->name,
            'image' => $image,
            'project_url' => $request->project_url,
            'skill_id' => $request->skill_id
        ]);

        return to_route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        Storage::delete($project->image);
        $project->delete();

        return to_route('projects.index');
    }
}
