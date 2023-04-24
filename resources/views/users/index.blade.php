@extends('layouts.blue_layout')

@section('title', 'Usuários')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('Home') }}"> Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Usuários</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header">
        <h6 class="card-title">Usuários</h6>
    </div>
    <div class="card-body">
        <div class="card-title">
            <h5>Usuários cadastrados - <a href="{{ route('users.create') }}" class="btn btn-success end-content">Novo Usuário</a></h5>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover tb" id="users_main">
                <thead>
                    <th>Ação</th>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
