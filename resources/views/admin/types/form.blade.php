@extends('layouts.app')

@section('title', empty($type->id) ? 'Create Type' : 'Edit Type')


@section('content')
<section>
    <div class="container">
    <a href="{{ route("admin.types.index") }}" class="btn btn-success my-3"><i class="fa-solid fa-rotate-left me-2"></i>Return to list</a>
    <h1>{{ empty($type->id) ? 'Create Type' : 'Edit Type' }}</h1>

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ empty($type->id) ? route("admin.types.store") : route("admin.types.update", $type) }}"
        class="row g-3" method="POST">
        @if(!empty($type->id))
        @method("PATCH")
        @endif
        @csrf

        <div class="col-1">
            <label for="color">Color</label>
            <input type="color" class="form-control" id="color" name="color"  value="{{ old("color", $type["color"]) }}">
        </div>

        <div class="col-11">
            <label for="label">Label</label>
            <input type="text" class="form-control" id="label" name="label"  value="{{ old("label", $type["label"]) }}">
        </div>
        



        <div class="col-12">
            <button class="btn btn-primary">
            <i class="fa-solid fa-upload me-2"></i>{{ empty($type->id) ? 'Create' : 'Edit' }}
            </button>
        </div>

        </form>

    </div>
</section>

@endsection


@section("css")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection