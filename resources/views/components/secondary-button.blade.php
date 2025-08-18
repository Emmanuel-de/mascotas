<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-3 bg-transparent border border-cyan-400 rounded-md font-semibold text-xs text-cyan-400 uppercase tracking-widest hover:bg-cyan-400 hover:bg-opacity-10 hover:text-cyan-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
