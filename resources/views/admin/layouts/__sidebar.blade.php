<aside class="w-64 bg-[#1e293b] text-white flex flex-col transition-colors duration-300">
  <div class="p-5 border-b border-[#334155]">
    <h1 class="text-xl font-bold">DASHBOARD MIPA II</h1>
  </div>
  <nav class="flex-1 p-4 overflow-y-auto">
    <ul class="space-y-2">
      <li>
        <a href="{{ route('galleries.index') }}"
          class="flex items-center p-3 rounded-lg
                  {{ request()->routeIs('galleries.*')
                      ? 'bg-[#334155] text-blue-300'
                      : 'text-gray-200 hover:bg-[#334155]' }}">
          <i class="fas fa-images mr-3"></i>
          <span>Gallery</span>
        </a>
      </li>
      <li>
        <a href="{{ route('member.index') }}"
          class="flex items-center p-3 rounded-lg
                  {{ request()->routeIs('member.*')
                      ? 'bg-[#334155] text-blue-300'
                      : 'text-gray-200 hover:bg-[#334155]' }}">
          <i class="fas fa-users mr-3"></i>
          <span>Members</span>
        </a>
      </li>
    </ul>
  </nav>
</aside>