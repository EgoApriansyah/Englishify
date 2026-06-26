@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-body font-semibold text-body-sm text-ink']) }}>
    {{ $value ?? $slot }}
</label>

