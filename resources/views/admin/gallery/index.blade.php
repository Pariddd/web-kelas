@extends('admin.layouts.master')
@section('title', 'Gallery')
@section('content')
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-[#1e293b] shadow-sm pl-6 p-3.5">
      <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-100">
          Gallery Management
        </h2>
        <form id="filter-form" method="GET" class="flex items-center space-x-3">
          <input type="hidden" name="sort_by" id="sort_by" value="{{ $sortBy ?? 'created_at' }}">
          <input type="hidden" name="sort_dir" id="sort_dir" value="{{ $sortDir ?? 'desc' }}">
          <div class="relative">
            <input
              type="text"
              name="q"
              id="search-input"
              value="{{ $q ?? '' }}"
              placeholder="Search by title or event..."
              class="bg-[#334155] rounded-lg px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-100"
            />
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
          </div>

          <div>
            <select name="event" id="search-event" class="bg-[#334155] border border-[#334155] rounded-lg px-4 py-2 text-gray-100">
              <option value="">All Events</option>
              @foreach($eventsList as $ev)
                <option value="{{ $ev }}" {{ ($ev === $event) ? 'selected' : '' }}>{{ $ev }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <select name="per_page" id="items-per-page" class="bg-[#334155] border border-[#334155] rounded-lg px-4 py-2 text-gray-100">
              <option value="5" {{ (int)($perPage ?? 10) === 5 ? 'selected' : '' }}>5</option>
              <option value="10" {{ (int)($perPage ?? 10) === 10 ? 'selected' : '' }}>10</option>
              <option value="20" {{ (int)($perPage ?? 10) === 20 ? 'selected' : '' }}>20</option>
            </select>
          </div>

          <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg">Apply</button>
          </div>
        </form>
      </div>
    </header>
    <main class="flex-1 overflow-y-auto p-6">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <a href="{{ route('gallery.index') }}" class="block group">
          <div class="p-4 bg-[#1e293b] rounded-lg shadow hover:shadow-md transition flex items-center space-x-4 border border-[#334155]">
            <div class="p-3 bg-[#334155] rounded-full">
              <i class="fas fa-images text-2xl text-blue-300"></i>
            </div>
            <div>
              <p class="text-sm text-gray-300">Galleries</p>
              <p class="text-2xl font-semibold text-gray-100">{{ $galleryCount ?? 0 }}</p>
              <p class="text-xs text-gray-400">View all galleries</p>
            </div>
            <div class="ml-auto opacity-0 group-hover:opacity-100 transition">
              <i class="fas fa-arrow-right text-gray-400"></i>
            </div>
          </div>
        </a>
        <a href="#" class="block group">
          <div class="p-4 bg-[#1e293b] rounded-lg shadow hover:shadow-md transition flex items-center space-x-4 border border-[#334155]">
            <div class="p-3 bg-[#334155] rounded-full">
              <i class="fas fa-users text-2xl text-green-300"></i>
            </div>
            <div>
              <p class="text-sm text-gray-300">Members</p>
              <p class="text-2xl font-semibold text-gray-100">{{ $memberCount ?? 0 }}</p>
              <p class="text-xs text-gray-400">Manage members</p>
            </div>
            <div class="ml-auto opacity-0 group-hover:opacity-100 transition">
              <i class="fas fa-arrow-right text-gray-400"></i>
            </div>
          </div>
        </a>
      </div>
      <div class="mb-6 flex justify-between items-center">
        <div class="flex space-x-4">
        </div>
        <a href="{{ route('gallery.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-plus mr-2"></i> Create Data
        </a>
      </div>
      <div class="bg-[#1e293b] rounded-lg shadow overflow-hidden border border-[#334155]">
        <table class="min-w-full divide-y divide-[#334155]">
          <thead class="bg-[#334155]">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">No</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Image</th>

              {{-- Title sortable --}}
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                <button type="button" id="th-title" class="flex items-center">
                  Title
                  <span class="ml-2 text-gray-400">
                    @if($sortBy === 'title')
                      @if($sortDir === 'asc')
                        <i class="fas fa-sort-up"></i>
                      @else
                        <i class="fas fa-sort-down"></i>
                      @endif
                    @else
                      <i class="fas fa-sort"></i>
                    @endif
                  </span>
                </button>
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                <button type="button" id="th-event" class="flex items-center">
                  Event
                  <span class="ml-2 text-gray-400">
                    @if($sortBy === 'event')
                      @if($sortDir === 'asc')
                        <i class="fas fa-sort-up"></i>
                      @else
                        <i class="fas fa-sort-down"></i>
                      @endif
                    @else
                      <i class="fas fa-sort"></i>
                    @endif
                  </span>
                </button>
              </th>

              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>

          <tbody id="table-body" class="divide-y divide-[#334155]">
            @forelse($galleries as $g)
              <tr class="hover:bg-[#334155]">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $galleries->firstItem() + $loop->index }}</td>

                <td class="px-6 py-4 whitespace-nowrap">
                  <img src="{{ asset('img_item_upload/' . $g->image) }}" alt="{{ $g->title }}" class="w-16 h-16 object-cover rounded">
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-100">{{ $g->title }}</td>

                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $g->event ?? '-' }}</td>

                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-3">
                    <a href="{{ route('gallery.edit', $g->id) }}" class="flex items-center px-3 py-1 rounded-lg bg-[#334155] text-green-300 hover:bg-[#475569] transition">
                      <i class="fas fa-edit mr-1"></i><span>Edit</span>
                    </a>
                    <button type="button"
                            data-id="{{ $g->id }}"
                            data-title="{{ e($g->title) }}"
                            class="delete-btn flex items-center px-3 py-1 rounded-lg bg-[#334155] text-red-300 hover:bg-[#475569] transition">
                      <i class="fas fa-trash mr-1"></i><span>Delete</span>
                    </button>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-400">No records found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div id="delete-modal"
      class="fixed inset-0 bg-black bg-opacity-60 hidden z-50 items-center justify-center"
      role="dialog"
      aria-modal="true"
      aria-hidden="true"
      aria-labelledby="modal-title"
      aria-describedby="modal-desc">
      <!-- panel wrapper (animated) -->
        <div id="delete-modal-panel"
        class="bg-dark-800 rounded-lg p-6 transform opacity-0 scale-95 transition duration-200"
        role="document">
          <div class="bg-[#1e293b] rounded-lg shadow-xl w-full max-w-lg p-6 border border-[#334155]">
            <div class="flex justify-between items-center mb-4">
              <h3 id="modal-title" class="text-lg font-semibold text-gray-100">Confirm Delete</h3>
              <button id="close-modal" class="text-gray-400 hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-accent-500 rounded">
                <i class="fas fa-times" aria-hidden="true"></i>
                <span class="sr-only">Close dialog</span>
              </button>
            </div>
            <p id="modal-desc" class="text-gray-300 mb-6">
              Are you sure you want to delete "<span id="modal-item-title" class="font-semibold text-gray-100"></span>"? This action cannot be undone.
            </p>
            <div class="flex justify-end space-x-3">
              <button id="cancel-delete" class="px-4 py-2 bg-[#334155] text-gray-200 rounded-md hover:bg-[#475569] focus:outline-none focus:ring-2 focus:ring-accent-500">Cancel</button>

              <form id="delete-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>



      <div class="mt-4 flex flex-col md:flex-row md:justify-between md:items-center space-y-2 md:space-y-0">
        <div class="text-sm text-gray-300">
          Showing <strong class="text-gray-100">{{ $galleries->firstItem() ?? 0 }}</strong> to <strong class="text-gray-100">{{ $galleries->lastItem() ?? 0 }}</strong> of <strong class="text-gray-100">{{ $galleries->total() }}</strong> entries
        </div>

        <div>
          {{ $galleries->appends(request()->except('page'))->links() }}
        </div>
      </div>
    </main>
  </div>
@endsection
@section('script')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      (function(){
        const filterForm = document.getElementById('filter-form');
        const qInput = document.getElementById('search-input');
        const eventSelect = document.getElementById('search-event');
        const perPageSelect = document.getElementById('items-per-page');
        const thTitle = document.getElementById('th-title');
        const thEvent = document.getElementById('th-event');
        const sortByInput = document.getElementById('sort_by');
        const sortDirInput = document.getElementById('sort_dir');

        if (!filterForm) return;

        function debounce(fn, delay=400){
          let t;
          return function(...args){
            clearTimeout(t);
            t = setTimeout(()=> fn.apply(this, args), delay);
          };
        }

        if (qInput) {
          qInput.addEventListener('input', debounce(function(){
            filterForm.submit();
          }, 400));

          qInput.addEventListener('keydown', function(e){
            if (e.key === 'Enter') {
              e.preventDefault();
              filterForm.submit();
            }
          });
        }

        if (eventSelect) {
          eventSelect.addEventListener('change', function(){
            filterForm.submit();
          });
        }

        if (perPageSelect) {
          perPageSelect.addEventListener('change', function(){
            filterForm.submit();
          });
        }

        function toggleSort(column) {
          const currentBy = "{{ $sortBy ?? 'created_at' }}";
          const currentDir = "{{ $sortDir ?? 'desc' }}";
          let nextDir = 'asc';
          if (currentBy === column) {
            nextDir = currentDir === 'asc' ? 'desc' : 'asc';
          }
          sortByInput.value = column;
          sortDirInput.value = nextDir;
          filterForm.submit();
        }

        if (thTitle) thTitle.addEventListener('click', ()=> toggleSort('title'));
        if (thEvent) thEvent.addEventListener('click', ()=> toggleSort('event'));
      })();

      (function(){
        // Elements
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const modal = document.getElementById('delete-modal');
        const panel = document.getElementById('delete-modal-panel');
        const closeBtn = document.getElementById('close-modal');
        const cancelBtn = document.getElementById('cancel-delete');
        const modalTitleEl = document.getElementById('modal-item-title');
        const deleteForm = document.getElementById('delete-form');

        if (!modal || !deleteForm) return;

        // Focusable selector for trap
        const FOCUSABLE = 'a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), [tabindex]:not([tabindex="-1"])';
        let lastFocusedElement = null;

        function openModal(id, title) {
          // set form action & title
          modalTitleEl && (modalTitleEl.textContent = title || 'this item');
          deleteForm.action = "{{ url('gallery') }}/" + id;

          // show modal (remove hidden add flex)
          modal.classList.remove('hidden');
          modal.classList.add('flex');
          modal.setAttribute('aria-hidden', 'false');

          // prevent background scroll
          document.documentElement.style.overflow = 'hidden';
          document.body.style.overflow = 'hidden';

          // animate panel in (ensure starting state)
          panel.classList.remove('opacity-100','scale-100');
          panel.classList.add('opacity-0','scale-95');
          // next frame => transition to visible
          requestAnimationFrame(() => {
            panel.classList.remove('opacity-0','scale-95');
            panel.classList.add('opacity-100','scale-100');
          });

          // trap focus
          lastFocusedElement = document.activeElement;
          trapFocus(panel);

          // set initial focus to close button or cancel
          (closeBtn || cancelBtn || deleteForm.querySelector('button[type="submit"]')).focus();
        }

        function closeModal() {
          // animate out
          panel.classList.remove('opacity-100','scale-100');
          panel.classList.add('opacity-0','scale-95');

          // restore scroll and hide after animation
          setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            modal.setAttribute('aria-hidden', 'true');
            document.documentElement.style.overflow = '';
            document.body.style.overflow = '';
            deleteForm.action = '';
            modalTitleEl && (modalTitleEl.textContent = '');
            // restore last focused element
            if (lastFocusedElement) lastFocusedElement.focus();
          }, 200); // match transition duration
          releaseFocusTrap();
        }

        // attach handlers
        deleteButtons.forEach(btn => {
          btn.addEventListener('click', function(e){
            e.preventDefault();
            const id = this.dataset.id;
            const title = this.dataset.title || 'this item';
            if (!id) return console.warn('delete button missing data-id');
            openModal(id, title);
          });
        });

        closeBtn && closeBtn.addEventListener('click', closeModal);
        cancelBtn && cancelBtn.addEventListener('click', function(e){ e.preventDefault(); closeModal(); });

        // close on overlay click (only if click outside panel)
        modal.addEventListener('click', function(e){
          if (e.target === modal) closeModal();
        });

        // esc to close
        document.addEventListener('keydown', function(e){
          if (e.key === 'Escape' && modal.classList.contains('flex')) {
            closeModal();
          }
        });

        // --- focus trap implementation ---
        let previouslyFocused = null;
        let focusableElements = [];
        let firstFocusable = null;
        let lastFocusable = null;
        function trapFocus(container) {
          focusableElements = Array.from(container.querySelectorAll(FOCUSABLE)).filter(el => el.offsetParent !== null);
          if (focusableElements.length > 0) {
            firstFocusable = focusableElements[0];
            lastFocusable = focusableElements[focusableElements.length - 1];
          }
          previouslyFocused = document.activeElement;
          document.addEventListener('keydown', handleTab);
        }

        function releaseFocusTrap() {
          document.removeEventListener('keydown', handleTab);
          focusableElements = [];
          firstFocusable = lastFocusable = null;
        }

        function handleTab(e) {
          if (e.key !== 'Tab') return;
          if (!firstFocusable) {
            e.preventDefault();
            return;
          }
          if (e.shiftKey) { // shift + tab
            if (document.activeElement === firstFocusable) {
              e.preventDefault();
              lastFocusable.focus();
            }
          } else { // tab
            if (document.activeElement === lastFocusable) {
              e.preventDefault();
              firstFocusable.focus();
            }
          }
        }

      })();
    });
  </script>
@endsection
  