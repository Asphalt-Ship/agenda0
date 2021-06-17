@extends('layouts.app')
    {{-- on spécifie que ce fichier hérite de layouts/app.blade.php --}}


    {{-- le contenu de ce fichier est en fait le body du template app --}}
@section('content')

    <h1 class="text-center text-success my-5">-- Index --</h1>

    {{-- message en cas de succès de l'ajout de contact --}}
    @if (session("success"))
        <div class="container alert alert-success" role="alert">
            {{ session("success") }}
        </div>
    @endif

    <div class="d-flex justify-content-center">
        <a href="{{ route("contact.create") }}" class="btn btn-primary my-3">Ajouter contact</a>
        {{-- autre méthode : {{ url("contacts/create") }} 
            mais ça écrit 'en dur' et est donc chiant dans un gros projet --}} 
    </div>

    <div class="container table-responsive">
        <table class="table table-striped table-hover text-center my-3">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Âge</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Date de création</th>
                    <th>Date de modification</th>
                    <th>Paramètres</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td> {{ $contact->id }} </td>
                        <td> {{ $contact->first_name }} </td>
                        <td> {{ $contact->last_name }} </td>
                        <td> {{ $contact->age }} </td>
                        <td> {{ $contact->email }} </td>
                        <td> {{ $contact->tel }} </td>
                        <td> {{ $contact->created_at }} </td>
                        <td> {{ $contact->updated_at }} </td>
                        <td>
                            <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-info">Modifier</a>
                            <form action="{{ route('contact.delete', $contact->id) }}" method="POST" class="ms-2 d-inline" onclick="return confirm('Confirmer la suppression ?')"">
                                {{-- pour supprimer, Laravel nous fait passer par un form --}}
                                {{-- ça permet de sécuriser le processus avec @csrf --}}
                                @csrf
                                @method('delete')
                                    {{-- comme pour 'put', 'delete' écrase la méthode post, afin de supprimer cette fois-ci --}}
                                <input type="submit" class="btn btn-danger" value="Supprimer">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
    {{-- cette partie sera déversée dans le @yield('content') de app --}}