@extends('layouts.admin')

@section('content')
    {{-- @if ($errors->any())
    <div class="alert alert-danger my-1" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}
    <div class="card my-3">
        <h5 class="card-header">Inserimento Nuovo Progetto</h5>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger my-1" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="row g-3" action="{{ route('adminprojects.store') }}" method="POST">
                @csrf
                <div class="col-12 ">
                    <label for="name" class="form-label">Nome Progetto *</label>
                    <input type="text" class="form-control" id="name" placeholder="Nome Progetto" name="name" value="{{ old('name') }}" is-invalid >
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="start_date" class="form-label">Data d'inizio *</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
                    @error('start_date')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="delivery_date" class="form-label">Data di scadenza *</label>
                    <input type="date" class="form-control" id="delivery_date" name="delivery_date">
                    @error('delivery_date')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Aggiungi</button>
                </div>

            </form>
        </div>
    </div>

@endsection
