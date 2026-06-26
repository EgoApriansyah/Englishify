@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-hairline bg-canvas text-ink rounded-sm px-4 py-3 placeholder-muted focus:border-green focus:ring-4 focus:ring-green/15 focus:outline-none transition duration-120 ease-in-out shadow-sm']) }}>

