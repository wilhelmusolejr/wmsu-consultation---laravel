<div class="p-5 bg-white border rounded-md shadow-md lg:p-7 max-w-80 md:max-w-none">
    <div class="relative flex items-center justify-center p-5 pb-0 bg-blue-200 border rounded-md">
        <img src="{{ $image }}" alt="Doctor" class="">
        <div class="absolute px-5 py-2 bg-white shadow-md floating-info rounded-3xl">
            <div class="flex items-center gap-2">
                <i class="text-red-500 fa-solid fa-heart"></i>
                <p class="text-slate-700">{{ $patients }} patients assisted.</p>
            </div>
        </div>
    </div>
    <div class="pb-2 text-center pt-7">
        <h3 class="font-medium lg:text-xl name">Rnd. {{ $name }}</h3>
    </div>
</div>
