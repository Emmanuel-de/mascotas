<button {{ $attributes->merge(['type' => 'submit', 'class' => 'cyber-button inline-flex items-center px-6 py-3 rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
