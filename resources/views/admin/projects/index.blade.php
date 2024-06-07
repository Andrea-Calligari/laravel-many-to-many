@extends('layouts.app')

@section('content')

<section class="py-5">
  <div class="container">

    <table class="table table-primary table-hover">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Slug</th>
          <th scope="col">Description</th>
          <th width="100px" scope="col">Type</th>
          <th width="150px" scope="col">Working-hours</th>
          <th scope="col">Co-workers</th>
          <th colspan="2"scope="col">Action</th>

        </tr>
      </thead>
      <tbody>
        @foreach($projects as $project)
        <tr>
          <th scope="row">
            <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
              href="{{ route('admin.projects.show', $project) }}">
              {{ $project->project_name }}
            </a>
          </th>
          <td>{{ $project->slug }}</td>
          <td>{{ $project->description }}</td>
          <td>{{ $project->type ? $project->type->name : '' }}</td>
          <td class="fs-5">{{ $project->working_hours }}</td>
          <td>{{ $project->co_workers }}</td>
          <td>
            
            <a class="btn btn-outline-warning" href="{{ route('admin.projects.edit', $project) }}">Edit</a>
           
          </td>
          <td>
            <div id="form" class="d-flex justify-content-center align-items-center gap-4">
              <button class="btn btn-outline-danger" id="trash">Trash</button>
            </div>
          </td>
        </tr>
        @endforeach

        <script>
          let trash = document.getElementById('trash')

          trash.addEventListener('click', function () {

            let form = document.getElementById('form')
            let trashConf = confirm('Sei sicuro di volere eliminare?')
            if (trashConf === true) {

              form.innerHTML +=
                `
                    <form action="{{ route('admin.projects.destroy',$project) }}" method="POST">
                      @method('DELETE')
                      @csrf
    
                      <button type="submit" style="display:none;" id='confirm'>trash</button>
                            
                    </form>
                  `
              let confirm = document.getElementById('confirm').click()
            }

          });
        </script>
      </tbody>
    </table>
  </div>

</section>

@endsection