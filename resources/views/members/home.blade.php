@extends('members.layouts.master')

@section('content')
    <div class="main-content">
      <header class="pt-16 h-screen relative overflow-hidden">
        <img
          src="{{ asset('assets/members/img/hero.jpg') }}"
          alt="Cover"
          class="absolute inset-0 w-full h-full object-cover opacity-20"
        />
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="relative z-10 h-full flex items-center justify-center">
          <div class="text-center px-4">
            <p class="text-xl md:text-3xl font-bold">Hi, Visitor!</p>
            <h1 class="text-4xl md:text-7xl font-bold text-[#60a5fa] tracking-wide">
              WELCOME
            </h1>
            <p class="text-xl">to MIPA 2</p>
          </div>
        </div>
      </header>
      <section class="relative -mt-20 z-20 px-4">
        <div class="max-w-7xl mx-auto">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
              class="glass-card rounded-2xl p-6 text-center transform hover:scale-105 transition duration-700 scroll-fade-up opacity-0 translate-y-10"
            >
              <i class="fas fa-mars text-4xl text-[#60a5fa] mb-4"></i>
              <h3 class="text-xl font-bold text-white mb-2">Laki-laki</h3>
              <p class="text-3xl font-bold text-[#60a5fa]">{{ $male}}</p>
            </div>
            <div
              class="glass-card rounded-2xl p-6 text-center transform hover:scale-105 transition duration-700 scroll-fade-up opacity-0 translate-y-10"
            >
              <i class="fas fa-users text-4xl text-purple-400 mb-4"></i>
              <h3 class="text-xl font-bold text-white mb-2">Total</h3>
              <p class="text-3xl font-bold text-purple-400">{{ $member }}</p>
            </div>
            <div
              class="glass-card rounded-2xl p-6 text-center transform hover:scale-105 transition duration-700 scroll-fade-up opacity-0 translate-y-10"
            >
              <i class="fas fa-venus text-4xl text-pink-400 mb-4"></i>
              <h3 class="text-xl font-bold text-white mb-2">Perempuan</h3>
              <p class="text-3xl font-bold text-pink-400">{{ $female  }}</p>
            </div>
          </div>
        </div>
      </section>
      <h2 class="text-3xl font-bold text-center mt-20 mb-12 text-white">
        <span class="relative inline-block tracking-wider">
          <span class="relative z-10">Gallery</span>
          <span class="absolute bottom-0 left-0 w-full h-1 bg-[#60a5fa] z-0"></span>
        </span>
      </h2>
      <div class="hidden lg:flex items-center gap-2 h-[400px] w-full max-w-4xl mt-10 mx-auto">
        @foreach ($galleries as $gallery)
          <div class="relative group grow transition-all w-56 rounded-lg overflow-hidden h-[400px] duration-700 hover:w-full scroll-fade-up opacity-0 translate-y-10">
              <img class="h-full w-full object-cover object-center"
                  src="{{ $gallery->image ? asset('img_item_upload/' . $gallery->image) : 'https://placehold.co/300x300/EC4899/ffffff?text=Gallery' }}"
                  alt="image">
          </div>
        @endforeach
      </div>
      <div class="lg:hidden transition duration-1000 scroll-fade-up opacity-0 translate-y-10 px-4 sm:px-6">
        @if($galleries->isEmpty())
          <div class="space-y-3">
            <div class="w-full aspect-3/2 sm:aspect-video overflow-hidden rounded-xl sm:rounded-2xl  shadow-lg">
              <div class="w-full h-full flex flex-col items-center justify-center text-white p-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-16 sm:w-16 mb-3 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-base sm:text-lg font-semibold">No Gallery Available</p>
                <p class="text-xs sm:text-sm opacity-80 mt-1">Check back later for updates</p>
              </div>
            </div>
            <div class="grid grid-cols-4 sm:grid-cols-5 gap-2">
              @for($i=0;$i<5;$i++)
                <div class="aspect-square overflow-hidden rounded-lg animate-pulse">
                  <div class="w-full h-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 text-white opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                  </div>
                </div>
              @endfor
            </div>
          </div>
        @else
          <div class="space-y-3">
            <div class="relative w-full aspect-3/2 sm:aspect-video overflow-hidden rounded-xl sm:rounded-2xl bg-gray-100 shadow-lg">
              <img id="mainImageMobile"
                class="w-full h-full object-cover"
                src="{{ $galleries[0]->image ? asset('img_item_upload/' . $galleries[0]->image) : 'https://placehold.co/800x600/EC4899/ffffff?text=Gallery' }}"
                alt="Main Gallery Image">
              <div class="absolute top-3 right-3 bg-black/80 backdrop-blur-sm text-white px-2.5 py-1 rounded-full text-xs font-semibold shadow-lg">
                <span id="currentIndexMobile">1</span> / {{ $galleries->count() }}
              </div>
              <button id="prevBtnMobile" class="absolute left-2 sm:left-3 top-1/2 -translate-y-1/2 bg-white/95 active:bg-white text-gray-800 rounded-full p-2 sm:p-2.5 shadow-lg active:scale-95 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
              </button>
              <button id="nextBtnMobile" class="absolute right-2 sm:right-3 top-1/2 -translate-y-1/2 bg-white/95 active:bg-white text-gray-800 rounded-full p-2 sm:p-2.5 shadow-lg active:scale-95 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
              </button>
              <div class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-black/80 via-black/30 to-transparent p-3 sm:p-4">
                <h3 id="mainImageTitleMobile" class="text-white font-semibold text-sm sm:text-base drop-shadow-lg line-clamp-1">
                  {{ $galleries[0]->event ?? 'Gallery Image' }}
                </h3>
                <p id="mainImageDateMobile" class="text-white/90 text-xs mt-0.5">
                  {{ $galleries[0]->date ? \Carbon\Carbon::parse($galleries[0]->date)->format('M d, Y') : '' }}
                </p>
              </div>
            </div>
            <div class="grid grid-cols-4 sm:grid-cols-5 gap-2">
              @foreach ($galleries->take(10) as $index => $gallery)
                <div class="relative aspect-square overflow-hidden rounded-lg shadow-md active:scale-95 transition-transform">
                  <img
                    data-index="{{ $index }}"
                    data-src="{{ $gallery->image ? asset('img_item_upload/' . $gallery->image) : 'https://placehold.co/400x400/EC4899/ffffff?text=Gallery' }}"
                    data-title="{{ e($gallery->event) }}"
                    data-date="{{ $gallery->date ? \Carbon\Carbon::parse($gallery->date)->format('M d, Y') : '' }}"
                    class="thumbnail-img-mobile w-full h-full object-cover cursor-pointer {{ $index === 0 ? 'ring-2 ring-blue-500' : '' }}"
                    src="{{ $gallery->image ? asset('img_item_upload/' . $gallery->image) : 'https://placehold.co/400x400/EC4899/ffffff?text=Gallery' }}"
                    alt="Thumbnail {{ $index + 1 }}">
                  @if($index === 0)
                    <div class="thumbnail-active-mobile absolute inset-0 bg-blue-500/20 pointer-events-none border-2 border-blue-500"></div>
                  @else
                    <div class="thumbnail-active-mobile absolute inset-0 bg-blue-500/20 pointer-events-none border-2 border-blue-500 hidden"></div>
                  @endif
                </div>
              @endforeach
              @if($galleries->count() > 10)
                <a href="{{ route('gallery.index') }}" 
                  class="aspect-square overflow-hidden rounded-lg shadow-md active:scale-95 transition-transform flex flex-col items-center justify-center text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                  </svg>
                  <span class="text-[10px] sm:text-xs font-semibold">+{{ $galleries->count() - 10 }}</span>
                </a>
              @endif
            </div>
          </div>
        @endif
      </div>
      <div class="flex justify-center mt-12 mb-16">
        <a href="{{ route('gallery.index') }}"
          class="flex items-center justify-center
                  text-[#60a5fa] hover:before:bg-[#60a5fa] border-[#60a5fa]
                  relative h-[50px] w-40 overflow-hidden 
                  border bg-white px-3 shadow-2xl transition-all 
                  rounded-xl
                  before:absolute before:bottom-0 before:left-0 before:top-0 before:z-0 
                  before:h-full before:w-0 before:transition-all before:duration-500
                  hover:text-white hover:shadow-[#60a5fa] hover:before:left-0 hover:before:w-full">
            <span class="relative z-10">Open Gallery</span>
        </a>
      </div>
      <section class="py-16 px-4">
        <h2 class="text-3xl font-bold text-center mb-12 text-white">
          <span class="relative inline-block">
            <span class="relative z-10">Our Teacher</span>
            <span class="absolute bottom-0 left-0 w-full h-1 bg-[#60a5fa] z-0"></span>
          </span>
        </h2>
        <div class="grid grid-cols-2 gap-8 max-w-2xl mx-auto">
          @foreach ($teachers as $teacher)
            <div
              class="card-container relative group rounded-xl overflow-hidden hover:scale-105 opacity-0 translate-y-6 transition-all duration-700"
              data-reveal
              data-reveal-delay="{{ $loop->index * 0.08 }}"
            >
              <img
                src="{{ $teacher->avatar ? asset('avt_item_upload/' . $teacher->avatar) : 'https://placehold.co/300x300/EC4899/ffffff?text=Guru' }}"
                class="w-full aspect-square object-cover transition-all duration-300"
              />
              <div class="card-hover-overlay absolute inset-0 flex flex-col justify-end p-6 liquid-glass-overlay">
                <h3 class="text-xl font-bold text-white drop-shadow-lg mb-2">{{ ucwords($teacher->name) }}</h3>
                <p class="text-gray-100 drop-shadow">{{ ucwords($teacher->nickname) }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </section>
      <section id="anggota" class="py-16 px-4">
        <h2 class="text-3xl font-bold text-center mb-12 text-white">
          <span class="relative inline-block">
            <span class="relative z-10">Our Members</span>
            <span class="absolute bottom-0 left-0 w-full h-1 bg-[#60a5fa] z-0"></span>
          </span>
        </h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">
          @foreach ($members as $member)
            <div
              class="card-container relative group rounded-xl overflow-hidden hover:scale-105 opacity-0 translate-y-6 transition-all duration-700"
              data-reveal
              data-reveal-delay="{{ $loop->index * 0.06 }}"
            >
              <img
                src="{{ $member->avatar ? asset('avt_item_upload/' . $member->avatar) : 'https://placehold.co/300x300/EC4899/ffffff?text=Member' }}"
                alt="{{ $member->name }}"
                class="w-full aspect-square object-cover transition-all duration-300"
              />
              <div class="card-hover-overlay absolute inset-0 flex flex-col justify-end p-6 liquid-glass-overlay">
                <h3 class="text-xl font-bold text-white mb-2">{{ ucwords($member->name) }}</h3>
                <p class="text-gray-200">{{ ucwords($member->role) }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </section>
      
      
   <script src="{{ asset('assets/members/js/animation.js') }}"></script>
   <script src="{{ asset('assets/members/js/thumbnails.js') }}"></script>
@endsection