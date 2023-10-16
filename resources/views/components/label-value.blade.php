@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-base text-black']) }}>
    {{ $value ?? $slot }}
</label>
