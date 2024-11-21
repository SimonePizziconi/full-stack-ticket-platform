@extends('layouts.app')

@section('content')
    <h1>Titolo: {{ $ticket->title }}</h1>
    <p>Descrizione: {{ $ticket->description }}</p>
    <h6>Stato: {{ $ticket->status }}</h6>
    <h6>Operatore: {{ $ticket->operator->name }}</h6>
    <h6>Categoria: {{ $ticket->category->name }}</h6>
    <h6>Data: {{ $ticket->created_at }}</h6>
@endsection
