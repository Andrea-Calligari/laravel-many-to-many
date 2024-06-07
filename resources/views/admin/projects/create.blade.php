@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container">
            <h1 class="mb-5 text-center text-success"> Create your new project!!</h1>
        <form action="{{ route('admin.projects.store') }}" method="POST">

            {{-- Cross Site Request Forgering --}}

            @csrf


            <div class="mb-3">
                <label for="project_name" class="form-label">Project Name</label>
                <input type="text" name="project_name" class="form-control" id="project_name"
                placeholder="Insert your project name " value="{{old('project_name')}}">
            </div>

            <div class="mb-3">
                <label for="type">Type Select</label>
                <select class="form-select" name="type_id" id="type_id">
                    <option selected value="">--Select a Type--</option>
                    @foreach($types as $type)
                        <option @selected($type->id == old('type_id')) value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <div>Choose a Technology</div>
                    <div  class="d-flex gap-3 ">
                        @foreach ($technologies as $technology)

                            <label class="form-check-label"
                                for="technologies-{{$technology->id}}">{{$technology->name}}</label>
                            <input @checked(in_array($technology->id, old('technologies', []))) value="{{$technology->id}}"
                                class="form-check-input " type="checkbox" name="technologies[]"
                                id="technologies-{{$technology->id}}">
                        @endforeach

                    </div>

                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3"
                    placeholder="Descrizione del personaggio">{{old('description')}}</textarea>
            </div>
            <div class="mb-3">
                <label for="working_hours" class="form-label">Working-Hours</label>
                <input type="number" name="working_hours" class="form-control" id="working_hours"
                    placeholder="Insert working hours  " value="{{old('working_hours')}}">
            </div>
            <div class="mb-3">
                <label for="co_workers" class="form-label">Co-Working</label>
                <input type="text" name="co_workers" class="form-control" id="co_workers"
                    placeholder="who is yours co-workers " value="{{old('co_workers')}}">
            </div>
            <button class="btn btn-outline-success">Create</button>
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