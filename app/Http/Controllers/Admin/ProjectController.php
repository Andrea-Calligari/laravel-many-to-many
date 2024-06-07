<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use App\Models\Project;
 use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with(['type', 'type.projects'])->get();// 2 query



        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::orderBy('name', 'asc')->get();

        $technologies = Technology::orderBy('name', 'asc')->get();

        return view('admin.projects.create', compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

        // validazione in StoreProjectController
        $form_data = $request->validated();



        // dd($form_data);

        $base_slug = Str::slug($form_data['project_name']);
        $slug = $base_slug;
        $n = 0;



        do {
            $find = Project::where('slug', $slug)->first(); // null | Project
            // @dump($n);
            if ($find !== null) {
                $n++;
                $slug = $base_slug . '-' . $n;
            }

        } while ($find !== null);


        $form_data['slug'] = $slug;

        $project = Project::create($form_data);

        //controllo invio tecnologie 
        if($request->has('technologies')){
            $project->technologies()->attach($request->technologies);
        }

        return to_route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load(['type', 'type.projects']);

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $project->load(['technologies']);
        $technologies = Technology::orderBy('name', 'asc')->get();
        $types = Type::orderBy('name', 'asc')->get();

        return view('admin.projects.edit', compact('project','types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        // validazione in UpdateProjectController

        $form_data = $request->validated();



        //  $portfolio->fill($form_data);

        // $portfolio->save();

        //oppure - fa subito il fill()e il salvataggio- save()

        $project->update($form_data);

        return to_route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index');
    }
}
