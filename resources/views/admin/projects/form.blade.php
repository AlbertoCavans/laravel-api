@extends('layouts.app')

@section('title', empty($project->id) ? 'Create Project' : 'Edit Project')


@section('content')
  <section>
    <div class="container">
        <a href="{{ route("admin.projects.index") }}" class="btn btn-success my-3"><i class="fa-solid fa-rotate-left me-2"></i>Return to list</a>
        <h1>{{ empty($project->id) ? 'Create Project' : 'Edit Project' }}</h1>

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form enctype="multipart/form-data" action="{{ empty($project->id) ? route("admin.projects.store") : route("admin.projects.update", $project) }}"
        class="row g-3" method="POST">
        @if(!empty($project->id))
        @method("PATCH")
        @endif
        @csrf
        
        <div class="col-6">
            <!-- NAME PROJECT INPUT -->
            <label for="name_project" class="form-label">Name of the project</label>
            <input type="text" @class([ 'form-control', 'is-invalid' => $errors->has('name_project') ]) id="name_project" name="name_project"
            value="{{ old("name_project", $project["name_project"]) }}">
            @error("name_project")
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <!-- TYPE PROJECT SELECT -->
            <label for="type_id" class="form-label">Type of project</label>
            <select name="type_id" id="type_id" @class([ 'form-select', 'is-invalid' => $errors->has('type_id') ])>
            <option value="" class="d-none">Select a type</option>
            @foreach($types as $type)

            <option {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->label }}</option>
            @endforeach
            </select>
            @error("type_id")
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <!-- INPUT FILE - IMG -->

            <div>
                <label class="form-label" for="img">Project Cover</label>
                <input @class([ 'form-control', 'is-invalid' => $errors->has('img') ]) 
                type="file" id="img" name="img">
                @error("img")
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if(!empty($project->img))
                <img class="w-100 mt-3" src="{{ asset("storage/" . $project->img) }}" alt="">
                @endif
            </div>


        </div>

        <div class="col-6">
            @foreach($technologies as $technology)
            <div>
            <input type="checkbox" name="technologies[]" id="technologies-{{ $technology->id }}" class="form-check-label" value="{{ $technology->id }}" 
            {{ in_array($technology->id, old("technologies", $technologies_id_project ?? [])) ? "checked" : "" }} >
            <label for="technologies-{{ $technology->id }}" class="form-check-label">{{ $technology->name }}</label>
            </div>
            @endforeach
        </div>

        <div class="col-12">
            <label for="description" class="form-label">Description of the project</label>
            <textarea type="text" @class([ 'form-control', 'is-invalid' => $errors->has('description') ]) id="description" 
                name="description" rows="5">{{ old("description", $project["description"]) }}</textarea>
            @error("description")
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <button class="btn btn-primary">
            <i class="fa-solid fa-upload me-2"></i>{{ empty($project->id) ? 'Create' : 'Edit' }}
            </button>
        </div>
        </form>
    </div>
  </section>
@endsection



@section("css")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
