<div class="flex items-center">
    <div class="flex items-center ms-3">
        <div>
            <button type="button"
                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-sgaFontBlue dark:focus:ring-sgaFontBlue"
                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                    alt="{{ Auth::user()->name }}">
            </button>
        </div>
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
            id="dropdown-user">
            <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900 dark:text-white" role="none">
                    {{ Auth::user()->name }}
                </p>
                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                    {{ Auth::user()->email }}
                </p>
            </div>
            <ul class="py-1" role="none">
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </ul>
        </div>
    </div>
</div>
