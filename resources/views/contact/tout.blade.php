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
{{--    {{$editContactId}}--}}

    @foreach ($contacts as $contact)
        <div class="card">
            <div class="card-body d-flex flex-row nowrap justify-content-between">
                <div class="d-flex flex-row nowrap">
                    <a href="" class="card-link">edit</a>
                    <a href="contact/{{$contact->ctc_id}}/delete" class="card-link">delete</a>
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