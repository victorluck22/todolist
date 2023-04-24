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


@endsection
