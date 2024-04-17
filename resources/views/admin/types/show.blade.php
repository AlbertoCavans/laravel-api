@extends('layouts.app')

@section('title', 'Details Type')


@section('content')
<section>
    <div class="container">
        <a href="{{ route("admin.types.index") }}" class="btn btn-success my-3"><i class="fa-solid fa-rotate-left me-2"></i>Return to list</a>
        <h1>Details Type</h1>

        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                <h4 class="card-title">Type Name: {{ $type->label }}</h4>
                </div>
                <div class="card-body">
                  <p class="card-text my-3"><strong>Type color code:</strong> {{ $type->color }}</p>
                  <p class="card-text my-3"><strong>Badge:</strong> {!! $type->getBadge() !!}</p>
                  <a href="{{ route("admin.types.edit", $type) }}" class="btn btn-primary">Update Type</a>
                  <h4>Post in this type:</h4>

                  <!-- @dump($type->projects) -->
                  <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($projects_by_type as $project)

                        
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->name_project }}</td>
                            <td>
                            <a href="{{ route("admin.projects.show", $project) }}" class="btn btn-info my-3">
                            <i class="fa-solid fa-book"></i></a>
                            
                             <a href="{{ route("admin.projects.edit", $project) }}" class="btn btn-warning my-3"><i class="fa-solid fa-pen-to-square"></i></a>
      
                             <button data-bs-target="#delete-project-{{ $project->id }}-modal"  class="btn btn-danger my-3" type="button" class="btn btn-primary" data-bs-toggle="modal"><i class="fa-solid fa-xmark"></i></button>


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>

                  {{ $projects_by_type->links('pagination::bootstrap-5') }}
                </div>   
              </div>
            </div>
        </div>
    </div>
  </section>
@endsection

@section("modal")
@foreach($projects_by_type as $project)
  <div class="modal fade" id="delete-project-{{ $project->id }}-modal" data-bs-backdrop="static" 
  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminazione progetto {{ $project->name_project }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Sei sicuro di voler eliminare il progetto {{ $project->name_project }}?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annulla</button>
        <form action="{{ route("admin.projects.destroy", $project) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-warning">Elimina</button>
        </form>
      </div>
    </div>
  </div>
</div>


@endforeach
@endsection



@section("css")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
