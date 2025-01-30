<div class="z-50 hidden min-w-m my-4 text-base list-none bg-white divide-y divide-gray-100 rounded rounded-e-none shadow dark:bg-gray-700 dark:divide-gray-600"
    id="dropdown-2">
    <x-dashboard.header.user-menu-drop-down-item path="{{ route('profile.edit') }}" content="Profile" />

    <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                    this.closest('form').submit();"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                role="menuitem">Log out</a>
        </form>
    </li>
    </ul>
</div>
