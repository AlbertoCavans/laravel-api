<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $types = Type::orderBy("id", "DESC")->paginate(20);
        return view("admin.types.index", compact("types"));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $type = new Type;
        return view("admin.types.form", compact("type"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $type = new Type;
        $type->fill($data);
        $type->save();

        return redirect()->route("admin.types.show", $type);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     */
    public function show(Type $type)
    {
        $projects_by_type = $type->projects()->paginate(10);
        return view("admin.types.show", compact("type", "projects_by_type"));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     */
    public function edit(Type $type)
    {
        return view("admin.types.form", compact("type"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     */
    public function update(Request $request, Type $type)
    {
        $data = $request->all();

        $type->update($data);
        return redirect()->route("admin.types.show", $type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     */
    public function destroy(Type $type)
    {
        foreach($type->projects as $project) {
            $project->delete();
        }
        $type->delete();
        return redirect()->back();
    }
}
