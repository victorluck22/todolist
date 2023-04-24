@extends('layouts.blue_layout')

@section('title', 'Tarefas')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('Home') }}"> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tarefas</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Tarefas</h6>
        </div>
        <div class="card-body">
            <div class="card-title">
                <h5>Tarefas Cadastradas - <a href="{{ route('tasks.create') }}" class="btn btn-success end-content">Nova Tarefa</a></h5>
            </div>


            <div class="table-responsive">
                <table class="table table-bordered table-hover tb" id="tasks_main">
                    <thead>
                        <th>Ações</th>
                        <th>Atividade</th>
                        <th>Projeto</th>
                        <th>Status</th>
                    </thead>

                </table>
            </div>


        </div>
    </div>

@endsection



