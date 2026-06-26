@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-body font-semibold text-body-sm text-green']) }}>
        {{ $status }}
    </div>
@endif

