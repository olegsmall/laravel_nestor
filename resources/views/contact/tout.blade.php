@extends('layouts.app')

@section('contacts')
    <div class="container">
        <div>
            <form class="card mb-3 mt-3" method="post" action="{{$actionR}}">
                {{ csrf_field() }}

                <h3 class="card-body">{{($actionR === '/contact/add') ? "Ajoute d'un contact" : "Modifier d'un contact"}}</h3>
                <div class="form-group d-flex flex-row nowrap justify-content-between">
                    <label class="col-4">Prenom
                        <input class="form-control" type="text" name="prenom" placeholder="Prenom"
                               value="{{$updateContact->ctc_prenom}}" required  pattern="[A-z]+">
                    </label>
                    <label class="col-4">Nom
                        <input class="form-control" type="text" name="nom" placeholder="Nom"
                               value="{{$updateContact->ctc_nom}}" required pattern="[A-z]+">
                    </label>
                    <label class="col-4">Contact categorie:
                        <select class="form-control" name="contact_category">
                            @foreach($contactCategories as $categorie)
                                <option
                                        value="{{$categorie}}"
                                        {{($updateContact->ctc_categorie === $categorie) ? 'selected' : '' }}
                                >{{$categorie}}</option>
                            @endforeach
                        </select>
                    </label>
                    <input type="hidden" name="contact-id">
                </div>

                @forelse($updateContact->telephones as $telephone)
                    <div class="form-group d-flex flex-row nowrap justify-content-between">
                        <label class="col-6">Numero de téléphone:
                            <input class="form-control" type="text" name="tel[]" placeholder="Numero de téléphone"
                                   value="{{$telephone->tel_numero}}" required pattern="[0-9]+">
                        </label>
                        <label class="col-3">Numero de post:
                            <input class="form-control" type="text" name="post[]" placeholder="Numero de post"
                                   value="{{$telephone->tel_poste}}"  pattern="[0-9]+">
                        </label>
                        <label class="col-3">Telephone categorie:
                            <select class="form-control" name="telephone-category[]">
                                @foreach($telephoneCategories as $categorie)
                                    <option
                                            value="{{$categorie}}"
                                            {{($telephone->tel_type === $categorie) ? 'selected' : ''}}
                                    >{{$categorie}}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                @empty
                    <div class="form-group d-flex flex-row nowrap justify-content-between">
                        <label class="col-6">Numero de téléphone:
                            <input class="form-control" type="text" name="tel[]" placeholder="Numero de téléphone"
                                   value="" required   pattern="[0-9]+">
                        </label>
                        <label class="col-3">Numero de post:
                            <input class="form-control" type="text" name="post[]" placeholder="Numero de post" value="" pattern="[0-9]+">
                        </label>
                        <label class="col-3">Telephone categorie:
                            <select class="form-control" name="telephone-category[]">
                                @foreach($telephoneCategories as $categorie)
                                    <option value="{{$categorie}}">{{$categorie}}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                @endforelse

                <div>
                    <span id="ajouter-champ" class="btn btn-link text-left">Ajouter un autre numéro</span>
                </div>

                <div class="container text-right mb-4">
                    <button type="submit" class="btn col-2">Soumettre</button>
                </div>
            </form>

            @foreach ($contacts as $contact)
                <div class="card">
                    <div class="card-body d-flex flex-row nowrap justify-content-between">
                        <div class="d-flex flex-row nowrap">
                            <a href="/contact/edit/{{$contact->ctc_id}}" class="card-link">Modifier</a>
                            <a href="/contact/delete/{{$contact->ctc_id}}" class="card-link">Supprimer</a>
                            <div class="ml-4">{{$contact->ctc_prenom}} {{$contact->ctc_nom}} <span
                                        class="small font-weight-bold ml-4">({{$contact->ctc_categorie}})</span></div>
                        </div>
                        <div>
                            @foreach($contact->telephones as $telephone)
                                <div class="d-flex flex-row flex-nowrap align-items-center">
                                    <span class="mx-2 my-0 small">{{$telephone->tel_type}}</span>
                                    <span class="mx-2">{{$telephone->tel_numero}}</span>
                                    <span class="mx-2">{{$telephone->tel_poste}}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        /**
         * Ajout d'un champ d'ajout d'un numero de telephone additionnel
        */
        'use strict';
        window.addEventListener('load', () => {
            document.getElementById('ajouter-champ').addEventListener('click', addPhoneField, true);
            function addPhoneField() {
                let div = document.createElement('div');
                div.classList = 'form-group d-flex flex-row nowrap justify-content-between';
                div.innerHTML = '<label class="col-6">Numero de téléphone:\n' +
                    '                <input class="form-control" type="text" name="tel[]" placeholder="Numero de téléphone" pattern="[0-9]+">\n' +
                    '            </label>\n' +
                    '            <label class="col-3">Numero de post:\n' +
                    '                <input class="form-control" type="text" name="post[]" placeholder="Numero de post"  pattern="[0-9]+">\n' +
                    '            </label>\n' +
                    '            <label class="col-3">Telephone categorie:\n' +
                    '                <select class="form-control"  name="telephone-category[]">\n' +
                    '                    @foreach($telephoneCategories as $categorie)\n' +
                    '                        <option value="{{$categorie}}">{{$categorie}}</option>\n' +
                    '                    @endforeach\n' +
                    '                </select>\n' +
                    '            </label>';
                document.getElementById('ajouter-champ').parentElement.before(div);
            }
        });
    </script>

@endsection

