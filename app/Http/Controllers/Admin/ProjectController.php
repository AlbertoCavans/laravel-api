<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $projects = Project::orderBy("id", "DESC")->paginate(20);
        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $project = new Project;
        $types = Type::all();
        $technologies = Technology::all();
        return view("admin.projects.form", compact("project", "types", "technologies"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(StoreProjectRequest $request)
    {

       $request->validated();

       $data = $request->all();
      

       

       $project = new Project;
       $project->fill($data);
       $project->slug = Str::slug($project->name_project);
       if (Arr::exists($data ,"img")) {
       $img_link = Storage::put("uploads/projects", $data['img']);
       $project->img = $img_link;
       }
       $project->save();

       if (array_key_exists("technologies", $data)) {
       $project->technologies()->attach($data["technologies"]);
       }

       return redirect()->route("admin.projects.show", $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     */
    public function show(Project $project)
    {
        $technologies = Technology::all();
        return view('admin.projects.show', compact('project','technologies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        $technologies_id_project = $project->technologies->pluck("id")->toArray();
        return view("admin.projects.form", compact("project", "types", "technologies", "technologies_id_project"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        $request->validated();

        $data = $request->all();
        $project->fill($data);
        $project->slug = Str::slug($project->name_project);

        if (Arr::exists($data ,"img")) {
            if(!empty($project->img)) {
                Storage::delete($project->img);
            }
            $img_link = Storage::put("uploads/projects", $data['img']);
            $project->img = $img_link;
        }
        $project->save();



        if(Arr::exists($data, "technologies")) {
        $project->technologies()->sync($data["technologies"]);
        } else {
            $project->technologies()->detach();
        }
 
        return redirect()->route("admin.projects.show", $project);
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     */
    public function destroy(Project $project)
    {
        $project->technologies()->detach();
        $project->delete();
        return redirect()->back();
    }
}
