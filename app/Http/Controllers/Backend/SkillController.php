<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $skills = Skill::all();
        return view('skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('skills.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSkillRequest $request): RedirectResponse
    {
        if ($request->hasFile('image')){
            $image = $request->file('image')->store('skills');

            Skill::create([
                'name' => $request->name,
                'image' => $image
            ]);

            return to_route('skills.index');
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
    public function edit(Skill $skill): View
    {
        return view('skills.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'min:3'],
            'image' => ['nullable', 'image'],
        ]);

        $image = $skill->image;
        if($request->hasFile('image')){
            Storage::delete($skill->image);
            $image = $request->file('image')->store('skills');
        }

        $skill->update([
            'name' => $request->name,
            'image' => $image
        ]);

        return to_route('skills.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill): RedirectResponse
    {
        Storage::delete($skill->image);
        $skill->delete();

        return back();
    }
}
