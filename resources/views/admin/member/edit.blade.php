@extends('admin.layouts.master')
@section('title', 'Member - update ')
@section('content')
  <div class="container mx-auto px-4 py-8">
    <div class="mb-8">
      <a href="{{ route('member.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors">
        <i class="fas fa-arrow-left"></i>
        Back
      </a>
    </div>
    <div class="mb-4">
      <h1 class="text-3xl font-bold">Create Data</h1>
    </div>
    @if ($errors->any())
      <div class="mb-6 p-4 rounded-lg bg-red-800 border border-red-700 text-red-100">
        <strong class="block mb-2">Fix errors:</strong>
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form id="edit-form" action="{{ route('member.update', $member->id) }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 rounded-xl shadow-lg p-6">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
          <label class="block text-sm font-medium mb-2 text-gray-300">Image</label>

          <div id="dropZone" tabindex="0" class="relative border-2 border-dashed border-gray-600 rounded-lg p-8 text-center hover:border-blue-500 transition-colors bg-gray-700 min-h-134 flex flex-col items-center justify-center">
            <input type="file" id="fileInput" name="avatar" class="hidden" accept="image/*" />
            <div id="uploadContent" class="{{ $member->avatar ? 'hidden' : '' }} flex flex-col items-center">
              <i class="fas fa-cloud-upload-alt text-4xl mb-4 text-gray-400"></i>
              <p class="text-gray-300 mb-2">Drag & drop to replace image</p>
              <p class="text-sm text-gray-400 mb-4">or</p>
              <button type="button" id="browseBtn" class="px-4 py-2 bg-gray-600 hover:bg-gray-500 rounded-lg transition-colors">Browse Files</button>
              <p class="text-xs text-gray-500 mt-2">PNG, JPG, JPEG, WEBP — max 2MB</p>
            </div>

            <div id="imagePreview" class="{{ $member->avatar ? '' : 'hidden' }} flex flex-col items-center">
              @if ($member->avatar)
                <img id="previewImg" class="max-h-48 max-w-full rounded-lg mb-4 object-cover" src="{{ asset('avt_item_upload/' . $member->avatar) }}" alt="Current Avatar" />
              @else
                <img id="previewImg" class="max-h-48 max-w-full rounded-lg mb-4 object-cover" src="#" alt="Preview" />
              @endif

              <p id="previewName" class="text-sm text-gray-300 mb-2">{{ $member->avatar ? $member->avatar : '' }}</p>

              <div class="flex">

                <button type="button" id="replaceBtn" class="flex items-center gap-1 px-3 py-1 bg-gray-600 hover:bg-gray-500 text-white rounded text-sm">
                  <i class="fas fa-upload"></i>
                  Replace
                </button>
                <label for="fileInput" id="replaceLabel" class="sr-only">Replace image</label>
              </div>
            </div>

            @error('avatar') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
          </div>
        </div>
        <div class="space-y-6">
          <div>
            <label class="block text-sm font-medium mb-2 text-gray-300">Nama Lengkap</label>
            <input name="name" type="text" value="{{ old('name', $member->name) }}" 
                  class="w-full px-4 py-3 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 transition-colors" />
            @error('name') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
          </div>
          <div>
            <label class="block text-sm font-medium mb-2 text-gray-300">Nama Panggilan (optional)</label>
            <input name="nickname" type="text" value="{{ old('nickname', $member->nickname) }}"
                  class="w-full px-4 py-3 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 transition-colors" />
            @error('nickname') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
          </div>

          <div>
            <label class="block text-sm font-medium mb-2 text-gray-300">Role (optional)</label>
            <input name="role" type="text" value="{{ old('role', $member->role) }}"
                  class="w-full px-4 py-3 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 transition-colors" />
            @error('role') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
          </div>

          <div>
            <label class="block text-sm font-medium mb-2 text-gray-300">Gender</label>
            <select name="gender"
                    class="w-full px-4 py-3 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 transition-colors">
              <option value="">-- Pilih gender --</option>
              <option value="male" {{ old('gender', $member->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
              <option value="female" {{ old('gender', $member->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('gender') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
          </div>

          <div>
            <label class="block text-sm font-medium mb-2 text-gray-300">Tanggal Lahir</label>
            <input name="birth_date" type="date" value="{{ old('birth_date', $member->birth_date) }}"
                  class="w-full px-4 py-3 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 transition-colors" />
            @error('birth_date') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
          </div>

          <div class="flex flex-wrap gap-3 pt-4">
            <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
              <i class="fas fa-save"></i> Save
            </button>

            <a href="{{ route('member.index') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-600 hover:bg-gray-500 text-white rounded-lg transition-colors">
              <i class="fas fa-arrow-left"></i> Cancel
            </a>
          </div>
        </div>

      </div>
      
    </form>

    <p class="mt-6 text-xs text-gray-400">You can replace the image by dragging a new one or clicking Replace.</p>
  </div>
@endsection

@section('script')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const fileInput = document.getElementById('fileInput');
      const replaceBtn = document.getElementById('replaceBtn');
      const replaceLabel = document.getElementById('replaceLabel');
      const dropZone = document.getElementById('dropZone');
      const browseBtn = document.getElementById('browseBtn');
      const uploadContent = document.getElementById('uploadContent');
      const imagePreview = document.getElementById('imagePreview');
      const previewImg = document.getElementById('previewImg');
      const previewName = document.getElementById('previewName');

      if (!fileInput) {
        console.warn('fileInput not found — Replace button cannot function.');
        return;
      }

      function humanFileSize(bytes) {
        const thresh = 1024;
        if (Math.abs(bytes) < thresh) return bytes + ' B';
        const units = ['KB','MB','GB','TB'];
        let u = -1;
        do { bytes /= thresh; ++u; } while (Math.abs(bytes) >= thresh && u < units.length - 1);
        return bytes.toFixed(1) + ' ' + units[u];
      }

      function showPreview(file) {
        if (!previewImg || !previewName || !uploadContent || !imagePreview) return;
        const reader = new FileReader();
        reader.onload = (ev) => {
          previewImg.src = ev.target.result;
          previewName.textContent = file.name + ' • ' + humanFileSize(file.size);
          uploadContent.classList.add('hidden');
          imagePreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      }

      if (replaceBtn) {
        replaceBtn.addEventListener('click', function (e) {
          e.preventDefault();
          fileInput.click();
        });
      } else if (replaceLabel) {
        replaceLabel.classList.remove('sr-only');
      }

      if (browseBtn) {
        browseBtn.addEventListener('click', function (e) {
          e.preventDefault();
          fileInput.click();
        });
      }

      fileInput.addEventListener('change', function (e) {
        const file = e.target.files && e.target.files[0];
        if (!file) return;
        const accept = ['image/jpeg','image/png','image/webp','image/jpg'];
        const maxSize = 5 * 1024 * 1024;
        if (!accept.includes(file.type)) {
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

      if (dropZone) {
        ['dragenter','dragover','dragleave','drop'].forEach(evt => dropZone.addEventListener(evt, function(e) { e.preventDefault(); e.stopPropagation(); }, false));
        dropZone.addEventListener('drop', function (e) {
          const dt = e.dataTransfer;
          const file = dt.files && dt.files[0];
          if (!file) return;
          const accept = ['image/jpeg','image/png','image/webp','image/jpg'];
          const maxSize = 5 * 1024 * 1024;
          if (!accept.includes(file.type)) {
            alert('Unsupported file type.');
            return;
          }
          if (file.size > maxSize) {
            alert('File too large (max 2MB).');
            return;
          }
          try {
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fileInput.files = dataTransfer.files;
          } catch (err) {
            console.warn('DataTransfer not supported, fileInput may not be set programmatically.');
          }
          showPreview(file);
        }, false);
      }
    });
  </script>
@endsection
