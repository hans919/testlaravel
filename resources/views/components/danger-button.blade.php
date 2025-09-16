<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-accent-red border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-accent-orange focus:outline-none focus:ring-2 focus:ring-accent-red focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
