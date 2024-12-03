<nav class="bg-white border-b border-gray-300 shadow-sm">
    <!-- Barra principal -->
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <!-- Título -->
        <div class="text-gray-600 text-md">
            Bienvenido, <span class="font-bold">{{ Auth::user()->name }}</span>
        </div>

        <!-- Botón de salir -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                class="text-gray-500 border border-gray-300 px-4 py-2 rounded-md hover:text-gray-800 hover:border-gray-500">
                Salir
            </button>
        </form>
    </div>

    <!-- Submenú -->
    <div class="border-t border-gray-300">
        <div class="container mx-auto flex justify-center space-x-10 py-2">
            <a href="{{ route('dashboard') }}"
                class="flex flex-col items-center text-gray-500 hover:text-gray-800 transition-colors {{ request()->routeIs('dashboard') ? 'text-gray-800 font-bold' : '' }}">
                <span>Principal</span>
            </a>
            <a href="{{ route('user.dashboard') }}"
                class="flex flex-col items-center text-gray-500 hover:text-gray-800 transition-colors {{ request()->routeIs('user.dashboard') ? 'text-gray-800 font-bold' : '' }}">
                <span>Mi Día</span>
            </a>
            <a href="{{ route('user.sessions') }}"
                class="flex flex-col items-center text-gray-500 hover:text-gray-800 transition-colors {{ request()->routeIs('user.sessions') ? 'text-gray-800 font-bold' : '' }}">
                <span>Mis Jornadas</span>
            </a>
        </div>
    </div>
</nav>
