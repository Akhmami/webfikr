<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PAS Card</title>
    <link rel="stylesheet" href="{{ asset('css/pas.css') }}">
</head>

<body>
    <div class="max-w-2xl mx-auto py-4">
        {{-- Heading --}}
        <div class="flex items-center justify-between">
            <div>
                <img class="w-20 h-20" src="{{ asset('images/logo.png') }}" alt="Logo NF">
            </div>
            <div class="font-semibold text-lg text-center">
                <p>
                    YAYASAN PESANTREN IBNU SALAM NURUL FIKRI<br>
                    {{ auth()->user()->userDetail->jenjang }} Islam Nurul Fikri Boarding School<br>
                    Tahun Pelajaran 2021/2022
                </p>
            </div>
            <div>
                <img class="w-20 h-20" src="{{ asset('images/logo.png') }}" alt="Logo tutwuri">
            </div>
        </div>
        <hr class="text-lg">
        {{-- User ID --}}
        <div>
            <div>
                <div>kartu</div>
                <div>Detail</div>
            </div>
            <div>Photo</div>
        </div>
    </div>
</body>

</html>
