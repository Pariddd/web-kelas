@extends('admin.layouts.master')
@section('title', 'Gallery - add ')
@section('content')
  <div class="container mx-auto px-4 py-8">
    <div class="mb-8">
      <a href="{{ route('galleries.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors">
        <i class="fas fa-arrow-left"></i>
        Back
      </a>
    </div>

    <div class="mb-4">
      <h1 class="text-3xl font-bold">Create Data</h1>
    </div>

    @if ($errors->any())
      <div class="mb-6 p-4 rounded-lg bg-red-800 border border-red-700 text-red-100">
        <strong class="block mb-2">Please fix the following:</strong>
        <ul class="list-disc pl-5 space-y-1">
          @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form id="create-form" action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 rounded-xl shadow-lg p-6">
      @csrf

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
          <label class="block text-sm font-medium mb-2 text-gray-300">Image Upload</label>

          <div id="dropZone" tabindex="0" class="relative border-2 border-dashed border-gray-600 rounded-lg p-8 text-center hover:border-blue-500 transition-colors bg-gray-700 min-h-64 flex flex-col items-center justify-center">
            <input type="file" id="fileInput" name="image" class="hidden" accept="image/*" />

            <div id="uploadContent" class="{{ old('image') ? 'hidden' : '' }} flex flex-col items-center">
              <i class="fas fa-cloud-upload-alt text-4xl mb-4 text-gray-400"></i>
              <p class="text-gray-300 mb-2">Drag & drop your image here</p>
              <p class="text-sm text-gray-400 mb-4">or</p>
              <button type="button" id="browseBtn" class="px-4 py-2 bg-gray-600 hover:bg-gray-500 rounded-lg transition-colors">Browse Files</button>
              <p class="text-xs text-gray-500 mt-2">PNG, JPG, JPEG, WEBP — max 2MB</p>
            </div>

            <div id="imagePreview" class="{{ old('image') ? '' : 'hidden' }} flex flex-col items-center">
              <img id="previewImg" class="max-h-48 max-w-full rounded-lg mb-4 object-cover" src="{{ old('image_preview') ?? '' }}" alt="Preview" />
              <p id="previewName" class="text-sm text-gray-300 mb-2"></p>
              <button type="button" id="removeImageBtn" class="flex items-center gap-1 px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm transition-colors">
                <i class="fas fa-times"></i>
                Remove
              </button>
            </div>
          </div>

          @error('image')
            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
          @enderror
        </div>

        <div class="space-y-6">
          <div>
            <label class="block text-sm font-medium mb-2 text-gray-300">Title</label>
            <input name="title" id="titleInput" type="text" value="{{ old('title') }}" required
              class="w-full px-4 py-3 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" placeholder="Enter title..." />
            @error('title') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
          </div>

          <div>
            <label class="block text-sm font-medium mb-2 text-gray-300">Event</label>
            <input name="event" id="eventInput" type="text" value="{{ old('event') }}"
              class="w-full px-4 py-3 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
              placeholder="Enter event (optional)"/>
            @error('event') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
          </div>

          <div class="flex flex-wrap gap-3 pt-4">
            <button id="submitBtn" type="submit" class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
              <i class="fas fa-save"></i>
              Submit
            </button>

            <button id="clearBtn" type="button" class="flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
              <i class="fas fa-rotate-left"></i>
              Clear
            </button>
          </div>
        </div>
      </div>
    </form>

    <p class="mt-6 text-xs text-gray-400">Tip: you can drag an image file from your file manager into the upload area.</p>
  </div>
@endsection
@section('script')
  <script>
    (function () {
      const fileInput = document.getElementById('fileInput');
      const dropZone = document.getElementById('dropZone');
      const browseBtn = document.getElementById('browseBtn');
      const uploadContent = document.getElementById('uploadContent');
      const imagePreview = document.getElementById('imagePreview');
      const previewImg = document.getElementById('previewImg');
      const previewName = document.getElementById('previewName');
      const removeImageBtn = document.getElementById('removeImageBtn');
      const createForm = document.getElementById('create-form');
      const submitBtn = document.getElementById('submitBtn');
      const clearBtn = document.getElementById('clearBtn');

      const maxSize = 2 * 1024 * 1024; 
      const acceptTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];

      browseBtn.addEventListener('click', () => fileInput.click());

      fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;
        if (!acceptTypes.includes(file.type)) {
          alert('Unsupported file type. Use JPG/PNG/WEBP.');
          fileInput.value = '';
          return;
        }
        if (file.size > maxSize) {
          alert('File too large (max 2MB).');
          fileInput.value = '';
          return;
        }
        showPreview(file);
      });

      ['dragenter','dragover','dragleave','drop'].forEach(evt =>
        dropZone.addEventListener(evt, preventDefaults, false)
      );

      function preventDefaults(e) { e.preventDefault(); e.stopPropagation(); }

      ['dragenter','dragover'].forEach(evt => dropZone.addEventListener(evt, () => dropZone.classList.add('border-blue-500','bg-blue-900/20')));
      ['dragleave','drop'].forEach(evt => dropZone.addEventListener(evt, () => dropZone.classList.remove('border-blue-500','bg-blue-900/20')));

      dropZone.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const file = dt.files && dt.files[0];
        if (!file) return;
        if (!acceptTypes.includes(file.type)) {
          alert('Unsupported file type. Use JPG/PNG/WEBP.');
          return;
        }
        if (file.size > maxSize) {
          alert('File too large (max 2MB).');
          return;
        }
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        fileInput.files = dataTransfer.files;
        showPreview(file);
      });

      function showPreview(file) {
        const reader = new FileReader();
        reader.onload = (ev) => {
          previewImg.src = ev.target.result;
          previewName.textContent = file.name + ' • ' + humanFileSize(file.size);
          uploadContent.classList.add('hidden');
          imagePreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      }

      function humanFileSize(bytes) {
        const thresh = 1024;
        if (Math.abs(bytes) < thresh) return bytes + ' B';
        const units = ['KB','MB','GB','TB'];
        let u = -1;
        do { bytes /= thresh; ++u; } while (Math.abs(bytes) >= thresh && u < units.length - 1);
        return bytes.toFixed(1)+' '+units[u];
      }

      removeImageBtn.addEventListener('click', () => {
        fileInput.value = '';
        uploadContent.classList.remove('hidden');
        imagePreview.classList.add('hidden');
      });

      clearBtn.addEventListener('click', () => {
        document.getElementById('titleInput').value = '';
        document.getElementById('eventInput').value = '';
        fileInput.value = '';
        uploadContent.classList.remove('hidden');
        imagePreview.classList.add('hidden');
      });

      createForm.addEventListener('submit', function (e) {
        const title = document.querySelector('[name="title"]').value.trim();
        const event = document.querySelector('[name="event"]').value.trim();
        const file = fileInput.files[0];

        if (!title) {
          e.preventDefault();
          alert('Please fill title and event.');
          return;
        }
        if (!file) {
          e.preventDefault();
          alert('Please upload an image.');
          return;
        }
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-70','cursor-not-allowed');
      });
    })();
  </script>
@endsection
