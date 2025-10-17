<nav x-data="{ open:false }" class="sticky top-0 z-50 bg-[#0B2A4A] text-white border-b border-[#0B2A4A]">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="h-16 flex items-center justify-between">
      <!-- Logo -->
      <a href="{{ route('home') }}" class="shrink-0 flex items-center gap-3">
        <x-application-logo class="h-8 w-8 text-white" />
        <span class="text-lg font-semibold tracking-tight text-white">AI in a Nutshell</span>
      </a>

      <!-- Desktop nav -->
      <div class="hidden sm:flex sm:items-center sm:space-x-5">
        <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
          class="uppercase tracking-wide text-sm pb-1 border-b-2 border-transparent hover:border-[#D4A017] hover:text-white {{ request()->routeIs('home') ? 'border-[#D4A017] text-white' : '' }}">
          Home
        </x-nav-link>

        @can('admin')
          <x-nav-link :href="route('admin.chapters.index')" :active="request()->is('admin*')"
            class="uppercase tracking-wide text-sm pb-1 border-b-2 border-transparent hover:border-[#D4A017] hover:text-white {{ request()->is('admin*') ? 'border-[#D4A017] text-white' : '' }}">
            Admin
          </x-nav-link>
        @endcan

        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
          class="uppercase tracking-wide text-sm pb-1 border-b-2 border-transparent hover:border-[#D4A017] hover:text-white {{ request()->routeIs('dashboard') ? 'border-[#D4A017] text-white' : '' }}">
          Dashboard
        </x-nav-link>
      </div>

      <!-- Search + user -->
      <div class="hidden sm:flex items-center gap-4">
        <form action="{{ route('search') }}" method="GET" class="relative">
          <input type="search" name="q" value="{{ request('q') }}" placeholder="Search lessons"
                 class="w-56 rounded-md border-white/20 bg-white/10 text-white placeholder-white/70 text-sm pl-9 focus:ring-0 focus:border-[#D4A017]">
          <svg class="absolute left-2 top-1/2 -translate-y-1/2 h-4 w-4 text-white/80" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 1 1 1.41-1.41l3.39 3.39a1 1 0 0 1-1.42 1.42l-3.38-3.4zM14 8a6 6 0 1 1-12 0 6 6 0 0 1 12 0z" clip-rule="evenodd"/>
          </svg>
        </form>

        @auth
          <x-dropdown align="right" width="48">
            <x-slot name="trigger">
              <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-white hover:text-[#D4A017] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4A017] focus:ring-offset-[#0B2A4A]">
                <div>{{ auth()->user()->name }}</div>
                <svg class="ms-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.939l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z" clip-rule="evenodd"/>
                </svg>
              </button>
            </x-slot>
            <x-slot name="content">
              <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
              <form method="POST" action="{{ route('logout') }}">@csrf
                <x-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                  Log Out
                </x-dropdown-link>
              </form>
            </x-slot>
          </x-dropdown>
        @endauth

        @guest
          <a href="{{ route('login') }}" class="text-sm underline hidden md:inline">Login</a>
          <a href="{{ route('register') }}" class="text-sm underline hidden md:inline">Register</a>
        @endguest
      </div>

      <!-- Mobile trigger -->
      <button
        @click="open = !open"
        class="sm:hidden p-2 rounded-md text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4A017] focus:ring-offset-[#0B2A4A]"
        aria-label="Toggle menu">
        <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        <svg x-show="open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
  </div>

  <!-- Mobile panel -->
  <div x-show="open" x-transition.opacity class="sm:hidden border-t border-white/10">
    <div class="px-4 py-3 space-y-1">
      <x-responsive-nav-link
        class="text-white hover:bg-white/10 focus:bg-white/10"
        :href="route('home')" :active="request()->routeIs('home')">Home</x-responsive-nav-link>

      @can('admin')
        <x-responsive-nav-link
          class="text-white hover:bg:white/10 focus:bg-white/10"
          :href="route('admin.chapters.index')" :active="request()->is('admin*')">Admin</x-responsive-nav-link>
      @endcan

      <x-responsive-nav-link
        class="text-white hover:bg-white/10 focus:bg-white/10"
        :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-responsive-nav-link>

      <form action="{{ route('search') }}" method="GET" class="pt-2">
        <input type="search" name="q" value="{{ request('q') }}" placeholder="Search lessons"
               class="w-full rounded-md border-white/20 bg-white/10 text-white placeholder-white/70 text-sm focus:border-[#D4A017]">
      </form>
    </div>
  </div>
</nav>
