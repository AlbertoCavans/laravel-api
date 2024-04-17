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
        $projects = Project::select(["id", "type_id", "name_project", "description", "img"])
        ->with(["type:id,label,color", "technologies:id,name,color_label"])->paginate(12);
        return response()->json($projects);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id

     */
    public function show($id)
    {
        //
    }
}
