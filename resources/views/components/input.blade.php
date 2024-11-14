<div class="flex flex-col w-full gap-1">
    <label class="capitalize" for="{{ $name }}">{{ $label }} <span class="text-red-500 ">{{ $required ?? false? "*" : "" }}</span></label>
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        class="rounded-md {{ $disabled ?? false ? 'bg-gray-100' : '' }}"
        {{ $disabled ?? false ? 'disabled' : '' }}
        value="{{ $value ?? '' }}"
        {{ $required ?? false? "requireds" : "" }}
    >
</div>
