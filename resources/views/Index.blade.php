@extends('Plantilla')

@section('Titulo', 'Index')

@section('Estilo')

    <link rel="stylesheet" type="text/css" href="/css/Index.css">

@endsection

@section('Contenido')

<div class="container">
  <button class="category-button" onclick="location.href='Categorias/Computers'">
    <h2>Computers</h2>
  </button>
  <button class="category-button" onclick="location.href='Categorias/Tablets'">
    <h2>Tablets</h2>
  </button>
  <button class="category-button" onclick="location.href='{{route('yubikeys.index')}}'">
    <h2>YubiKeys</h2>
  </button>
  <button class="category-button" onclick="location.href='Categorias/Switches'">
    <h2>Switches</h2>
  </button>
  <button class="category-button" onclick="location.href='Categorias/Printers'">
    <h2>Printers</h2>
  </button>
  <button class="category-button" onclick="location.href='Categorias/Ab&TCA_Active_Users'">
    <h2>Abrhill & TCA Active Users</h2>
  </button>
</div>


@endsection
