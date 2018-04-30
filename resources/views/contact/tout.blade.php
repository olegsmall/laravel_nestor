<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ URL(mix('/js/app.js')) }}"></script>
    <link rel="stylesheet" href="{{URL(mix('css/app.css') )}}">
    <title>Contacts : liste des contacts</title>

</head>
<body>
<div class="container">
{{--Allo {{$taches}}--}}


<div>
    <form class="card mb-3 mt-3" method="post" action="/contact/add">
        {{ csrf_field() }}
        <h3 class="card-body">Ajout d'un contact</h3>
        <div class="form-group d-flex flex-row nowrap justify-content-between">
            <label class="col-4">Prenom
                <input class="form-control" type="text" name="prenom" placeholder="Prenom" value="Test">
            </label>
            <label class="col-4">Nom
                <input class="form-control" type="text" name="nom" placeholder="Nom" value="test">
            </label>
            <label class="col-4">Contact categorie:
                <select class="form-control"  name="contact-category">
                    @foreach($contactCategories as $categorie)
                        <option value="{{$categorie}}">{{$categorie}}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div class="form-group d-flex flex-row nowrap justify-content-between">
            <label class="col-6">Numero de téléphone:
                <input class="form-control" type="text" name="tel[]" placeholder="Numero de téléphone" value="111111">
            </label>
            <label class="col-3">Numero de post:
                <input class="form-control" type="text" name="post[]" placeholder="Numero de post" value="123">
            </label>
            <label class="col-3">Telephone categorie:
                <select class="form-control"  name="telephone-category[]">
                    @foreach($contactCategories as $categorie)
                        <option value="{{$categorie}}">{{$categorie}}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div class="form-group d-flex flex-row nowrap justify-content-between">
            <label class="col-6">Numero de téléphone:
                <input class="form-control" type="text" name="tel[]" placeholder="Numero de téléphone" value="2222">
            </label>
            <label class="col-3">Numero de post:
                <input class="form-control" type="text" name="post[]" placeholder="Numero de post" value="">
            </label>
            <label class="col-3">Telephone categorie:
                <select class="form-control"  name="telephone-category[]">
                    @foreach($contactCategories as $categorie)
                        <option value="{{$categorie}}">{{$categorie}}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div class="container text-right mb-4">
            <button type="submit" class="btn col-2">Soumettre
                {{--<i class="fa fa-check" aria-hidden="true"></i>--}}
            </button>
        </div>
    </form>
{{--    {{$editContactId}}--}}

    @foreach ($contacts as $contact)
        <div class="card">
            <div class="card-body d-flex flex-row nowrap justify-content-between">
                <div class="d-flex flex-row nowrap">
                    <a href="" class="card-link">edit</a>
                    <a href="contact/delete/{{$contact->ctc_id}}" class="card-link">delete</a>
                    <div class="ml-4">{{$contact->ctc_prenom}} {{$contact->ctc_nom}}</div>
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

</body>
</html>
