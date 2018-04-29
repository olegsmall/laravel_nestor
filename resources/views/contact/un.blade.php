<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contacts : liste des contacts</title>

</head>
<body>
<div class="content">
    {{--Allo {{$taches}}--}}
    <ul>
        {{--@foreach ($contacts as $contact)--}}

            <li><strong>id {{$contact->ctc_id}} : </strong> {{$contact->ctc_prenom}}</li>
        {{--@endforeach--}}
    </ul>
</div>
</body>
</html>