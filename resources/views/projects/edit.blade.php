@extends('layouts.blue_layout')

@section('title', 'Projetos')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('Home') }}"> Home</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('projects.index') }}"> Projetos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Alterar Projeto</li>
    </ol>
</nav>
<div class="card">

    <div class="card-header">
        <h6 class="card-title">Projetos</h6>
    </div>
    @component('projects._components.project_form', ['project' => $project])
    @endcomponent
</div>
<hr>
<div class="card">
    <div class="card-header">
        <h6 class="card-title">Tarefas</h6>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <thead>
                <th>ID</th>
                <th>Tarefa</th>
                <th>Descrição</th>
                <th>Prev. Fim</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td><a href="{{ route("tasks.edit", ['task' => $task->id]) }}" class="btn btn-primary">Alterar</a></td>
                        <td>{{ $task->item }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ date('d/m/Y', strtotime($task->prev_end)) }}</td>
                        <td>{{ $task->status_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
