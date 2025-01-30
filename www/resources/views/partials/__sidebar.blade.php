<aside id="sidebar"
    class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
    aria-label="Sidebar">
    <div
        class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                <ul class="pb-2 space-y-2">
                    {{-- search --}}
                    {{-- <li>
                        <x-dashboard.sidebar.mobile-search-form />
                    </li> --}}

                    {{-- dashboard --}}
                    @php
                        $app_debug = config('app.debug');
                        $app_env = config('app.env');

                        $list_hidden_menu = ['permission.index', 'route.index', 'menu.index'];
                    @endphp

                    @foreach ($menus as $menu)
                        @can($menu->permission_name)
                            @if (blank($menu->route))
                                @php
                                    $matchRoute = $menu->items->first(function ($value) {
                                        return request()->routeIs($value->route);
                                    });
                                @endphp
                                <li>
                                    <x-dashboard.sidebar.drop-down-button controls='{{ $menu->id }}'
                                        content='{{ $menu->name }}'>
                                        <x-remix-icon class="{{ $menu->icon }}"></x-remix-icon>
                                    </x-dashboard.sidebar.drop-down-button>
                                    <x-dashboard.sidebar.drop-down-wrapper show="{{ $matchRoute ? 'true' : 'false' }}"
                                        controls='{{ $menu->id }}'>
                                        @foreach ($menu->items as $item)
                                            @can($item->permission_name)
                                                @php
                                                    // Ambil nama route saat ini
                                                    $currentRoute = request()->route()->getName();

                                                    // Ambil segmen-segmen dari route sekarang dan route item
                                                    $currentRouteSegments = explode('.', $currentRoute);
                                                    $itemRouteSegments = explode('.', $item->route);

                                                    // Cek apakah route sekarang mirip dengan route item
                                                    $isSimilarRoute = Str::startsWith($currentRoute, $item->route);

                                                    // Jika segmen pertama sama tapi segmen lain berbeda, anggap tidak equal
                                                    $equal = request()->routeIs($item->route);
                                                    if ($isSimilarRoute && $currentRoute !== $item->route) {
                                                        $equal = false;
                                                    }
                                                @endphp
                                    <li>
                                        <x-dashboard.sidebar.item isActive="{{ $equal }}" class="pl-5"
                                            content="{{ $item->name }}" path="{{ route($item->route) }}">
                                            <x-remix-icon class="{{ $item->icon }}"></x-remix-icon>
                                        </x-dashboard.sidebar.item>
                                    </li>
                                @endcan
                            @endforeach
                            </x-dashboard.sidebar.drop-down-wrapper>
                            </li>
                        @else
                            @php
                                // Ambil nama route saat ini dan route menu
                                $currentRoute = request()->route()->getName();
                                $menuRouteSegments = explode('.', $menu->route);

                                // Cek apakah route saat ini mirip dengan route menu
                                $isSimilarRoute = Str::startsWith($currentRoute, $menu->route);

                                // Jika segmen pertama sama tapi segmen lain berbeda, anggap tidak equal
                                $equal = request()->routeIs($menu->route);
                                if ($isSimilarRoute && $currentRoute !== $menu->route) {
                                    $equal = false;
                                }

                                $is_hidden =
                                    in_array($menu->route, $list_hidden_menu) &&
                                    !$app_debug &&
                                    $app_env == 'production';

                            @endphp
                            <li class="{{ $is_hidden === true ? 'hidden' : '' }}">
                                <x-dashboard.sidebar.item isActive="{{ $equal }}" content="{{ $menu->name }}"
                                    path="{{ route($menu->route) }}">
                                    <x-remix-icon class="{{ $menu->icon }}"></x-remix-icon>
                                </x-dashboard.sidebar.item>
                            </li>
                        @endif
                    @endcan
                    @endforeach


                    {{-- <li>
                        <x-dashboard.sidebar.item path="{{ route('user.index') }}" content="User Management">
                            <x-remix-icon class="ri-file-user-fill"></x-remix-icon>
                        </x-dashboard.sidebar.item>
                    </li> --}}


                </ul>
            </div>
        </div>
        {{-- @include('components.dashboard.sidebar.partials.__sidebar-fotter') --}}
    </div>
</aside>
