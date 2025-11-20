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
              class="glass-card rounded-2xl p-6 text-center transform hover:scale-105 transition duration-300"
            >
              <i class="fas fa-mars text-4xl text-[#60a5fa] mb-4"></i>
              <h3 class="text-xl font-bold text-white mb-2">Laki-laki</h3>
              <p class="text-3xl font-bold text-[#60a5fa]">{{ $male }}</p>
            </div>
            <div
              class="glass-card rounded-2xl p-6 text-center transform hover:scale-105 transition duration-300"
            >
              <i class="fas fa-users text-4xl text-purple-400 mb-4"></i>
              <h3 class="text-xl font-bold text-white mb-2">Total</h3>
              <p class="text-3xl font-bold text-purple-400">{{ $member }}</p>
            </div>
            <div
              class="glass-card rounded-2xl p-6 text-center transform hover:scale-105 transition duration-300"
            >
              <i class="fas fa-venus text-4xl text-pink-400 mb-4"></i>
              <h3 class="text-xl font-bold text-white mb-2">Perempuan</h3>
              <p class="text-3xl font-bold text-pink-400">{{ $female }}</p>
            </div>
          </div>
        </div>
      </section>
      <section id="gallery" class="py-16 px-4 mt-16">
        <div class="max-w-7xl mx-auto">
          <h2 class="text-3xl font-bold text-center mb-12 text-white">
            Gallery
          </h2>

          <div class="relative group">
            <div class="overflow-hidden">
              <div
                class="gallery-container flex space-x-4 overflow-x-auto pb-4 scrollbar-hide"
                id="gallery-container"
              >
                @foreach ($galleries as $gallery)
                  <div
                    class="gallery-item shrink-0 w-full md:w-1/3 lg:w-1/3"
                  >
                    <div
                      class="glass-card rounded-xl overflow-hidden transition-all duration-300"
                    >
                      <img src="{{ $gallery->image ? asset('img_item_upload/' . $gallery->image) : 'https://placehold.co/300x300/EC4899/ffffff?text=Gallery' }}"
                        alt="Gallery 1"
                        class="w-full h-48 object-cover"
                      />
                      <div class="p-4">
                        <h3 class="font-semibold text-white">{{ $gallery->event }}</h3>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
            <button
              id="scroll-left"
              class="absolute left-0 top-1/2 transform -translate-y-1/2 glass-card rounded-full p-3 z-10 hidden group-hover:block"
            >
              <i class="fas fa-chevron-left text-white"></i>
            </button>
            <button
              id="scroll-right"
              class="absolute right-0 top-1/2 transform -translate-y-1/2 glass-card rounded-full p-3 z-10 hidden group-hover:block"
            >
              <i class="fas fa-chevron-right text-white"></i>
            </button>
          </div>

          <div class="text-center mt-8">
            <button class="liquid-glass-btn">All Gallery</button>
          </div>
        </div>
      </section>
      <section class="py-16 px-4">
        <div class="grid grid-cols-2 gap-8 max-w-2xl mx-auto">
          @foreach ($teachers as $teacher)
            <div
              class="card-container relative group rounded-xl overflow-hidden transition-transform duration-300 hover:scale-105 opacity-0 translate-y-6 transition-all duration-700"
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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          @foreach ($members as $member)
            <div
              class="card-container relative group rounded-xl overflow-hidden transition-transform duration-300 hover:scale-105 opacity-0 translate-y-6 transition-all duration-700"
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
      
@endsection
