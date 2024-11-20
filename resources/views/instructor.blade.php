<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- stylesheet --}}
    @vite('resources/css/app.css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- font awesome --}}
    <script src="https://kit.fontawesome.com/6b2bcc8033.js" crossorigin="anonymous"></script>

    {{-- script --}}
    @vite(['resources/js/app.js'])
</head>

<body>
    {{-- header --}}
    <header class="relative flex flex-col min-h-screen home-header halfscreen">

        {{-- banner --}}
        <x-page-banner />

        {{-- navigator --}}
        <x-navigator />

    </header>

    {{-- Instructors --}}
    <div class="py-28 list-instructors">
        <div class="container px-5 mx-auto ">

            {{-- header --}}
            <x-section-header heading="Meet our instructors" />

            <div class="flex justify-center">
                <div class="grid gap-5 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    {{-- box --}}
                    <x-instructor-card image="{{ asset('images/doctor.png') }}" name="Gregory Yames" patients="10" />
                    <x-instructor-card image="{{ asset('images/doctor.png') }}" name="Gregory Yames" patients="6" />
                    <x-instructor-card image="{{ asset('images/doctor.png') }}" name="Gregory Yames" patients="2" />
                    <x-instructor-card image="{{ asset('images/doctor.png') }}" name="Gregory Yames" patients="8" />
                    <x-instructor-card image="{{ asset('images/doctor.png') }}" name="Gregory Yames" patients="21" />
                    <x-instructor-card image="{{ asset('images/doctor.png') }}" name="Gregory Yames" patients="2" />
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    {{-- Footer --}}
    <x-footer />
</body>

</html>
