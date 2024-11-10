{{-- LOGIN MODAL --}}
<div {{ $attributes-> merge(['class' => "fixed inset-0 z-20 flex items-center justify-center hidden min-h-screen p-5 py-10 text-black modal background-modal  "]) }}>
    <div class="container p-5 pb-5 bg-white border rounded-md modal-container max-w-96 ">
        {{ $slot }}
    </div>
</div>
