@extends('members.layouts.master')

@section('content')
<div class="min-h-screen bg-gray-900">
  <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-3xl font-bold text-white mb-8 md:mt-12 ">Gallery</h2>

    <div class="flex flex-wrap gap-3 items-center mb-8 sticky top-0 bg-gray-900/95 backdrop-blur-sm z-10 py-4 -mx-4 px-4">
      <select id="filter-year" class="px-4 py-2.5 bg-gray-800 text-white rounded-xl border border-gray-700 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
        <option value="">All Years</option>
        @foreach($years as $y)
          <option value="{{ $y }}">{{ $y }}</option>
        @endforeach
      </select>

      <input id="filter-event" type="text" placeholder="Search event..." 
             class="px-4 py-2.5 bg-gray-800 text-white rounded-xl border border-gray-700 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all flex-1 min-w-[200px]" />

      <button id="filter-clear" class="px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl font-medium transition-all hover:scale-105">
        Clear Filters
      </button>
    </div>

    <div id="masonry-grid" class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 xl:columns-5 2xl:columns-6 gap-4 space-y-4">
      @foreach($galleries as $gallery)
        <article class="masonry-card break-inside-avoid mb-4 group cursor-pointer"
                 data-id="{{ $gallery->id }}"
                 data-year="{{ $gallery->date ? \Carbon\Carbon::parse($gallery->date)->format('Y') : '-' }}"
                 data-event="{{ e($gallery->event) }}">
          <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300">
            
            <div class="relative overflow-hidden">
              <img
                src="{{ $gallery->image ? asset('img_item_upload/' . $gallery->image) : 'https://placehold.co/600x800/1f2937/ffffff?text=No+Image' }}"
                alt="{{ e($gallery->event) }}"
                class="w-full h-auto object-cover block transition-transform duration-500 group-hover:scale-105"
                loading="lazy"
              />

              <div class="absolute inset-0 bg-linear-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                
                <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                  <button onclick="downloadImageQuick('{{ $gallery->image ? asset('img_item_upload/' . $gallery->image) : 'https://placehold.co/600x800/1f2937/ffffff?text=No+Image' }}', '{{ e($gallery->event) }}')" 
                          aria-label="Save" 
                          class="bg-[#60a5fa] hover:bg-blue-600 text-white rounded-full px-5 py-2 text-sm font-semibold shadow-xl transition-all duration-200 hover:scale-110 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Save
                  </button>
                </div>

                <div class="absolute bottom-3 right-3 flex gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                  <button onclick="shareImageQuick('{{ $gallery->image ? asset('img_item_upload/' . $gallery->image) : 'https://placehold.co/600x800/1f2937/ffffff?text=No+Image' }}', '{{ e($gallery->event) }}')" 
                          aria-label="Share" 
                          title="Share"
                          class="bg-white/95 hover:bg-white text-gray-800 rounded-full p-2.5 shadow-lg transition-all duration-200 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                  </button>
                  <button onclick="copyImageLink('{{ $gallery->image ? asset('img_item_upload/' . $gallery->image) : 'https://placehold.co/600x800/1f2937/ffffff?text=No+Image' }}')" 
                          aria-label="Copy Link" 
                          title="Copy Link"
                          class="bg-white/95 hover:bg-white text-gray-800 rounded-full p-2.5 shadow-lg transition-all duration-200 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                  </button>
                </div>

                <div class="absolute bottom-3 left-3 opacity-0 group-hover:opacity-100 transition-all duration-300">
                  <button type="button" 
                          onclick="openModal('{{ $gallery->image ? asset('img_item_upload/' . $gallery->image) : 'https://placehold.co/600x800/1f2937/ffffff?text=No+Image' }}', '{{ e($gallery->event) }}')"
                          class="inline-flex items-center gap-1.5 bg-white/95 hover:bg-white text-gray-800 rounded-full px-3 py-1.5 text-xs font-semibold shadow-lg transition-all duration-200 hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    View
                  </button>
                </div>
              </div>
            </div>

            <div class="p-4">
              <h3 class="text-gray-900 dark:text-white font-semibold text-base leading-snug mb-2 line-clamp-2 group-hover:underline">
                {{ ucwords(e($gallery->event)) }}
              </h3>
              
              <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                <span class="font-medium">{{ $gallery->date ? \Carbon\Carbon::parse($gallery->date)->format('M d, Y') : '-' }}</span>
                <span class="flex items-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  {{ $gallery->date ? \Carbon\Carbon::parse($gallery->date)->format('Y') : '-' }}
                </span>
              </div>
            </div>
          </div>
        </article>
      @endforeach
    </div>

    <div id="masonry-loading" class="mt-8 text-center hidden">
      <svg class="animate-spin h-10 w-10 text-red-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
      </svg>
      <p class="text-sm text-gray-400 mt-3 font-medium">Loading more...</p>
    </div>

    <div id="masonry-sentinel" class="h-20"></div>
  </div>
</div>

<div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 sm:p-6 lg:p-8">
  <div class="absolute inset-0 bg-black/80 backdrop-blur-md transition-opacity duration-300 opacity-0" 
       id="modalBackdrop"
       onclick="closeModal()"></div>
  
  <div class="relative z-10 w-full max-w-6xl max-h-[90vh] transform transition-all duration-300 scale-95 opacity-0" 
       id="modalContent">
    
    <button onclick="closeModal()" 
            class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors duration-200 group">
      <div class="flex items-center gap-2 bg-white/10 hover:bg-white/20 rounded-full px-4 py-2 backdrop-blur-sm">
        <span class="text-sm font-medium">Close</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </div>
    </button>

    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden">
      <div class="relative">
        <img id="modalImage" 
             src="" 
             alt="" 
             class="w-full h-auto max-h-[80vh] object-contain"
             onclick="event.stopPropagation()" />
        
        <div class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-black/80 to-transparent p-6">
          <h3 id="modalTitle" class="text-white text-xl font-bold drop-shadow-lg"></h3>
        </div>
      </div>
      
      <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
        <div class="flex gap-2">
          <button onclick="downloadImage()" 
                  class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-all duration-200 hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            Download
          </button>
          
          <button onclick="shareImage()" 
                  class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-200 hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
            </svg>
            Share
          </button>
        </div>
        
        <button onclick="closeModal()" 
                class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white font-medium transition-colors duration-200">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>

<style>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

html {
  scroll-behavior: smooth;
}

.masonry-card {
  page-break-inside: avoid;
  break-inside: avoid;
  -webkit-column-break-inside: avoid;
}
</style>

<script>
function showToast(message, type = 'success') {
  const toast = document.createElement('div');
  toast.className = `fixed top-4 right-4 z-[60] px-6 py-3 rounded-lg shadow-2xl transform transition-all duration-300 translate-x-0 ${
    type === 'success' ? 'bg-green-600' : type === 'error' ? 'bg-red-600' : 'bg-blue-600'
  } text-white font-medium flex items-center gap-2`;
  
  const icon = type === 'success' 
    ? '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>'
    : type === 'error'
    ? '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>'
    : '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
  
  toast.innerHTML = icon + `<span>${message}</span>`;
  document.body.appendChild(toast);
  
  setTimeout(() => toast.classList.add('translate-x-full', 'opacity-0'), 3000);
  setTimeout(() => toast.remove(), 3500);
}

async function downloadImageQuick(imageUrl, title) {
  try {
    showToast('Downloading image...', 'info');
    
    const response = await fetch(imageUrl);
    const blob = await response.blob();
    const url = window.URL.createObjectURL(blob);
    
    const link = document.createElement('a');
    link.href = url;
    link.download = sanitizeFilename(title) + '.jpg';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    window.URL.revokeObjectURL(url);
    
    showToast('Image downloaded successfully!', 'success');
  } catch (error) {
    console.error('Download error:', error);
    showToast('Failed to download image', 'error');
  }
}

async function shareImageQuick(imageUrl, title) {
  if (navigator.share) {
    try {
      await navigator.share({
        title: title,
        text: `Check out this image: ${title}`,
        url: imageUrl
      });
      showToast('Shared successfully!', 'success');
    } catch (error) {
      if (error.name !== 'AbortError') {
        console.error('Share error:', error);
        // Fallback ke copy link
        copyImageLink(imageUrl);
      }
    }
  } else {
    copyImageLink(imageUrl);
  }
}

function copyImageLink(imageUrl) {
  navigator.clipboard.writeText(imageUrl).then(() => {
    showToast('Image link copied to clipboard!', 'success');
  }).catch(err => {
    console.error('Copy error:', err);
    showToast('Failed to copy link', 'error');
  });
}

function sanitizeFilename(filename) {
  return filename.replace(/[^a-z0-9]/gi, '_').toLowerCase();
}

let currentImageSrc = '';
let currentImageTitle = '';

function openModal(imageSrc, title) {
  const modal = document.getElementById('imageModal');
  const modalImage = document.getElementById('modalImage');
  const modalTitle = document.getElementById('modalTitle');
  const modalBackdrop = document.getElementById('modalBackdrop');
  const modalContent = document.getElementById('modalContent');
  
  currentImageSrc = imageSrc;
  currentImageTitle = title;
  
  modalImage.src = imageSrc;
  modalImage.alt = title;
  modalTitle.textContent = title;
  
  modal.classList.remove('hidden');
  modal.classList.add('flex');
  document.body.style.overflow = 'hidden';
  
  setTimeout(() => {
    modalBackdrop.classList.remove('opacity-0');
    modalBackdrop.classList.add('opacity-100');
    modalContent.classList.remove('scale-95', 'opacity-0');
    modalContent.classList.add('scale-100', 'opacity-100');
  }, 10);
}

function closeModal() {
  const modal = document.getElementById('imageModal');
  const modalBackdrop = document.getElementById('modalBackdrop');
  const modalContent = document.getElementById('modalContent');
  
  modalBackdrop.classList.remove('opacity-100');
  modalBackdrop.classList.add('opacity-0');
  modalContent.classList.remove('scale-100', 'opacity-100');
  modalContent.classList.add('scale-95', 'opacity-0');
  
  setTimeout(() => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
  }, 300);
}

async function downloadImage() {
  try {
    showToast('Downloading image...', 'info');
    
    const response = await fetch(currentImageSrc);
    const blob = await response.blob();
    const url = window.URL.createObjectURL(blob);
    
    const link = document.createElement('a');
    link.href = url;
    link.download = sanitizeFilename(currentImageTitle) + '.jpg';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    window.URL.revokeObjectURL(url);
    
    showToast('Image downloaded successfully!', 'success');
  } catch (error) {
    console.error('Download error:', error);
    showToast('Failed to download image', 'error');
  }
}

async function shareImage() {
  if (navigator.share) {
    try {
      await navigator.share({
        title: currentImageTitle,
        text: `Check out this image: ${currentImageTitle}`,
        url: currentImageSrc
      });
      showToast('Shared successfully!', 'success');
    } catch (error) {
      if (error.name !== 'AbortError') {
        console.error('Share error:', error);
        copyImageLink(currentImageSrc);
      }
    }
  } else {
    navigator.clipboard.writeText(currentImageSrc).then(() => {
      showToast('Image link copied to clipboard!', 'success');
    }).catch(err => {
      console.error('Copy error:', err);
      showToast('Failed to copy link', 'error');
    });
  }
}

document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    closeModal();
  }
});

document.addEventListener('DOMContentLoaded', () => {
  const grid = document.getElementById('masonry-grid');
  const sentinel = document.getElementById('masonry-sentinel');
  const loading = document.getElementById('masonry-loading');
  const filterYear = document.getElementById('filter-year');
  const filterEvent = document.getElementById('filter-event');
  const filterClear = document.getElementById('filter-clear');

  let page = {{ $galleries->currentPage() }};
  let lastPage = {{ $galleries->lastPage() }};
  let loadingInProgress = false;

  function createCard(item) {
    const article = document.createElement('article');
    article.className = 'masonry-card break-inside-avoid mb-4 group cursor-pointer';
    article.setAttribute('data-id', item.id);
    article.setAttribute('data-year', item.year);
    article.setAttribute('data-event', item.event);
    
    const imgSrc = item.image || 'https://placehold.co/600x800/1f2937/ffffff?text=No+Image';
    const eventText = escapeHtml(item.event);
    const dateFormatted = new Date(item.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    
    article.innerHTML = `
      <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300">
        <div class="relative overflow-hidden">
          <img src="${imgSrc}" alt="${eventText}" 
               class="w-full h-auto object-cover block transition-transform duration-500 group-hover:scale-105" 
               loading="lazy" />
          
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
              <button onclick="downloadImageQuick('${imgSrc}', '${eventText}')" 
                      aria-label="Save" 
                      class="bg-red-600 hover:bg-red-700 text-white rounded-full px-5 py-2 text-sm font-semibold shadow-xl transition-all duration-200 hover:scale-110 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Save
              </button>
            </div>
            
            <div class="absolute bottom-3 right-3 flex gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
              <button onclick="shareImageQuick('${imgSrc}', '${eventText}')" 
                      aria-label="Share" 
                      title="Share"
                      class="bg-white/95 hover:bg-white text-gray-800 rounded-full p-2.5 shadow-lg transition-all duration-200 hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                </svg>
              </button>
              <button onclick="copyImageLink('${imgSrc}')" 
                      aria-label="Copy Link" 
                      title="Copy Link"
                      class="bg-white/95 hover:bg-white text-gray-800 rounded-full p-2.5 shadow-lg transition-all duration-200 hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
              </button>
            </div>
            
            <div class="absolute bottom-3 left-3 opacity-0 group-hover:opacity-100 transition-all duration-300">
              <a href="#" class="inline-flex items-center gap-1.5 bg-white/95 hover:bg-white text-gray-800 rounded-full px-3 py-1.5 text-xs font-semibold shadow-lg transition-all duration-200 hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
                View
              </a>
            </div>
          </div>
        </div>
        
        <div class="p-4">
          <h3 class="text-gray-900 dark:text-white font-semibold text-base leading-snug mb-2 line-clamp-2 group-hover:underline">
            ${eventText}
          </h3>
          <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
            <span class="font-medium">${dateFormatted}</span>
            <span class="flex items-center gap-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              ${item.year}
            </span>
          </div>
        </div>
      </div>
    `;
    return article;
  }

  function escapeHtml(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
  }

  function appendItems(items) {
    if (!items || !items.length) return;
    
    const fragment = document.createDocumentFragment();
    items.forEach(item => {
      fragment.appendChild(createCard(item));
    });
    
    grid.appendChild(fragment);
  }

  async function fetchNext() {
    if (loadingInProgress || page >= lastPage) return;

    loadingInProgress = true;
    loading.classList.remove('hidden');

    try {
      const nextPage = page + 1;
      const url = new URL("{{ route('gallery.data') }}", window.location.origin);
      url.searchParams.set('page', nextPage);

      const yearVal = filterYear.value.trim();
      const eventVal = filterEvent.value.trim();
      if (yearVal) url.searchParams.set('year', yearVal);
      if (eventVal) url.searchParams.set('event', eventVal);

      const res = await fetch(url.toString(), { 
        headers: { 'Accept': 'application/json' }
      });
      
      if (!res.ok) throw new Error('Failed to fetch');

      const json = await res.json();
      appendItems(json.data || []);

      page = json.current_page || nextPage;
      lastPage = json.last_page || lastPage;

      if (page >= lastPage) observer.disconnect();
    } catch (err) {
      console.error('Gallery load error:', err);
    } finally {
      loadingInProgress = false;
      loading.classList.add('hidden');
    }
  }

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) fetchNext();
    });
  }, { 
    root: null, 
    rootMargin: '0px 0px 400px 0px', 
    threshold: 0.01 
  });

  if (page < lastPage) observer.observe(sentinel);

  async function applyFilters() {
    observer.disconnect();
    page = 0;
    lastPage = 9999;
    
    grid.innerHTML = '';

    loading.classList.remove('hidden');
    loadingInProgress = true;

    try {
      const url = new URL("{{ route('gallery.data') }}", window.location.origin);
      url.searchParams.set('page', 1);
      
      const yearVal = filterYear.value.trim();
      const eventVal = filterEvent.value.trim();
      if (yearVal) url.searchParams.set('year', yearVal);
      if (eventVal) url.searchParams.set('event', eventVal);

      const res = await fetch(url.toString(), { 
        headers: { 'Accept': 'application/json' }
      });
      
      if (!res.ok) throw new Error('Failed to fetch');

      const json = await res.json();
      appendItems(json.data || []);

      page = json.current_page || 1;
      lastPage = json.last_page || 1;

      if (page < lastPage) observer.observe(sentinel);
    } catch (err) {
      console.error('Filter error:', err);
    } finally {
      loadingInProgress = false;
      loading.classList.add('hidden');
    }
  }

  filterYear.addEventListener('change', applyFilters);
  filterEvent.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') applyFilters();
  });
  filterClear.addEventListener('click', () => {
    filterYear.value = '';
    filterEvent.value = '';
    applyFilters();
  });
});
</script>
@endsection