{{-- resources/views/backend/settingprofile/identitasdasar/form.blade.php --}}
<div class="mb-3">
  <label class="form-label text-white fw-semibold">
    <i class="fas fa-water me-1 text-info"></i> Nama Waterpark
  </label>
  <input 
    type="text" 
    name="nama" 
    class="form-control bg-dark text-white border-secondary shadow-sm"
    value="{{ old('nama', $profile->nama ?? '') }}" 
    placeholder="Masukkan nama perusahaan / waterpark">
</div>

<div class="mb-3">
  <label class="form-label text-white fw-semibold">
    <i class="fas fa-quote-left me-1 text-warning"></i> Tagline / Motto
  </label>
  <input 
    type="text" 
    name="tagline" 
    class="form-control bg-dark text-white border-secondary shadow-sm"
    value="{{ old('tagline', $profile->tagline ?? '') }}" 
    placeholder="Masukkan tagline atau motto perusahaan">
</div>

<div class="mb-3">
  <label class="form-label text-white fw-semibold">
    <i class="fas fa-align-left me-1 text-success"></i> Deskripsi / Tentang Kami
  </label>
  <textarea 
    name="deskripsi" 
    class="form-control bg-dark text-white border-secondary shadow-sm" 
    rows="4"
    placeholder="Tuliskan deskripsi singkat tentang perusahaan">{{ old('deskripsi', $profile->deskripsi ?? '') }}</textarea>
</div>

{{-- Upload Section --}}
<div class="row">
  {{-- Logo Nav --}}
  <div class="col-md-4 mb-3">
    <label class="form-label text-white fw-semibold">
      <i class="fas fa-image me-1 text-primary"></i> Logo Nav
    </label>
    <input 
      type="file" 
      name="logo_nav" 
      class="form-control bg-dark text-white border-secondary shadow-sm" 
      accept="image/*" 
      onchange="previewImage(event, 'logoNavPreview')">
    @if (!empty($profile->logo_nav))
      <img id="logoNavPreview" src="{{ asset('storage/'.$profile->logo_nav) }}" width="80" class="mt-2 rounded shadow-sm border border-secondary">
    @else
      <img id="logoNavPreview" src="#" width="80" class="mt-2 rounded shadow-sm border border-secondary d-none">
    @endif
  </div>

  {{-- Logo Footer --}}
  <div class="col-md-4 mb-3">
    <label class="form-label text-white fw-semibold">
      <i class="fas fa-image me-1 text-primary"></i> Logo Footer
    </label>
    <input 
      type="file" 
      name="logo_footer" 
      class="form-control bg-dark text-white border-secondary shadow-sm"
      accept="image/*"
      onchange="previewImage(event, 'logoFooterPreview')">
    @if (!empty($profile->logo_footer))
      <img id="logoFooterPreview" src="{{ asset('storage/'.$profile->logo_footer) }}" width="80" class="mt-2 rounded shadow-sm border border-secondary">
    @else
      <img id="logoFooterPreview" src="#" width="80" class="mt-2 rounded shadow-sm border border-secondary d-none">
    @endif
  </div>

  {{-- Favicon --}}
  <div class="col-md-4 mb-3">
    <label class="form-label text-white fw-semibold">
      <i class="fas fa-star me-1 text-warning"></i> Favicon
    </label>
    <input 
      type="file" 
      name="favicon" 
      class="form-control bg-dark text-white border-secondary shadow-sm"
      accept="image/*"
      onchange="previewImage(event, 'faviconPreview')">
    @if (!empty($profile->favicon))
      <img id="faviconPreview" src="{{ asset('storage/'.$profile->favicon) }}" width="40" class="mt-2 rounded shadow-sm border border-secondary">
    @else
      <img id="faviconPreview" src="#" width="40" class="mt-2 rounded shadow-sm border border-secondary d-none">
    @endif
  </div>
</div>

<div class="mb-3">
  <label class="form-label text-white fw-semibold">
    <i class="fas fa-calendar-alt me-1 text-danger"></i> Tanggal Berdiri
  </label>
  <input 
    type="date" 
    name="tanggal_berdiri" 
    class="form-control bg-dark text-white border-secondary shadow-sm"
    value="{{ old('tanggal_berdiri', $profile->tanggal_berdiri ?? '') }}">
</div>

{{-- JS untuk Preview Gambar --}}
@push('scripts')
<script>
  function previewImage(event, previewId) {
    const input = event.target;
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = e => {
        preview.src = e.target.result;
        preview.classList.remove('d-none');
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endpush
