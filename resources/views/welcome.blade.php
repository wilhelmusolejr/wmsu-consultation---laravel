<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite('resources/css/app.css')

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/6b2bcc8033.js" crossorigin="anonymous"></script>
</head>

<body>
    {{-- banner --}}
    <div class="hidden">
        <div class="">LOGO</div>
        <div class="">
            <p>Western Mindanao State University</p>
            <p>College of Home Economics</p>
            <p>Department of Nutrition and Dietetics</p>
            <p>Online Consultation Clinic</p>
        </div>
        <div class="">LOGO</div>
    </div>

    {{-- header --}}
    <header class="">
        <div class="container flex items-center justify-center min-h-screen p-5 ">
            {{-- navigator --}}
            <div class="fixed top-0 left-0 z-10 flex justify-between w-full px-5 py-10 bg-white shadow-md navigator">
                <div class="">Home</div>
                <div class=""><i class="fa-solid fa-bars"></i></div>
            </div>

            <div class="">
                <h1 class="text-3xl font-bold uppercase ">Reach your instructor from anywhere</h1>
                <p class="pt-5 pb-10 text-slate-700">Get in touch with your instructor anytime, anywhere, for instant
                    guidance and support.</p>
                <p
                    class="px-8 py-4 text-lg font-medium tracking-wider text-white uppercase bg-green-800 border rounded-md w-fit">
                    Book Now</p>
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
    <div class="py-28">
        <div class="container px-5 mx-auto ">
            {{-- header --}}
            <div class="pb-16 text-center ">
                <h2 class="text-2xl font-medium capitalize">Quick solution for scheduling with instructor</h2>
            </div>

            {{--  --}}
            <div class="flex justify-center">
                <div class="grid gap-5 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    <x-steps-box title="Appoint"
                        description="Easily schedule a convenient session with your consultant. Choose a time that works best for you, and get ready to receive personalized advice tailored to your specific needs."
                        emoji="fa-calendar" color="green" />

                    <x-steps-box title="Consult"
                        description="Engage in an in-depth consultation where your consultant will listen, understand, and address your concerns. This dedicated time helps provide solutions and guidance to meet your goals effectively."
                        emoji="fa-comments" color="blue" />

                    <x-steps-box title="Monitor"
                        description="Stay on track by monitoring your progress. Follow up regularly to ensure that your goals are being met and to make adjustments for ongoing improvement and success."
                        emoji="fa-chart-area" color="red" />
                </div>
            </div>
        </div>
    </div>

    {{-- BMI Tool --}}
    <div class="flex items-center justify-center min-h-screen bmi-tool">
        <div class="container flex items-center justify-center px-5 mx-auto">
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
                    {{-- box --}}
                    <x-instructor-card image="{{ asset('images/doctor.png') }}" name="Gregory Yames" />
                    <x-instructor-card image="{{ asset('images/doctor.png') }}" name="Gregory Yames" />
                    <x-instructor-card image="{{ asset('images/doctor.png') }}" name="Gregory Yames" />
                    <x-instructor-card image="{{ asset('images/doctor.png') }}" name="Gregory Yames" />
                    <x-instructor-card image="{{ asset('images/doctor.png') }}" name="Gregory Yames" />
                    <x-instructor-card image="{{ asset('images/doctor.png') }}" name="Gregory Yames" />
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
    <footer class="py-20 text-white border-t-8 border-green-800 bg-green-950">
        <div class="container flex flex-col gap-20 px-5 mx-auto lg:flex-row lg:justify-between">
            {{-- left --}}
            <div class="flex flex-col items-center justify-between lg:items-start">
                <h2 class="mb-10 text-3xl font-semibold tracking-wider uppercase lg:mb-5 ">Stay in touch</h2>
                <div class="flex flex-col gap-5 text-light-white">
                    {{-- item --}}
                    <div class="flex flex-row items-center gap-3">
                        <div class="flex items-center justify-center h-10 bg-white border rounded-md min-w-10">
                            <i class="text-lg text-black fa-solid fa-phone"></i>
                        </div>
                        <p>0997-297-6807</p>
                    </div>
                    {{-- item --}}
                    <div class="flex flex-row items-center gap-3">
                        <div class="flex items-center justify-center h-10 bg-white border rounded-md min-w-10">
                            <i class="text-lg text-black fa-solid fa-envelope"></i>
                        </div>
                        <p>wmsuchedean@gmail.com</p>
                    </div>
                    {{-- item --}}
                    <div class="flex flex-row items-center gap-3">
                        <div class="flex items-center justify-center h-10 bg-white border rounded-md min-w-10">
                            <i class="text-lg text-black fa-brands fa-facebook-f"></i>
                        </div>
                        <p>WMSU - College of Home Economics</p>
                    </div>
                </div>
            </div>

            {{-- right --}}
            <div class="flex flex-col justify-center gap-10 md:flex-row lg:items-start ">
                {{-- item --}}
                <div class="">
                    <h2 class="mb-5 text-3xl font-medium uppercase ">Services</h2>
                    <ul class="flex flex-col gap-5 text-light-white">
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Doctors</a></li>
                        <li><a href="#">Articles</a></li>
                    </ul>
                </div>

                {{-- item --}}
                <div class="">
                    <h2 class="mb-5 text-3xl font-medium uppercase ">About</h2>
                    <ul class="flex flex-col gap-5 text-light-white">
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Doctors</a></li>
                        <li><a href="#">Articles</a></li>
                    </ul>
                </div>

                {{-- item --}}
                <div class="">
                    <h2 class="mb-5 text-3xl font-medium uppercase ">Legal</h2>
                    <ul class="flex flex-col gap-5 text-light-white">
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Doctors</a></li>
                        <li><a href="#">Articles</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
