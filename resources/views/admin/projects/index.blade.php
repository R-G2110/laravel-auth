@extends('layouts.admin')

@section('content')
    <h1>Project Index</h1>
        <!-- Table -->
        <div class="card my-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Progetti</h5>
                <a class="me-4" href="{{ route('adminprojects.create') }}">Aggiungi nuovo progetto</a>
            </div>
            <div class="card-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <td scope="col">Nome</td>
                    <td scope="col">Data di scadenza</td>
                    <td scope="col">Data inizio</td>
                    <td scope="col">Stato</td>
                    <td scope="col">Azioni</td>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $project->name }}</td>
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
                            <td>{{ date_format($delivery_date, 'd/m/Y')}}</td>
                            <td>{{ date_format($start_date, 'd/m/Y')}}</td>
                            <td><span class="badge {{$badge_bg}}">{{ $project->status }}</span></td>
                            <td>
                                <a href="{{ route('adminprojects.show', $project) }}"><button type="button" class="btn btn-success "><i class="fa-regular fa-eye"></i></button></a>
                                <a href="{{ route('adminprojects.edit', $project) }}"><button type="button" class="btn btn-warning "><i class="fa-solid fa-pencil"></i></button></a>
                                <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $projects->links() }}
            </div>
        </div>
        <!-- /Table -->
@endsection
