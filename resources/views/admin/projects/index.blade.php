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
            <h5>Progetti</h5>
            <a class="add-project me-4" href="{{ route('admin.projects.create') }}">Aggiungi nuovo progetto</a>
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
                            <a href="{{ route('admin.projects.show', $project) }}"><button type="button" class="btn btn-success "><i class="fa-regular fa-eye"></i></button></a>
                            <a href="{{ route('admin.projects.edit', $project) }}"><button type="button" class="btn btn-warning "><i class="fa-solid fa-pencil"></i></button></a>
                            @include('admin.partials.delete_button')
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
