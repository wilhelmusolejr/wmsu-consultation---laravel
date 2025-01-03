<?php
// dd($appointments);
?>

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
    @vite(['resources/js/dietitian/my-pending-consultation.js'])
</head>

<body>

    {{-- header --}}
    <header class="relative flex flex-col min-h-screen home-header halfscreen">

        {{-- banner --}}
        <x-page-banner />

        {{-- navigator --}}
        <x-navigator />

        {{-- header content --}}
        <div class="container flex items-center justify-center flex-1 w-full gap-5 px-5 mx-auto ">
            <div class="flex flex-col items-center self-end justify-center text-center">
                <h1 class="text-3xl font-bold uppercase lg:text-6xl">My consultations</h1>
                <p class="pt-5 lg:w-9/12">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium accusamus
                    eos recusandae. Quaerat similique sapiente, explicabo distinctio provident odit velit.</p>
            </div>
        </div>

    </header>

    <div class=" py-28 lg:py-40">
        <div class="container mx-auto">
            <div class="overflow-x-auto rounded-md">
                <table class="min-w-full bg-white border border-gray-200">
                    <!-- Table Header -->
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border-b">Appointment Date</th>
                            <th class="px-4 py-2 border-b">Chief Complaint</th>
                            <th class="px-4 py-2 border-b">Age</th>
                            <th class="px-4 py-2 border-b">Gender</th>
                            <th class="px-4 py-2 border-b">Appointment Option</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody class="text-center capitalize">
                        <!-- Example Row -->
                        {{-- @foreach ($appointments as $appointment)
                            <tr class=" appointment" data-id="{{ $appointment['appointment_id'] }}">
                                <td class="px-4 py-2 border-b">{{ $appointment['age'] }}</td>
                                <td class="px-4 py-2 capitalize border-b">{{ $appointment['gender'] }}</td>
                                <td class="px-4 py-2 border-b">{{ $appointment['chief_complaint'] }}</td>
                                <td class="px-4 py-2 border-b">{{ $appointment['appointment_date'] }}</td>
                                <td class="flex items-center justify-center gap-5 px-4 py-2 border-b">
                                    <div
                                        class="px-5 py-2 text-white bg-green-500 rounded-md cursor-pointer approve-btn">
                                        Approve</div>
                                    <div class="px-5 py-2 text-white bg-red-500 rounded-md cursor-pointer decline-btn">
                                        Decline</div>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
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
