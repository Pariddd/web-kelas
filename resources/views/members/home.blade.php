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

      <div class="max-w-md mx-auto lg:hidden">
        <div class="grid grid-cols-3 gap-2">
            @foreach ($galleries as $gallery)
            <div class="bg-white rounded-xl overflow-hidden shadow-sm aspect-square 
                        photo-card opacity-0 translate-y-10 transition-all duration-700 hover:scale-105 scroll-fade-up">
                <img 
                    src="{{ $gallery->image ? asset('img_item_upload/' . $gallery->image) : 'https://placehold.co/150x150/cccccc/ffffff?text=No+Image' }}" 
                    alt="Gallery Image" 
                    class="w-full h-full object-cover"
                >
            </div>
            @endforeach
        </div>
      </div>




      <div class="flex justify-center mt-12 mb-16">
        <a href="#"
          class="flex items-center justify-center
                  text-[#60a5fa] hover:before:bg-[#60a5fa] border-[#60a5fa]
                  relative h-[50px] w-40 overflow-hidden 
                  border bg-white px-3 shadow-2xl transition-all 
                  rounded-xl
                  before:absolute before:bottom-0 before:left-0 before:top-0 before:z-0 
                  before:h-full before:w-0 before:transition-all before:duration-500
                  hover:text-white hover:shadow-[#60a5fa] hover:before:left-0 hover:before:w-full">
            <span class="relative z-10">Swipe</span>
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
        <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">
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
      
@endsection