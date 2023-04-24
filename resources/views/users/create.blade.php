@extends('layouts.blue_layout')

@section('title', 'Usuários')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('Home') }}"> Home</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('users.index') }}"> Usuários</a></li>
        <li class="breadcrumb-item active" aria-current="page">Novo Usuário</li>
    </ol>
</nav>
<div class="card">

    <div class="card-header">
        <h6 class="card-title">Usuários</h6>
    </div>
    @component('users._components.user_form')
    @endcomponent
</div>


@endsection
