@extends('layouts.blue_layout')

@section('title', 'Tarefas')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('Home') }}"> Home</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('tasks.index') }}"> Tarefas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Alterar Tarefa</li>
    </ol>
</nav>
<div class="card">

    <div class="card-header">
        <h6 class="card-title">Tarefas</h6>
    </div>
    @component('tasks._components.task_form', ["projects" => $projects, "task" => $task])
    @endcomponent
</div>
@endsection
