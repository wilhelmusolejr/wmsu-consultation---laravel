{{-- NAVIGATOR --}}
<div class="sticky top-0 left-0 z-10 flex justify-between w-full px-5 py-5 lg:px-0 navigator">
    <div class="flex items-center justify-between w-full px-0 lg:px-5 xl:px-10 ">
        {{-- left --}}
        <ul class="hidden gap-5 text-lg tracking-wide uppercase lg:flex text-light-black">
            <li><a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'font-semibold text-black' : '' }}">Home</a></li>
            <li><a href="{{ route('navigator') }}"
                    class="{{ request()->routeIs('navigator') ? 'font-semibold text-black' : '' }}">Consultation</a></li>
            <li><a href="{{ route('instructors') }}"
                    class="{{ request()->routeIs('instructors') ? 'font-semibold text-black' : '' }}">Instructors</a>
            </li>
            <li><a href="#" class="{{ request()->routeIs('tools') ? 'font-semibold text-black' : '' }}">Tools</a>
            </li>
            <li><a href="#" class="{{ request()->routeIs('faq') ? 'font-semibold text-black' : '' }}">FAQ</a></li>
            <li><a href="#" class="{{ request()->routeIs('about') ? 'font-semibold text-black' : '' }}">About
                    Us</a></li>
            <li><a href="#" class="{{ request()->routeIs('contact') ? 'font-semibold text-black' : '' }}">Contact
                    Us</a></li>
        </ul>

        {{-- right --}}
        <div class="hidden guest-parent">
            <div class="items-center hidden gap-5 cursor-pointer lg:flex ">
                <a href="#" class="text-lg tracking-wide uppercase text-light-black login-btn">Login</a>
                <x-button class="register-btn">Register</x-button>
            </div>
        </div>

        {{-- LOGGED IN - right --}}
        <div class="hidden authenticated-parent">
            <div class="flex items-center gap-5 cursor-pointer account-info">

                <p class="capitalize user-name">LOADING</p>
                <div class="relative inline-block text-left">
                    <div>
                      <button type="button" class="w-12 h-12 border-2 border-green-500 rounded-full" id="menu-button" aria-expanded="true" aria-haspopup="true">
                            <img src={{ asset('images/profile_picture.jpg') }} class="w-full h-full rounded-full" alt="">
                      </button>
                    </div>

                    <div class="absolute right-0 z-10 hidden w-56 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black/5 focus:outline-none account-info-option" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                      <div class="py-1" role="none">
                        <!-- Active: "bg-gray-100 text-gray-900 outline-none", Not Active: "text-gray-700" -->
                        <a href="/my-consultation" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-0">My consultations</a>
                        <a href="/my-pending-consultation" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-0">Pending consultations</a>
                        {{-- <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-0">Pending Consultation</a> --}}
                        <form method="POST" action="#" role="none">
                          <button type="submit" id="logout-btn" class="block w-full px-4 py-2 text-sm text-left text-gray-700" role="menuitem" tabindex="-1" id="menu-item-3">Sign out</button>
                        </form>
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-between w-full lg:hidden">
            <a href="#" class="text-lg">Home</a>
            <div class=""><i class="fa-solid fa-bars"></i></div>
        </div>



    </div>
</div>

{{-- LOGIN MODAL --}}
<x-modal class="modal-login">
    {{-- header --}}
    <x-modal-header class="mb-5 border-b-2 border-black">
        Login
    </x-modal-header>

    {{-- body --}}
    <x-modal-body>
        <form action="" class="flex flex-col gap-5">
            @csrf

            <x-input type="email" name="email" label="Email" />
            <x-input type="password" name="password" label="Password" />

            <div class="flex items-center justify-center">
                <x-button type="submit" id="login-form-btn">Login</x-button>
            </div>
        </form>
    </x-modal-body>

    <div class="mt-10"><a href="#">Register</a></div>
</x-modal>

{{-- REGISTER MODAL --}}
<x-modal class="modal-register">
    {{-- header --}}
    <x-modal-header class="mb-5 border-b-2 border-black">
        Register
    </x-modal-header>

    {{-- body --}}
    <x-modal-body>
        <form action="" class="flex flex-col gap-5">
            @csrf

            {{-- first name --}}
            <x-input type="text" name="first_name" label="First name" />

            {{-- last name --}}
            <x-input type="text" name="last_name" label="Last name" />

            {{-- email --}}
            <x-input type="email" name="email" label="Email" />

            {{-- password --}}
            <x-input type="password" name="password" label="Password" />

            <div class="flex items-center justify-center">
                <x-button id="register-form-btn">Register</x-button>
            </div>
        </form>
    </x-modal-body>

    <div class="mt-10"><a href="#">Login</a></div>
</x-modal>
