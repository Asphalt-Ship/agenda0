@extends('layouts.app')

@section('content')

    <h1 class="text-center text-success my-5">-- Ajouter un nouveau contact --</h1>

    <div class="container my-3">
        <form action="{{ route("contact.store") }}" method="post">
            {{-- l'action va repasser vers le router, pour chercher 'contact.store' --}}
            @csrf {{-- par défaut, on avait une erreur 419 à cause d'une brèche possible de type csrf --}}
                {{-- @csrf s'assure de colmater cette brèche --}}
            <div class="form-group my-3">
                <label for="first_name">Prénom</label>
                <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name') }}"/>
                    {{-- avec la fonction old(), on restaure les données de la précédente session --}}
                <div class="text-danger">{{ $errors->first("first_name", ":message") }}</div>
                    {{-- cette div affiche toute erreur qui concerne "first_name" et renvoie le message correspondant --}}
            </div>
            <div class="form-group my-3">
                <label for="last_name">Nom</label>
                <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name') }}"/>
                <div class="text-danger">{{ $errors->first("last_name", ":message") }}</div>
            </div>
            <div class="form-group my-3">
                <label for="age">Âge</label>
                <input type="number" id="age" name="age" class="form-control" value="{{ old('age') }}"/>
                <div class="text-danger">{{ $errors->first("age", ":message") }}</div>
            </div>
            <div class="form-group my-3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"/>
                <div class="text-danger">{{ $errors->first("email", ":message") }}</div>
            </div>
            <div class="form-group my-3">
                <label for="tel">Tel.</label>
                <input type="tel" name="tel" id="tel" class="form-control" value="{{ old('tel') }}"/>
                <div class="text-danger">{{ $errors->first("tel", ":message") }}</div>
            </div>
            <div class="forum-group my-3 text-center">
                <input type="submit" class="btn btn-success"/>
            </div>
        </form>
    </div>

@endsection