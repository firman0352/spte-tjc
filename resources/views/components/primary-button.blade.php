<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex min-w-full items-center justify-center px-4 py-2 bg-purple-300 border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-400 focus:bg-purple-400 active:bg-purple-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
