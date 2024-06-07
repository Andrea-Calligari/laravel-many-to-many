@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container">

        <form action="{{ route('admin.projects.update', $project) }}" method="POST">

            {{-- Cross Site Request Forgering --}}

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="project_name" class="form-label">Project Name</label>
                <input type="text" name="project_name" class="form-control" id="project_name" placeholder="Insert your project name "
                    value="{{old('project_name', $project->project_name)}}">
            </div>
             <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" id="slug" placeholder="Insert slug "
                    value="{{old('slug', $project->slug)}}">
            </div> 
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3"
                    placeholder="Descrizione del personaggio">{{old('description', $project->description)}}</textarea>
            </div>
            <div class="mb-3">
                <label for="working_hours" class="form-label">Working-Hours</label>
                <input type="number" name="working_hours" class="form-control" id="working_hours"
                    placeholder="Insert working hours  " value="{{old('working_hours', $project->working_hours)}}">
            </div>
            <div class="mb-3">
                <label for="co_workers" class="form-label">Co-Working</label>
                <input type="text" name="co_workers" class="form-control" id="co_workers"
                    placeholder="who is yours co-workers " value="{{old('co_workers', $project->co_workers)}}">
            </div>
            <button class="btn btn-outline-success">Save</button>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)

                        <li>
                            {{$error}}
                        </li>

                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</section>

@endsection