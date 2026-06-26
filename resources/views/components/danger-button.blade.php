<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-brick border border-transparent rounded-md font-body font-semibold text-base text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-brick focus:ring-offset-2 transition ease-in-out duration-150 transform hover:-translate-y-px active:translate-y-0']) }}>
    {{ $slot }}
</button>

