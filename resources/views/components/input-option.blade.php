<label class="capitalize" for="{{ $name }}">{{ $label }} <span class="text-red-500 ">{{ $required ?? false? "*" : "" }}</span></label>
<select id="{{ $name }}" class="capitalize rounded-md" {{ $required ?? false? "requireds" : "" }}>
    <option value="" selected>-</option>
    {{ $slot }}
</select>

