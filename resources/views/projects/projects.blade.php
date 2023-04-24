
@extends('layouts.blue_layout')

@section('title', 'Projetos')


@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('Home') }}"> Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Projetos</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header">
        <h6 class="card-title">Projetos</h6>
    </div>
    <div class="card-body">
        <div class="card-title">
            <h5>Projetos cadastrados - <a href="{{ route('projects.create') }}" class="btn btn-success end-content">Novo Projeto</a></h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover tb" id="projects_main">
                <thead>
                    <th>Ações</th>
                    <th>Id</th>
                    <th>Projeto</th>
                    <th>Data Início</th>
                    <th>Data Fim</th>
                    <th>Progresso</th>
                </thead>
            </table>
        </div>


    </div>
</div>


@endsection
