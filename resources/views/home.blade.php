@extends('layouts.blue_layout')

@section('title', 'Home')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <h1>Bem-vindo! {{ Auth::user()->name }}</h1>

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Minhas Atividades</h6>
        </div>
        <div class="card-body">
            <div class="card-title">
                <h5>Minhas atividades em andamento - <a href="{{ route('tasks.create') }}" class="btn btn-success end-content">Nova Tarefa</a></h5>
            </div>


            <div class="table-responsive">
                <table class="table table-bordered table-hover tb" id="tasks_user">
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



