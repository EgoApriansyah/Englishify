@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-body-sm text-red font-body space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif

