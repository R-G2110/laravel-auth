@extends('layouts.admin')

@section('content')
    <h1>Project Show</h1>
    <h2>Nome progetto: {{$project->name}}</h2>
    @php
        $start_date = date_create($project->start_date);
        $delivery_date = date_create($project->delivery_date);

    @endphp
    <h2>Data d'inizio: {{ date_format($start_date, 'd/m/Y')}}</h2>
    <h2>Data di scadenza: {{ date_format($delivery_date, 'd/m/Y')}}</h2>
    <h2>Stato: {{$project->status}}</h2>



@endsection
