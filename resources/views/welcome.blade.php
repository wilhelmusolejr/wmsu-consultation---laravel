<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home | Online Consultation Clinic</title>

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
    <header class="relative flex flex-col min-h-screen home-header">

        {{-- banner --}}
        <x-page-banner />

        {{-- navigator --}}
        <x-navigator />

        {{-- header content --}}
        <div
            class="container flex flex-col-reverse items-center flex-1 w-full gap-5 px-5 mx-auto lg:flex-row lg:justify-between">
            {{-- Left --}}
            <div class="self-center mb-10">
                <h1 class="text-3xl font-bold uppercase lg:text-6xl">Reach your instructor from anywhere</h1>
                <p class="pt-5 pb-10 lg:w-8/12 text-slate-700">
                    Get in touch with your instructor anytime, anywhere, to receive prompt guidance and support tailored
                    to your needs. Whether you have questions, need clarification, or want advice on your progress, your
                    instructor is available to help you.
                </p>

                <p
                    class="px-8 py-4 text-lg font-medium tracking-wider text-white uppercase bg-green-800 border rounded-md w-fit">
                    Book Now
                </p>
            </div>

            {{-- Right --}}
            <div class="relative flex justify-end w-5/5 lg:w-4/5 lg:items-end lg:self-end image-container">
                <img src="{{ asset('images/doctor.png') }}" class="w-full " alt="Doctor">
                <div class="absolute px-5 py-2 bg-white shadow-md floating-info rounded-3xl ">
                    <div class="flex items-center gap-2">
                        <i class="text-red-500 fa-solid fa-heart"></i>
                        <p class="text-slate-700">{{ '5' }} patients assisted.</p>
                    </div>
                </div>
            </div>
        </div>

    </header>

    {{-- Statistics --}}
    <div class="border-t-8 border-b-8 border-green-800 bg-green-950">
        <div class="flex flex-wrap items-center justify-center gap-5 py-20">
            <x-statistics-box number="18" label="Instructors" />
            <x-statistics-box number="57" label="Patient" />
            <x-statistics-box number="12" label="Activities" />
            <x-statistics-box number="72" label="Consultations" />
        </div>
    </div>

    {{-- Steps --}}
    <div class="py-28 lg:py-40">
        <div class="container px-5 mx-auto ">
            {{-- header --}}
            <x-section-header heading="Quick solution for scheduling with instructor" />

            {{--  --}}
            <div class="flex justify-center">
                <div class="grid gap-5 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    <x-steps-box title="Appoint"
                        description="Easily schedule a convenient session with your consultant. Choose a time that works best for you, and get ready to receive personalized advice tailored to your specific needs."
                        emoji="fa-calendar" color="green" />

                    <x-steps-box title="Consult"
                        description="Engage in an in-depth consultation where your consultant will listen, understand, and address your concerns. This dedicated time helps provide solutions and guidance to meet your goals effectively."
                        emoji="fa-comments" color="green" />

                    <x-steps-box title="Monitor"
                        description="Stay on track by monitoring your progress. Follow up regularly to ensure that your goals are being met and to make adjustments for ongoing improvement and success."
                        emoji="fa-chart-area" color="green" />
                </div>
            </div>
        </div>
    </div>

    {{-- BMI Tool --}}
    <div class="flex items-center justify-center min-h-screen bmi-tool">
        <div class="container flex items-center justify-center px-5 py-20 mx-auto">
            {{-- form --}}
            <form action="" class="w-full px-5 py-10 text-center bg-white border rounded-md max-w-96">
                <h2 class="mt-5 mb-10 text-2xl font-medium uppercase">Body mass index</h2>

                {{-- height --}}
                <div class="flex flex-col gap-1 mb-5 text-start">
                    <label for="">Your height (cm)</label>
                    <input type="number" class="w-full rounded-md">
                </div>

                {{-- weight --}}
                <div class="flex flex-col gap-1 mb-5 text-start">
                    <label for="">Your weight (lbs)</label>
                    <input type="number" class="w-full rounded-md">
                </div>

                <p
                    class="w-full px-8 py-4 mt-10 mb-5 text-lg font-medium tracking-wider text-white uppercase bg-green-800 border rounded-md">
                    Compute BMI</p>
            </form>
        </div>
    </div>

    {{-- Instructors --}}
    <div class="py-28 list-instructors">
        <div class="container px-5 mx-auto ">

            {{-- header --}}
            <x-section-header heading="Meet our instructors" />

            <div class="flex justify-center">
                <div class="grid gap-5 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($diatians as $dietian)
                    <x-instructor-card
                        image="{{ asset('images/' . $dietian['profile']) }}"
                        name="{{ $dietian['first_name'] . ' ' . $dietian['last_name'] }}"
                        patients="{{ rand(10,50) }}"
                    />
                    @endforeach
                </div>
            </div>


            <div class="text-center mt-28">
                <x-button >
                    <a href="{{ route('instructors') }}">see more</a>
                </x-button>
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
