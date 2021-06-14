@extends('layouts.app')

@section('content')

    <h1 class="text-center text-success my-5">-- Modifier le contact --</h1>

    <div class="container my-3">
        <form action="{{ route("contact.update", $contact->id) }}" method="post">
            {{-- on va créer une page 'update' dynamique pour l'id voulu --}}
            @csrf
            @method('put')
                {{-- Laravel dispose de méthodes personnalisées. Ici, on utilisera 'put' --}}
                {{-- (ça ne remplace pas le POST !) --}}
                {{-- il existe aussi la méthode 'patch' --}}
            <div class="form-group my-3">
                <label for="first_name">Prénom</label>
                <input type="text" id="first_name" name="first_name" class="form-control" value="{{ $contact->first_name }}"/>
                    {{-- avec $contact->first_name, on affiche les données de la BDD --}}
                <div class="text-danger">{{ $errors->first("first_name", ":message") }}</div>
            </div>
            <div class="form-group my-3">
                <label for="last_name">Nom</label>
                <input type="text" id="last_name" name="last_name" class="form-control" value="{{ $contact->last_name }}"/>
                <div class="text-danger">{{ $errors->first("last_name", ":message") }}</div>
            </div>
            <div class="form-group my-3">
                <label for="age">Âge</label>
                <input type="number" id="age" name="age" class="form-control" value="{{ $contact->age }}"/>
                <div class="text-danger">{{ $errors->first("age", ":message") }}</div>
            </div>
            <div class="form-group my-3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $contact->email }}"/>
                <div class="text-danger">{{ $errors->first("email", ":message") }}</div>
            </div>
            <div class="form-group my-3">
                <label for="tel">Tel.</label>
                <input type="tel" name="tel" id="tel" class="form-control" value="{{ $contact->tel }}"/>
                <div class="text-danger">{{ $errors->first("tel", ":message") }}</div>
            </div>
            <div class="forum-group my-3 text-center">
                <input type="submit" class="btn btn-success"/>
            </div>
        </form>
    </div>

@endsection