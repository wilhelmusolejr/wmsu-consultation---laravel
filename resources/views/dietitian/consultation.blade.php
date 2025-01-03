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
    @vite(['resources/js/dietitian/consultation.js'])
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
                <p class="pt-5 pb-10 lg:w-6/12 text-slate-700">
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


    <div class="px-5 py-32 consultation ">

        <div class="container hidden p-5 mx-auto bg-white border rounded-md" data-step="1"></div>
        <div class="container hidden p-5 mx-auto bg-white border rounded-md" data-step="2"></div>

        {{-- consultation --}}
        <div class="container hidden p-5 mx-auto bg-white border rounded-md" data-step="3">

            <div class="my-10 text-center uppercase">
                <h2 class="text-4xl font-medium">Consultation</h2>
            </div>

            <div class="flex flex-col items-center justify-center gap-5 lg:flex-row lg:items-start">
                {{-- grid 1 --}}
                <div class="w-full p-5 border rounded-md md:w-1/2 lg:w-1/4 ">
                    <div class="mb-5"><x-input type="text" name="appointment_number" label="Appointment number"
                            value="#123" disabled />
                    </div>

                    <div class="relative border border-black rounded-md bg-gray-50 min-h-60 ">
                        <h2 class="p-5 font-medium tracking-wider text-center text-white uppercase bg-green-800 ">
                            upcoming schedule</h2>
                        <div class="overflow-auto schedule-container">
                            {{-- item --}}
                            <div class="flex-wrap items-center justify-around hidden py-5 bg-green-100 ">
                                <p>11/11/24</p>
                                <p>04:30pm</p>
                            </div>
                        </div>

                        <div class="absolute transform -translate-x-1/2 bottom-2 left-1/2">
                            <div class="flex items-center justify-center w-10 h-10 text-white bg-black border rounded-md cursor-pointer add-schedule-btn">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- grid 2 --}}
                <div class="flex-1 w-full p-2 border rounded-md md:p-5 ">
                    <div class="mb-5">
                        <x-input type="text" name="chief_complain" label="Chief Complaint" value="tite" disabled />
                    </div>

                    {{-- chat --}}
                    <div class="flex flex-col justify-between gap-5 p-5 bg-green-100 border rounded-md ">
                        {{-- chatbox --}}
                        <div class="flex flex-col gap-5 overflow-auto max-h-96 min-h-80 chat-box">
                            <div class="flex items-center justify-center flex-1 h-full p-5 bg-blue-300 rounded-md">
                                <p>
                                    LOADING
                                </p>
                            </div>
                        </div>

                        <div class="">
                            <form class="flex flex-col gap-2 lg:flex-row" id="chatForm">
                                @csrf
                                <input type="text" class="flex-1 rounded-md" name="message_content">
                                <x-button id="send_message" class="w-full lg:w-fit">Send</x-button>
                                <x-button class="w-full bg-gray-500 sms-disable-btn lg:w-fit">Send</x-button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- grid 3 --}}
                <div class="w-full lg:w-1/4 md:w-1/2 ">
                    <div class="p-5 bg-white border rounded-md shadow-md lg:p-7 max-w-80 md:max-w-none">
                        <div class="relative flex items-center justify-center p-5 pb-0 bg-blue-200 border rounded-md">
                            <img src="{{ asset('images/blank_profile.png') }}" alt="Doctor" class="">
                        </div>
                        <div class="pb-2 text-center pt-7">
                            <h3 class="font-medium lg:text-xl name">Rnd. Gregory Yames</h3>
                        </div>
                    </div>


                </div>
            </div>

            <x-consultation.button-parent class="flex items-end justify-between mt-10">
                <x-button class="bg-purple-800 client-information-btn">Client Information</x-button>
                <x-button class="end-monitoring-btn">End monitoring</x-button>
                <x-button class="hidden next-btn">next</x-button>
            </x-consultation.button-parent>
        </div>

        {{-- consultation upload  --}}
        <div class="container hidden p-5 mx-auto bg-white border rounded-md" data-step="4">

            <div class="my-10 text-center uppercase">
                <h2 class="text-4xl font-medium">Upload consultation result</h2>
            </div>

            <div class="flex flex-col items-center justify-center gap-5 lg:flex-row lg:items-start">
                {{-- grid 1 --}}
                <di v class="flex flex-col w-full gap-5 md:w-1/2 lg:w-1/4 ">
                    <div class="">
                        <x-input type="file" name="consultation_result" label="Consultation Result" />
                    </div>
                </di>
            </div>

            <x-consultation.button-parent class="justify-between ">
                <x-button class="previous-btn">Previous</x-button>
                <x-button class="hidden next-btn">Next</x-button>
                <x-button class="upload-consultation-btn">Upload</x-button>
            </x-consultation.button-parent>

        </div>

        {{-- consultation final result --}}
        <div class="container hidden p-5 mx-auto bg-white border rounded-md "data-step="5">

            <div class="my-20 text-center uppercase">
                <h2 class="text-4xl font-medium">Consultation result</h2>
            </div>

            <div class="flex flex-col items-center justify-center gap-5 lg:flex-row lg:items-start">
                {{-- grid 1 --}}
                <di v class="flex flex-col w-full gap-5 md:w-1/2 lg:w-1/4 ">
                    <div class="">
                        <x-input disabled type="file" name="consultation_result" label="Consultation Result" />
                    </div>
                </di>
            </div>

            <x-consultation.button-parent class="justify-between">
                <x-button class="previous-btn">Previous</x-button>
                <x-button><a href="/">Home</a></x-button>
            </x-consultation.button-parent>
        </div>
    </div>

    {{-- Modal for Confirming End of Consultation --}}
    <x-modal class="modal-end-consultation">
        {{-- Header --}}
        <x-modal-header>End Consultation</x-modal-header>

        {{-- Body --}}
        <x-modal-body>
            <p class="modal-info">Are you sure you want to end this consultation?</p>
        </x-modal-body>

        {{-- Footer --}}
        <x-modal-footer>
            <div class="flex items-center justify-center gap-5">
                {{-- Close the modal on click --}}
                <p class="cursor-pointer modal-close">Cancel</p>

                {{-- Confirm action --}}
                <x-button id="finalEndConsultation" type="button">Confirm</x-button>
            </div>
        </x-modal-footer>
    </x-modal>

    {{-- Modal for Confirming Upload of Consultation Result --}}
    <x-modal class="modal-upload-consultation-result">
        {{-- Header --}}
        <x-modal-header>Upload Consultation Result</x-modal-header>

        {{-- Body --}}
        <x-modal-body>
            <p class="modal-info">Are you sure you want to upload this consultation result?</p>
        </x-modal-body>

        {{-- Footer --}}
        <x-modal-footer>
            <div class="flex items-center justify-center gap-5">
                {{-- Close the modal on click --}}
                <p class="cursor-pointer modal-close">Cancel</p>

                {{-- Confirm action --}}
                <x-button id="finalUploadConsultationResult" type="button">Confirm</x-button>
            </div>
        </x-modal-footer>
    </x-modal>

    {{-- Modal for adding new schedule --}}
    <x-modal class="modal-add-schedule">
        {{-- Header --}}
        <x-modal-header>Add schedule</x-modal-header>

        {{-- Body --}}
        <x-modal-body>
            <form>
                @csrf
                <div class="flex flex-col gap-5">
                    <x-input type="date" name="schedule_date" label="Date" required />
                    <x-input type="time" name="schedule_time" label="time" required />
                </div>
            </form>
        </x-modal-body>

        {{-- Footer --}}
        <x-modal-footer>
            <div class="flex items-center justify-center gap-5">
                {{-- Close the modal on click --}}
                <p class="cursor-pointer modal-close">Cancel</p>

                {{-- Confirm action --}}
                <x-button id="addScheduleFinalBtn" type="button">add</x-button>
            </div>
        </x-modal-footer>
    </x-modal>

    {{-- modal --}}
    <div class="flex items-center justify-center hidden modal-1 background-modal modal-client-information">
        <div class="p-5 bg-white border rounded-md modal-container">

            <x-modal-header>Client information</x-modal-header>


            {{-- Personal Information --}}
            <div class="flex flex-wrap justify-center w-full gap-10 ">
                {{-- Personal Information --}}
                <div class="flex flex-wrap items-start justify-center w-full gap-5 mb-10 ">
                    <h3 class="w-full mt-5 mb-2 text-xl font-medium md:w-1/3">Personal Information</h3>
                    <h3 class="hidden w-1/3 md:block"></h3>

                    {{-- firstname --}}
                    <div class="w-full md:w-1/3">
                        <x-input type="text" name="first_name" label="First name" required />
                    </div>

                    {{-- lastname --}}
                    <div class="w-full md:w-1/3">
                        <x-input type="text" name="last_name" label="Last name" required />
                    </div>

                    {{-- birthdate --}}
                    <div class="w-full md:w-1/3">
                        <x-input type="date" name="birthdate" label="Birthdate" required />
                    </div>

                    {{-- gender --}}
                    <div class="flex flex-col w-full gap-1 md:w-1/3">
                        <x-input-option name="consult_gender" label="Gender" required>
                            <option value="male">male</option>
                            <option value="female">female</option>
                        </x-input-option>
                    </div>
                </div>
            </div>

            {{-- Contact Information --}}
            <div class="flex flex-wrap justify-center w-full gap-10 ">
                <div class="flex flex-wrap items-start justify-center w-full gap-5 mb-10 ">
                    <h3 class="w-full mt-5 mb-2 text-xl font-medium md:w-1/3">Contact Information</h3>
                    <h3 class="hidden w-1/3 md:block"></h3>

                    {{-- phone number --}}
                    <div class="w-full md:w-1/3">
                        <x-input type="number" name="phone_numer" label="Phone number" required />
                    </div>

                    {{-- email --}}
                    <div class="w-full md:w-1/3">
                        <x-input type="email" name="email" label="Email" required />
                    </div>
                </div>
            </div>

            {{-- Consultation Information --}}
            <div class="flex flex-wrap justify-center w-full gap-10 ">
                {{-- Consultation Information --}}
                <div class="flex flex-wrap items-start justify-center w-full gap-5 mb-10 ">
                    <h3 class="w-full mt-5 mb-2 text-xl font-medium md:w-1/3">Consultation Information</h3>
                    <h3 class="hidden w-1/3 md:block"></h3>

                    {{-- Complain --}}
                    <div class="w-full md:w-1/3">
                        <x-input type="text" name="chief_complain" label="Chief Complaint" required />
                    </div>

                    {{-- Referral Form --}}
                    <div class="w-full md:w-1/3">
                        <x-input type="file" name="referral_form" label="Referal Form" />
                    </div>

                    {{-- appointment date --}}
                    <div class="w-full md:w-1/3">
                        <x-input type="date" name="appointment_date" label="Appointment Date" required />
                    </div>
                    <h3 class="hidden w-1/3 md:block"></h3>
                </div>
            </div>

            {{-- Health Information --}}
            <div class="flex flex-wrap justify-center gap-10 ">
                <div class="flex flex-wrap items-start justify-center gap-5 mb-10 ">
                    <h3 class="w-full mt-5 mb-2 text-xl font-medium md:w-1/3">Health Information</h3>
                    <h3 class="hidden w-1/3 md:block"></h3>

                    {{-- Height --}}
                    <div class="w-full md:w-1/3">
                        <x-input type="text" name="height" label="Height" required />
                    </div>

                    {{-- Weight --}}
                    <div class="w-full md:w-1/3">
                        <x-input type="text" name="weight" label="Weight" required />
                    </div>

                    {{-- Has your weight changed in the past year? --}}
                    <div class="flex flex-col w-full gap-1 md:w-1/3">
                        <x-input-option name="consult_weight_changed_past_year"
                            label="Has your weight changed in the past year?" required>
                            <option value="yes">yes</option>
                            <option value="no">no</option>
                        </x-input-option>
                    </div>

                    {{-- Do you exercise? --}}
                    <div class="flex flex-col w-full gap-1 md:w-1/3">
                        <x-input-option name="consult_exercise" label="Do you exercise?" required>
                            <option value="yes">yes</option>
                            <option value="no">no</option>
                        </x-input-option>
                    </div>

                    {{-- Are there any medical reasons why you cannot exercise? --}}
                    <div class="flex flex-col w-full gap-1 md:w-1/3">
                        <x-input-option name="consult_medical_reason"
                            label="Are there any medical reasons why you cannot exercise?" required>
                            <option value="yes">yes</option>
                            <option value="no">no</option>
                        </x-input-option>
                    </div>

                    {{-- Stress Level --}}
                    <div class="flex flex-col w-full gap-1 md:w-1/3">
                        <x-input-option name="consult_stress_level" label="Stress Level">
                            <option value="low">low</option>
                            <option value="balanced">balanced</option>
                            <option value="high">high</option>
                        </x-input-option>
                    </div>

                </div>
            </div>

            {{-- Nutrition Information --}}
            <div class="flex flex-wrap justify-center gap-10 ">
                <div class="flex flex-wrap items-start justify-center gap-5 mb-10 ">
                    <h3 class="w-full mt-5 mb-2 text-xl font-medium md:w-1/3">Nutrional Information</h3>
                    <h3 class="hidden w-1/3 md:block"></h3>

                    {{-- Have you met with a registered dietitian in the past? --}}
                    <div class="flex flex-col w-full gap-1 md:w-1/3">
                        <x-input-option name="consult_meet_past_dietician"
                            label="Have you met with a registered dietitian in the past?" required>
                            <option value="yes">yes</option>
                            <option value="no">no</option>
                        </x-input-option>
                    </div>

                    {{-- Do you follow a special diet or eating style --}}
                    <div class="flex flex-col w-full gap-1 md:w-1/3">
                        <x-input-option name="consult_special_diet"
                            label="Do you follow a special diet or eating style?" required>
                            <option value="yes">yes</option>
                            <option value="no">no</option>
                        </x-input-option>
                    </div>

                    {{-- Food preferences --}}
                    <div class="w-full md:w-1/3">
                        <x-input type="text" name="food_preference" label="Any food preferences" required />
                    </div>

                    {{-- Who does your grocery shopping? --}}
                    <div class="flex flex-col w-full gap-1 md:w-1/3">
                        <x-input-option name="consult_who_grocery" label="Who does your grocery shopping?">
                            <option value="Myself">Myself</option>
                            <option value="others">Others</option>
                        </x-input-option>
                    </div>

                    {{-- Who prepares your meals? --}}
                    <div class="flex flex-col w-full gap-1 md:w-1/3">
                        <x-input-option name="consult_who_prepare_meal" label="Who prepares your meals?">
                            <option value="Myself">Myself</option>
                            <option value="others">Others</option>
                        </x-input-option>
                    </div>

                    {{-- Do you ever skip meals? --}}
                    <div class="flex flex-col w-full gap-1 md:w-1/3">
                        <x-input-option name="consult_skip_meals" label="Do you ever skip meals?">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </x-input-option>
                    </div>

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
