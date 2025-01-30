<nav class="fixed z-30 w-full border-b border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <x-dashboard.header.sidebar-toggler-button />

                {{-- <x-dashboard.header.logo /> --}}
                {{-- Include logo and pass identitas --}}
                <x-dashboard.header.logo :identitas="$identitas" />
            </div>
            <div class="flex items-center">
                <!-- Search mobile -->
                {{-- <x-dashboard.header.mobile-search /> --}}
                <!-- Notifications -->
                {{-- <x-dashboard.header.notification-button /> --}}
                <!-- Dropdown menu -->
                {{-- <x-dashboard.header.notification-drop-down /> --}}
                <!-- Apps -->
                <!-- Dropdown menu -->

                <x-dashboard.header.dark-white-mode-toggler />

                <!-- Profile -->
                <div class="ml-3 flex items-center">
                    <x-dashboard.header.user-menu-avatar />
                    <!-- Dropdown menu -->
                    <x-dashboard.header.user-menu-drop-down />
                </div>
            </div>
        </div>
    </div>
</nav>
