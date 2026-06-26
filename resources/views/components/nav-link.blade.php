@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-fern text-body-sm font-body font-semibold leading-5 text-white focus:outline-none focus:border-fern transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-body-sm font-body font-medium leading-5 text-white/70 hover:text-white hover:border-fern/50 focus:outline-none focus:text-white focus:border-fern transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

