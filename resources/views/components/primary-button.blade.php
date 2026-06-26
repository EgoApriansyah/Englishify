<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-green border border-transparent rounded-md font-semibold text-base text-white hover:bg-green-dark focus:outline-none focus:ring-2 focus:ring-green focus:ring-offset-2 transition ease-in-out duration-120 transform hover:-translate-y-px active:translate-y-0 cursor-pointer']) }}>
    {{ $slot }}
</button>

