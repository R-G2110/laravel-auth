@extends('layouts.admin')

@section('content')

    <!-- Delete message -->
    @if (session('deleted'))
        <div class="alert alert-success mt-3 mx-3" style="height: 50px" role="alert">
            <p>{{ session('deleted') }}</p>
        </div>
    @endif
    <!-- /Delete message -->

    <!-- Table -->
    <div class="card card-project mx-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>{{ $project->name }}</h5>
            <div class="action-buttons">
                <a href="{{ route('admin.projects.edit', $project) }}"><button type="button" class="btn btn-warning "><i class="fa-solid fa-pencil"></i></button></a>
                @include('admin.partials.delete_button')
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td style="width: 70%" scope="col">Nome progetto:</td>
                        <td style="width: 30%" scope="col">{{ $project->name }}</td>
                    </tr>
                </thead>
                @php
                    $start_date = date_create($project->start_date);
                    $delivery_date = date_create($project->delivery_date);
                    if ($project->status === 'done')
                        $badge_bg = 'text-bg-success';
                    elseif ($project->status === 'failed')
                        $badge_bg = 'text-bg-danger';
                    else
                        $badge_bg = 'text-bg-warning';
                @endphp
                <tbody>
                    <tr>
                        <td>Data d'inizio:</td>
                        <td>{{ date_format($start_date, 'd/m/Y')}}</td>

                    </tr>
                    <tr>
                        <td>Data di scadenza:</td>
                        <td>{{ date_format($delivery_date, 'd/m/Y')}}</td>
                    </tr>
                    <tr>
                        <td>Stato del progetto:</td>
                        <td><span class="badge {{$badge_bg}}">{{ $project->status }}</span></td>
                    </tr>
                    <tr>
                        <td>Descrizione:</td>
                        <td>{{ $project->description }}</td>
                    </tr>
                    <tr>
                        <td>Passaggi:</td>
                        <td>{{ $project->steps }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
    <!-- /Table -->
    <div class="col-12 ms-3 my-3">
        <a href="{{ route('admin.projects.index') }}">
        <button class="btn btn-secondary">Torna indietro</button></a>
    </div>
@endsection

