@extends('members.layouts.master')

@section('content')
    <div class="main-content">
      <header class="pt-16 h-screen relative overflow-hidden">

  <!-- Gambar Cover -->
  <img
    src="{{ asset('assets/members/img/hero.jpg') }}"
    alt="Cover"
    class="absolute inset-0 w-full h-full object-cover opacity-20"
  />

  <!-- Overlay tambahan agar gambar lebih redup -->
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
              <p class="text-3xl font-bold text-[#60a5fa]">7</p>
            </div>
            <div
              class="glass-card rounded-2xl p-6 text-center transform hover:scale-105 transition duration-300"
            >
              <i class="fas fa-users text-4xl text-purple-400 mb-4"></i>
              <h3 class="text-xl font-bold text-white mb-2">Total</h3>
              <p class="text-3xl font-bold text-purple-400">29</p>
            </div>
            <div
              class="glass-card rounded-2xl p-6 text-center transform hover:scale-105 transition duration-300"
            >
              <i class="fas fa-venus text-4xl text-pink-400 mb-4"></i>
              <h3 class="text-xl font-bold text-white mb-2">Perempuan</h3>
              <p class="text-3xl font-bold text-pink-400">22</p>
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
                <div
                  class="gallery-item shrink-0 w-full md:w-1/3 lg:w-1/3"
                >
                  <div
                    class="glass-card rounded-xl overflow-hidden transition-all duration-300"
                  >
                    <img
                      src="https://placehold.co/400x300/8B5CF6/ffffff?text=Image+1"
                      alt="Gallery 1"
                      class="w-full h-48 object-cover"
                    />
                    <div class="p-4">
                      <h3 class="font-semibold text-white">Gallery Image 1</h3>
                    </div>
                  </div>
                </div>
                <div
                  class="gallery-item shrink-0 w-full md:w-1/3 lg:w-1/3"
                >
                  <div
                    class="glass-card rounded-xl overflow-hidden transition-all duration-300"
                  >
                    <img
                      src="https://placehold.co/400x300/EC4899/ffffff?text=Image+2"
                      alt="Gallery 2"
                      class="w-full h-48 object-cover"
                    />
                    <div class="p-4">
                      <h3 class="font-semibold text-white">Gallery Image 2</h3>
                    </div>
                  </div>
                </div>
                <div
                  class="gallery-item shrink-0 w-full md:w-1/3 lg:w-1/3"
                >
                  <div
                    class="glass-card rounded-xl overflow-hidden transition-all duration-300"
                  >
                    <img
                      src="https://placehold.co/400x300/06B6D4/ffffff?text=Image+3"
                      alt="Gallery 3"
                      class="w-full h-48 object-cover"
                    />
                    <div class="p-4">
                      <h3 class="font-semibold text-white">Gallery Image 3</h3>
                    </div>
                  </div>
                </div>
                <div
                  class="gallery-item shrink-0 w-full md:w-1/3 lg:w-1/3"
                >
                  <div
                    class="glass-card rounded-xl overflow-hidden transition-all duration-300"
                  >
                    <img
                      src="https://placehold.co/400x300/10B981/ffffff?text=Image+4"
                      alt="Gallery 4"
                      class="w-full h-48 object-cover"
                    />
                    <div class="p-4">
                      <h3 class="font-semibold text-white">Gallery Image 4</h3>
                    </div>
                  </div>
                </div>
                <div
                  class="gallery-item shrink-0 w-full md:w-1/3 lg:w-1/3"
                >
                  <div
                    class="glass-card rounded-xl overflow-hidden transition-all duration-300"
                  >
                    <img
                      src="https://placehold.co/400x300/F59E0B/ffffff?text=Image+5"
                      alt="Gallery 5"
                      class="w-full h-48 object-cover"
                    />
                    <div class="p-4">
                      <h3 class="font-semibold text-white">Gallery Image 5</h3>
                    </div>
                  </div>
                </div>
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
        <div class="max-w-7xl mx-auto">
          <h2 class="text-3xl font-bold text-center mb-12 text-white">
            Our Teachers
          </h2>

          <div class="grid grid-cols-2 gap-8 max-w-2xl mx-auto">
            <div
              class="card-container relative group rounded-xl overflow-hidden transition-transform duration-300 hover:scale-105"
            >
              <img
                src="https://placehold.co/300x300/8B5CF6/ffffff?text=Teacher"
                alt="Teacher 1"
                class="w-full aspect-square object-cover transition-all duration-300"
              />
              <div
                class="card-hover-overlay absolute inset-0 flex flex-col justify-end p-6 liquid-glass-overlay"
              >
                <h3 class="text-xl font-bold text-white mb-2">John Doe</h3>
                <p class="text-gray-200">Computer Science Teacher</p>
                <div class="flex space-x-4 mt-4">
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-github"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-linkedin"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-twitter"></i
                  ></a>
                </div>
              </div>
            </div>

            <div
              class="card-container relative group rounded-xl overflow-hidden transition-transform duration-300 hover:scale-105"
            >
              <img
                src="https://placehold.co/300x300/EC4899/ffffff?text=Teacher"
                alt="Teacher 2"
                class="w-full aspect-square object-cover transition-all duration-300"
              />
              <div
                class="card-hover-overlay absolute inset-0 flex flex-col justify-end p-6 liquid-glass-overlay"
              >
                <h3 class="text-xl font-bold text-white mb-2">Jane Smith</h3>
                <p class="text-gray-200">Mathematics Teacher</p>
                <div class="flex space-x-4 mt-4">
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-github"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-linkedin"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-twitter"></i
                  ></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section id="anggota" class="py-16 px-4">
        <div class="max-w-7xl mx-auto">
          <h2 class="text-3xl font-bold text-center mb-12 text-white">
            Our Members
          </h2>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div
              class="card-container relative group rounded-xl overflow-hidden transition-transform duration-300 hover:scale-105"
            >
              <img
                src="https://placehold.co/300x300/8B5CF6/ffffff?text=Member"
                alt="Member 1"
                class="w-full aspect-square object-cover transition-all duration-300"
              />
              <div
                class="card-hover-overlay absolute inset-0 flex flex-col justify-end p-6 liquid-glass-overlay"
              >
                <h3 class="text-xl font-bold text-white mb-2">John Doe</h3>
                <p class="text-gray-200">Frontend Developer</p>
                <div class="flex space-x-4 mt-4">
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-github"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-linkedin"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-twitter"></i
                  ></a>
                </div>
              </div>
            </div>

            <div
              class="card-container relative group rounded-xl overflow-hidden transition-transform duration-300 hover:scale-105"
            >
              <img
                src="https://placehold.co/300x300/EC4899/ffffff?text=Member"
                alt="Member 2"
                class="w-full aspect-square object-cover transition-all duration-300"
              />
              <div
                class="card-hover-overlay absolute inset-0 flex flex-col justify-end p-6 liquid-glass-overlay"
              >
                <h3 class="text-xl font-bold text-white mb-2">Jane Smith</h3>
                <p class="text-gray-200">Backend Developer</p>
                <div class="flex space-x-4 mt-4">
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-github"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-linkedin"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-twitter"></i
                  ></a>
                </div>
              </div>
            </div>

            <div
              class="card-container relative group rounded-xl overflow-hidden transition-transform duration-300 hover:scale-105"
            >
              <img
                src="https://placehold.co/300x300/06B6D4/ffffff?text=Member"
                alt="Member 3"
                class="w-full aspect-square object-cover transition-all duration-300"
              />
              <div
                class="card-hover-overlay absolute inset-0 flex flex-col justify-end p-6 liquid-glass-overlay"
              >
                <h3 class="text-xl font-bold text-white mb-2">
                  Robert Johnson
                </h3>
                <p class="text-gray-200">UI/UX Designer</p>
                <div class="flex space-x-4 mt-4">
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-github"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-linkedin"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-twitter"></i
                  ></a>
                </div>
              </div>
            </div>

            <div
              class="card-container relative group rounded-xl overflow-hidden transition-transform duration-300 hover:scale-105"
            >
              <img
                src="https://placehold.co/300x300/10B981/ffffff?text=Member"
                alt="Member 4"
                class="w-full aspect-square object-cover transition-all duration-300"
              />
              <div
                class="card-hover-overlay absolute inset-0 flex flex-col justify-end p-6 liquid-glass-overlay"
              >
                <h3 class="text-xl font-bold text-white mb-2">Emily Davis</h3>
                <p class="text-gray-200">Project Manager</p>
                <div class="flex space-x-4 mt-4">
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-github"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-linkedin"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-twitter"></i
                  ></a>
                </div>
              </div>
            </div>

            <div
              class="card-container relative group rounded-xl overflow-hidden transition-transform duration-300 hover:scale-105"
            >
              <img
                src="https://placehold.co/300x300/F59E0B/ffffff?text=Member"
                alt="Member 5"
                class="w-full aspect-square object-cover transition-all duration-300"
              />
              <div
                class="card-hover-overlay absolute inset-0 flex flex-col justify-end p-6 liquid-glass-overlay"
              >
                <h3 class="text-xl font-bold text-white mb-2">Michael Brown</h3>
                <p class="text-gray-200">DevOps Engineer</p>
                <div class="flex space-x-4 mt-4">
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-github"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-linkedin"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-twitter"></i
                  ></a>
                </div>
              </div>
            </div>

            <div
              class="card-container relative group rounded-xl overflow-hidden transition-transform duration-300 hover:scale-105"
            >
              <img
                src="https://placehold.co/300x300/EF4444/ffffff?text=Member"
                alt="Member 6"
                class="w-full aspect-square object-cover transition-all duration-300"
              />
              <div
                class="card-hover-overlay absolute inset-0 flex flex-col justify-end p-6 liquid-glass-overlay"
              >
                <h3 class="text-xl font-bold text-white mb-2">Sarah Wilson</h3>
                <p class="text-gray-200">QA Engineer</p>
                <div class="flex space-x-4 mt-4">
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-github"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-linkedin"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-twitter"></i
                  ></a>
                </div>
              </div>
            </div>

            <div
              class="card-container relative group rounded-xl overflow-hidden transition-transform duration-300 hover:scale-105"
            >
              <img
                src="https://placehold.co/300x300/EF4444/ffffff?text=Member"
                alt="Member 7"
                class="w-full aspect-square object-cover transition-all duration-300"
              />
              <div
                class="card-hover-overlay absolute inset-0 flex flex-col justify-end p-6 liquid-glass-overlay"
              >
                <h3 class="text-xl font-bold text-white mb-2">David Miller</h3>
                <p class="text-gray-200">Data Scientist</p>
                <div class="flex space-x-4 mt-4">
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-github"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-linkedin"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-twitter"></i
                  ></a>
                </div>
              </div>
            </div>

            <div
              class="card-container relative group rounded-xl overflow-hidden transition-transform duration-300 hover:scale-105"
            >
              <img
                src="https://placehold.co/300x300/8B5CF6/ffffff?text=Member"
                alt="Member 8"
                class="w-full aspect-square object-cover transition-all duration-300"
              />
              <div
                class="card-hover-overlay absolute inset-0 flex flex-col justify-end p-6 liquid-glass-overlay"
              >
                <h3 class="text-xl font-bold text-white mb-2">Lisa Taylor</h3>
                <p class="text-gray-200">Product Manager</p>
                <div class="flex space-x-4 mt-4">
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-github"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-linkedin"></i
                  ></a>
                  <a href="#" class="text-white hover:text-gray-300"
                    ><i class="fab fa-twitter"></i
                  ></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection
