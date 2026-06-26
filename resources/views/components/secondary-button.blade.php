<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-canvas border border-hairline rounded-md font-semibold text-base text-ink hover:border-green hover:text-green-dark focus:outline-none focus:ring-2 focus:ring-green focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-120 transform hover:-translate-y-px active:translate-y-0 cursor-pointer']) }}>
    {{ $slot }}
</button>

