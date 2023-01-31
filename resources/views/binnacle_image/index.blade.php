<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Imágenes de bitácora</title>
</head>
<body>
    {{--  {{dd($images)}}  --}}
    <div class="container p-3">
        <div class="row">
            @foreach($images as $image)
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{ $image['url'] }}" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">{{ $image['description'] }}</h5>
                      <p class="card-text">{{ $image['date'] }}</p>
                      <a href="{{ $image['url'] }}" target="_blank" class="btn btn-primary" style="width:100%;">Abrir</a>
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>
