<x-app-layout>
    <!-- component -->
    <div class="flex h-[calc(100vh-55px)] overflow-hidden">
        <!-- Sidebar -->
        <div class="w-1/4 bg-white border-r border-gray-300">
            <!-- Sidebar Header -->
            <header class="p-4 border-b border-gray-300 flex justify-between items-center bg-indigo-600 text-white">
                <h1 class="text-2xl font-semibold">Chat Web</h1>
                <div class="relative">
                    <button id="toggleUsers" class="focus:outline-none">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <!-- Menu Dropdown -->
                </div>
            </header>

            <!-- Messages Section -->
            <div id="messagesSection" class="overflow-y-auto h-screen p-3 pb-20">
                @foreach ($messages as $mensaje)
                    <div class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                            @if ($mensaje['avatar_url'])
                                <img src="{{ $mensaje['avatar_url'] }}" alt="{{ $mensaje['name'] }}"
                                    class="w-12 h-12 rounded-full">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $mensaje['initial'] }}&color=7F9CF5&background=EBF4FF"
                                    alt="{{ $mensaje['name'] }}" class="w-12 h-12 rounded-full">
                            @endif
                        </div>
                        <div class="flex-1">
                            <h2 class="text-lg font-semibold">{{ $mensaje['name'] }}</h2>
                            <p class="text-gray-600">{{ $mensaje['last_message'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Users Section (Initially Hidden) -->
            <div id="usersSection" class="overflow-y-auto h-screen p-3 pb-20 hidden">
                @foreach ($usuarios as $usuario)
                    <div class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                            @if ($usuario['avatar_url'])
                                <img src="{{ $usuario['avatar_url'] }}" alt="{{ $usuario['name'] }}"
                                    class="w-12 h-12 rounded-full">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $usuario['initial'] }}&color=7F9CF5&background=EBF4FF"
                                    alt="{{ $usuario['name'] }}" class="w-12 h-12 rounded-full">
                            @endif
                        </div>
                        <div class="flex-1">
                            <h2 class="text-lg font-semibold">{{ $usuario['name'] }}</h2>
                            <p class="text-gray-600">{{ $usuario['cargo'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <x-mensaje :opcional="$opcional" />
    </div>

    <style>
        .scrollbar-w-2::-webkit-scrollbar {
            width: 0.25rem;
            height: 0.25rem;
        }

        .scrollbar-track-blue-lighter::-webkit-scrollbar-track {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity));
        }

        .scrollbar-thumb-blue::-webkit-scrollbar-thumb {
            --bg-opacity: 1;
            background-color: #edf2f7;
            background-color: rgba(237, 242, 247, var(--bg-opacity));
        }

        .scrollbar-thumb-rounded::-webkit-scrollbar-thumb {
            border-radius: 0.25rem;
        }
    </style>

    <script>
        const el = document.getElementById('messages');
        el.scrollTop = el.scrollHeight;

        // JavaScript for showing/hiding the menu
        const menuButton = document.getElementById('menuButton');
        const menuDropdown = document.getElementById('menuDropdown');

        menuButton.addEventListener('click', () => {
            if (menuDropdown.classList.contains('hidden')) {
                menuDropdown.classList.remove('hidden');
            } else {
                menuDropdown.classList.add('hidden');
            }
        });

        // Close the menu if you click outside of it
        document.addEventListener('click', (e) => {
            if (!menuDropdown.contains(e.target) && !menuButton.contains(e.target)) {
                menuDropdown.classList.add('hidden');
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('toggleUsers');
            const messagesSection = document.getElementById('messagesSection');
            const usersSection = document.getElementById('usersSection');

            toggleButton.addEventListener('click', function() {
                if (messagesSection.classList.contains('hidden')) {
                    messagesSection.classList.remove('hidden');
                    usersSection.classList.add('hidden');
                } else {
                    messagesSection.classList.add('hidden');
                    usersSection.classList.remove('hidden');
                }
            });
        });
    </script>
</x-app-layout>
