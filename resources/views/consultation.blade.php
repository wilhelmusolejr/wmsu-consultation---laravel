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
    <header class="relative flex flex-col min-h-screen home-header">

        {{-- banner --}}
        <x-page-banner />

        {{-- navigator --}}
        <x-navigator />

        {{-- header content --}}
        <div class="container flex items-center flex-1 w-full gap-5 px-5 mx-auto lg:flex-row lg:justify-between">
            {{-- Left --}}
            <div class="flex flex-col items-center self-center justify-center mb-10 text-center">
                <h1 class="text-3xl font-bold uppercase lg:w-9/12 lg:text-6xl">Reach your instructor from anywhere</h1>
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
        </div>

    </header>

    {{-- consultation --}}
    <div class="px-5 py-32 consultation">
        <div class="container p-5 mx-auto bg-white border rounded-md">

            <form action="" id="appointmentForm" class="flex flex-col items-center">
                @csrf <!-- Important for Laravel CSRF protection -->

                <div class="my-10 text-center uppercase">
                    <h2 class="text-4xl font-medium">Set up your appointment</h2>
                </div>

                {{-- appointment for --}}
                <div class="flex flex-wrap items-center gap-5 my-5">
                    <p>Apoint for</p>
                    <div class="flex flex-wrap gap-5">
                        <div class="flex items-center justify-center w-full gap-3 p-5 border rounded-md md:w-40">
                            <input type="radio" id="myself" name="age" value="30" checked>
                            <label for="myself">Myself</label><br>
                        </div>
                        <div class="flex items-center justify-center w-full gap-3 p-5 border rounded-md md:w-40">
                            <input type="radio" id="other" name="age" value="30">
                            <label for="other">Other</label><br>
                        </div>
                    </div>
                </div>

                {{-- stage 1 --}}
                <div class="flex flex-wrap justify-center w-full gap-10 ">
                    {{-- Personal Information --}}
                    <div class="flex flex-wrap items-start justify-center w-full gap-5 mb-10 ">
                        <h3 class="w-full mt-5 mb-2 text-xl font-medium md:w-1/3">Personal Information</h3>
                        <h3 class="hidden w-1/3 md:block"></h3>

                        {{-- firstname --}}
                        <div class="w-full md:w-1/3">
                            <x-input type="text" name="first_name" label="First name" />
                        </div>

                        {{-- lastname --}}
                        <div class="w-full md:w-1/3">
                            <x-input type="text" name="last_name" label="Last name" />
                        </div>

                        {{-- birthdate --}}
                        <div class="w-full md:w-1/3">
                            <x-input type="date" name="birthdate" label="Birthdate" />
                        </div>

                        {{-- gender --}}
                        <div class="flex flex-col w-full gap-1 md:w-1/3">
                            <label for="gender">Gender</label>
                            <select id="gender" class="rounded-md">
                                <option value="male">male</option>
                                <option value="female">female</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- stage 2 --}}
                <div class="flex flex-wrap justify-center w-full gap-10 ">
                    {{-- Personal Information --}}
                    <div class="flex flex-wrap items-start justify-center w-full gap-5 mb-10 ">
                        <h3 class="w-full mt-5 mb-2 text-xl font-medium md:w-1/3">Contact Information</h3>
                        <h3 class="hidden w-1/3 md:block"></h3>

                        {{-- phone number --}}
                        <div class="w-full md:w-1/3">
                            <x-input type="number" name="phone_numer" label="Phone number" />
                        </div>

                        {{-- email --}}
                        <div class="w-full md:w-1/3">
                            <x-input type="email" name="email" label="Email" />
                        </div>
                    </div>
                </div>

                {{-- stage 3 --}}
                <div class="flex flex-wrap justify-center w-full gap-10 ">
                    {{-- Consultation Information --}}
                    <div class="flex flex-wrap items-start justify-center w-full gap-5 mb-10 ">
                        <h3 class="w-full mt-5 mb-2 text-xl font-medium md:w-1/3">Consultation Information</h3>
                        <h3 class="hidden w-1/3 md:block"></h3>

                        {{-- Complain --}}
                        <div class="w-full md:w-1/3">
                            <x-input type="text" name="chief_complain" label="Chief Complaint" />
                        </div>

                        {{-- Referral Form --}}
                        <div class="w-full md:w-1/3">
                            <x-input type="file" name="referral_form" label="Referal Form" />
                        </div>

                        {{-- appointment date --}}
                        <div class="w-full md:w-1/3">
                            <x-input type="date" name="appointment_date" label="Appointment Date" />
                        </div>
                        <h3 class="hidden w-1/3 md:block"></h3>


                    </div>
                </div>

                {{-- stage 4 --}}
                <div class="flex flex-wrap justify-center gap-10 ">
                    {{-- Health Information --}}
                    <div class="flex flex-wrap items-start justify-center gap-5 mb-10 ">
                        <h3 class="w-full mt-5 mb-2 text-xl font-medium md:w-1/3">Health Information</h3>
                        <h3 class="hidden w-1/3 md:block"></h3>

                        {{-- Height --}}
                        <div class="w-full md:w-1/3">
                            <x-input type="text" name="height" label="Height" />
                        </div>

                        {{-- Weight --}}
                        <div class="w-full md:w-1/3">
                            <x-input type="text" name="height" label="Weight" />
                        </div>

                        {{-- Has your weight changed in the past year? --}}
                        <div class="flex flex-col w-full gap-1 md:w-1/3">
                            <label for="gender">Has your weight changed in the past year?</label>
                            <select id="gender" class="rounded-md">
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>

                        {{-- Has your weight changed in the past year? --}}
                        <div class="flex flex-col w-full gap-1 md:w-1/3 ">
                            <label for="exercise">Do you exercise?</label>
                            <select id="exercise" class="rounded-md">
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>

                        {{-- Are there any medical reasons why you cannot exercise? --}}
                        <div class="flex flex-col w-full gap-1 md:w-1/3 ">
                            <label for="medical_reason">Are there any medical reasons why you cannot exercise?</label>
                            <select id="medical_reason" class="rounded-md">
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>

                        {{-- Stress level --}}
                        <div class="flex flex-col w-full gap-1 md:w-1/3 ">
                            <label for="stress_level">Stress Level</label>
                            <select id="stress_level" class="rounded-md">
                                <option value="low">low</option>
                                <option value="balanced">balanced</option>
                                <option value="high">high</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- stage 5     --}}
                <div class="flex flex-wrap justify-center gap-10 ">
                    {{-- Health Information --}}
                    <div class="flex flex-wrap items-start justify-center gap-5 mb-10 ">
                        <h3 class="w-full mt-5 mb-2 text-xl font-medium md:w-1/3">Nutrional Information</h3>
                        <h3 class="hidden w-1/3 md:block"></h3>

                        {{-- Have you met with a registered dietetican in the past? --}}
                        <div class="flex flex-col w-full gap-1 md:w-1/3">
                            <label for="meet_past_dietecial">Has your weight changed in the past year?</label>
                            <select id="meet_past_dietecial" class="rounded-md">
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>

                        {{-- Do you follow a special diet or eating style --}}
                        <div class="flex flex-col w-full gap-1 md:w-1/3">
                            <label for="meet_past_dietecial">Do you follow a special diet or eating style?</label>
                            <select id="meet_past_dietecial" class="rounded-md">
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>

                        {{-- Food preferences --}}
                        <div class="w-full md:w-1/3">
                            <x-input type="text" name="food_preference" label="Any food preferences" />
                        </div>

                        {{-- Who does your grocery shopping? --}}
                        <div class="flex flex-col w-full gap-1 md:w-1/3">
                            <label for="who_grocery">Who does your grocery shopping?</label>
                            <select id="who_grocery" class="rounded-md">
                                <option value="Myself">Myself</option>
                                <option value="others">others</option>
                            </select>
                        </div>

                        {{-- Who prepares your meals? --}}
                        <div class="flex flex-col w-full gap-1 md:w-1/3">
                            <label for="who_prepare_meal">Who prepares your meals?</label>
                            <select id="who_prepare_meal" class="rounded-md">
                                <option value="Myself">Myself</option>
                                <option value="others">others</option>
                            </select>
                        </div>

                        {{-- Who prepares your meals? --}}
                        <div class="flex flex-col w-full gap-1 md:w-1/3">
                            <label for="who_prepare_meal">Do you ever skip meals?</label>
                            <select id="who_prepare_meal" class="rounded-md">
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>

                        {{-- Has your weight changed in the past year? --}}
                        <div class="flex flex-col w-full gap-1 md:w-1/3">
                            <label for="gender">Has your weight changed in the past year?</label>
                            <select id="gender" class="rounded-md">
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>

                        {{-- Has your weight changed in the past year? --}}
                        <div class="flex flex-col w-full gap-1 md:w-1/3">
                            <label for="exercise">Do you exercise?</label>
                            <select id="exercise" class="rounded-md">
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>

                        {{-- Are there any medical reasons why you cannot exercise? --}}
                        <div class="flex flex-col w-full gap-1 md:w-1/3">
                            <label for="medical_reason">Are there any medical reasons why you cannot exercise?</label>
                            <select id="medical_reason" class="rounded-md">
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>

                        {{-- Stress level --}}
                        <div class="flex flex-col w-full gap-1 md:w-1/3">
                            <label for="stress_level">Stress Level</label>
                            <select id="stress_level" class="rounded-md">
                                <option value="low">low</option>
                                <option value="balanced">balanced</option>
                                <option value="high">high</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>

            <div class="flex items-end justify-end mt-10">
                <x-button class="appointment-btn">Submit</x-button>
            </div>

        </div>
    </div>

    {{-- modal --}}
    <x-modal class="modal-submit-consultation">
        {{-- header --}}
        <x-modal-header>Confirm Appointment Submission
        </x-modal-header>

        {{-- body --}}
        <x-modal-body>
            <p class="modal-info">Are you ready to submit your appointment request? Once confirmed, our team will review and get back
                to you with further details.</p>
        </x-modal-body>

        {{-- footer --}}
        <x-modal-footer>
            <div class="flex items-center justify-center gap-5">
                <p class="modal-close ">Cancel</p>
                <x-button id="submitButton" type="submit">Submit</x-button>
            </div>
        </x-modal-footer>
    </x-modal>

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
