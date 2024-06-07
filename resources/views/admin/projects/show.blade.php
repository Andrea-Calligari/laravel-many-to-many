@extends('layouts.app')
@section('content')

<div class="container p-5">
    <div class="col-6">
        <div class="card ">
            <div class="card-header">
                <div class="card-title">
                    <p class="fst-italic"><span class="fw-bold">Name:</span> {{$project->project_name}}</p>
                </div>
                <p class="fst-italic"><span class="fw-bold">Slug:</span> {{$project->slug}}</p>
                <p class="fst-italic"><span class="fw-bold">Description:</span> {{$project->description}}</p>
                <p class="fst-italic"><span class="fw-bold">Type:</span>{{ $project->type ? $project->type->name : '' }}</p>
                <div>
                    <ul class="d-flex gap-2 list-unstyled">
                        @foreach ($project->technologies as $technology)
                        <li> {{$technology->name}}</li>
                        
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <p class="fst-italic"><span class="fw-bold">Working-Hours:</span> {{$project->working_hours}}</p>
                <p class="fst-itali"><span class="fw-bold">Co-Workers:</span> {{$project->co_workers}}</p>
                <div id="form" class="d-flex justify-content-center align-items-center gap-4">
                    <a class="btn btn-outline-warning" href="{{ route('admin.projects.edit', $project)}}">Edit</a>
                    <button class="btn btn-outline-danger" id="trash">Trash</button>
                </div>
                <script>
                    let trash = document.getElementById('trash')

                    trash.addEventListener('click', function () {

                        let form = document.getElementById('form')

                        let trashConf = confirm('Sei sicuro di volere eliminare?')
                        if (trashConf === true) {

                            form.innerHTML +=
                                `
                              <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                              @method('DELETE')
                              @csrf
    
                              
         
                              <button type="submit" style="display:none;" id='confirm'>trash</button>
    
                              </form>
                            `
                            let confirm = document.getElementById('confirm').click()

                        }


                    })
                </script>

            </div>
        </div>
    </div>
</div>





@endsection