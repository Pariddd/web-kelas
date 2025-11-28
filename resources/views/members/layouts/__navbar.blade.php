<nav
  class="desktop-nav bg-slate-900/50 backdrop-blur-md fixed w-full z-50 top-0 border-b border-white/10"
>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex items-center">
        <span class="text-2xl font-bold">Angker People</span>
      </div>

      <div class="hidden sm:flex items-center space-x-8">
        <a
          href="{{ route('members.home') }}"
          class="text-white font-medium hover:text-[#60a5fa] transition duration-300 flex items-center"
          >Home
        </a>
        <a href="" class="font-medium hover:text-[#60a5fa] transition duration-300 flex items-center">
            Anggota
        </a>
        <a
          href="{{ route('gallery.index') }}"
          class="font-medium hover:text-[#60a5fa] transition duration-300 flex items-center"
        >
          Gallery
        </a>
        <a
          href="https://github.com"
          target="_blank"
          class="hover:text-[#60a5fa] transition duration-300 flex items-center"
          >Contact
        </a>
      </div>
    </div>
  </div>
</nav>

<nav class="expanding-mobile-nav">
  <a href="{{ route('members.home') }}"
   class="expanding-nav-item {{ request()->routeIs('members.home') ? 'active' : '' }}">
    <i class="fas fa-home mr-2"></i>
    <span>Home</span>
</a>

  <a href="{{ request()->routeIs('members.home')
        ? '#anggota'
        : route('members.home') . '#anggota' }}"
   class="expanding-nav-item">
    <i class="fas fa-users mr-2"></i>
    <span>Anggota</span>
</a>

  <a href="{{ route('gallery.index') }}"
   class="expanding-nav-item {{ request()->routeIs('gallery.*') ? 'active' : '' }}">
    <i class="fas fa-images mr-2"></i>
    <span>Gallery</span>
</a>

 <a href="https://github.com" target="_blank"
   class="expanding-nav-item">
    <i class="fab fa-github mr-2"></i>
    <span>Contact</span>
</a>

</nav>