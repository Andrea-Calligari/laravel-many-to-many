@extends('layouts.app')

@section('content')

<section class="py-5">
    <div class="container">

        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Description</th>
                    <th width="100px" scope="col">Type</th>
                    <th width="15%" scope="col">Working Hours</th>
                    <th scope="col">Co-workers</th>
                
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->project_name }}</td>
                        <td>{{ $project->slug }}</td>
                        <td>{{  $project->description }}</td>
                        <td>{{ $project->type ? $project->type->name : '' }}</td>
                        <td class="fs-5 ">{{ $project->working_hours }}</td>
                        <td>{{ $project->co_workers }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</section>

@endsection

<style lang="scss" scoped>

 

</style>