<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *

     */
    public function index()
    {
        $projects = Project::select(["id", "type_id", "name_project", "description", "img", "slug"])
        ->with(["type:id,label,color", "technologies:id,name,color_label"])
        ->orderBy("id", "ASC")
        ->paginate(12);

        foreach ($projects as $project) {
            $project->img = !empty($project->img) ? asset("/storage/" . $project->img) : null;
            /* $project->description = $project->getAbstract(45); */
        };

        return response()->json($projects);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id

     */
    public function show($slug)
    {
        $project = Project::select(["id", "type_id", "name_project", "description", "img", "slug"])
        ->where("slug", $slug)
        ->with(["type:id,label,color", "technologies:id,name,color_label"])
        ->first();
        $project->img = !empty($project->img) ? asset("/storage/" . $project->img) : null;
        /* $project->description = $project->getAbstract(45); */

        return response()->json($project);
    }
}
