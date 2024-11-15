<button  id="{{ $id ?? 'default-id' }}" type="{{ $type ?? 'button' }}" {{ $attributes->merge(['class' => 'px-8 py-4 text-lg font-medium tracking-wider text-white uppercase bg-green-800 border rounded-md w-fit']) }}>
    {{ $slot }}
</button>
