<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Repositorios</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-200">
    <ul class="max-w-lg bg-white border-r border-gray-300 shadow-xl">
        @foreach ($repositories as $repository)
            <li class="flex items-center text-black p-2 hover:bg-gray-300">
                <img src="{{ $repository->user->profile_photo_url }}" alt="Foto de usuario" class="w-12 h-12 rounded-full mr-2">
                <div class="flex justify-between w-full">
                    <div class="flex-1">
                        <h2 class="text-sm font-semibold text-black">{{ $repository->url }}</h2>
                        <p>{{ $repository->description }}</p>
                    </div>
                    <span class="text-xs font-medium text-gray-600">{{ $repository->created_at->diffForHumans() }}</span>
                </div>
            </li>
        @endforeach
    </ul>
</body>

</html>
