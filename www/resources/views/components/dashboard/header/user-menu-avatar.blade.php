<div>
    <button type="button"
        class="flex text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
        id="user-menu-button-2" aria-expanded="false" data-dropdown-toggle="dropdown-2">
        <span>{{ Auth::user()->name }}</span>
        <x-remix-icon class="ri-arrow-down-s-line ms-1"></x-remix-icon>
    </button>
</div>
