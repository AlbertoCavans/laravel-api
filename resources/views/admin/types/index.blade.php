@extends('layouts.app')

@section('title', 'List Type')

@section('content')

<section>
    <div class="container">
    <a href="{{ route("admin.types.create") }}" class="btn btn-success my-3"><i class="fa-solid fa-upload me-2"></i>Add new type</a>
        <h1>List Types</h1>

        <table class="table table-striped border">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Label</th>
                    <th>Color</th>
                    <th>Badge</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($types as $type)
                   <tr>
                       <td>{{ $type->id }}</td>
                       <td>{{ $type->label }}</td>
                       <td>{{ $type->color }}</td>
                       <td>{!! $type->getBadge() !!}</td>
                       <td>
                       <a href="{{ route("admin.types.show", $type) }}" class="btn btn-info my-3"><i class="fa-solid fa-book"></i></a>
                       <a href="{{ route("admin.types.edit", $type) }}" class="btn btn-warning my-3"><i class="fa-solid fa-pen-to-square"></i></a>
                       <button data-bs-target="#delete-type-{{ $type->id }}-modal"  class="btn btn-danger my-3" type="button" class="btn btn-primary" data-bs-toggle="modal"><i class="fa-solid fa-xmark"></i></button>


                       </td>
                       
                   </tr>
                @empty
                   <tr>
                       <td colspan="100%">
                           <span>Nessun risultato trovato</span>
                       </td>
                   </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection

@section("modal")
@foreach($types as $type)
  <div class="modal fade" id="delete-type-{{ $type->id }}-modal" data-bs-backdrop="static" 
  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Elimination Type {{ $type->label }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Do you really want to eliminate Type {{ $type->label }}? This action <strong>will also eliminate
            all the project of this type.</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annulla</button>
        <form action="{{ route("admin.types.destroy", $type) }}" method="POST">
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