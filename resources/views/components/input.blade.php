<div class="flex flex-col w-full gap-1">
    <label class="capitalize" for="{{ $name }}">{{ $label }}</label>
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        class="rounded-md {{ $disabled ?? false ? 'bg-gray-300' : '' }}"
        {{ $disabled ?? false ? 'disabled' : '' }}
        value="{{ $value ?? '' }}"
    >
</div>
