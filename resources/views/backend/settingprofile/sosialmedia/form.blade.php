<div class="row">
  {{-- Instagram --}}
  <div class="col-md-6 mb-3">
    <label class="form-label text-white fw-semibold">
      <i class="fab fa-instagram me-1 text-danger"></i> Instagram
    </label>
    <input 
      type="url"
      name="instagram"
      class="form-control bg-dark text-white border-secondary"
      placeholder="https://instagram.com/username"
      value="{{ old('instagram', $social->instagram ?? '') }}">
    <small class="text-white-50">Contoh: https://instagram.com/embunpelangi.waterpark</small>
  </div>

  {{-- Facebook --}}
  <div class="col-md-6 mb-3">
    <label class="form-label text-white fw-semibold">
      <i class="fab fa-facebook me-1 text-primary"></i> Facebook
    </label>
    <input 
      type="url"
      name="facebook"
      class="form-control bg-dark text-white border-secondary"
      placeholder="https://facebook.com/username"
      value="{{ old('facebook', $social->facebook ?? '') }}">
    <small class="text-white-50">Contoh: https://facebook.com/embunpelangi</small>
  </div>

  {{-- TikTok --}}
  <div class="col-md-6 mb-3">
    <label class="form-label text-white fw-semibold">
      <i class="fab fa-tiktok me-1"></i> TikTok
    </label>
    <input 
      type="url"
      name="tiktok"
      class="form-control bg-dark text-white border-secondary"
      placeholder="https://tiktok.com/@username"
      value="{{ old('tiktok', $social->tiktok ?? '') }}">
    <small class="text-white-50">Contoh: https://tiktok.com/@embunpelangi</small>
  </div>

  {{-- YouTube --}}
  <div class="col-md-6 mb-4">
    <label class="form-label text-white fw-semibold">
      <i class="fab fa-youtube me-1 text-danger"></i> YouTube
    </label>
    <input 
      type="url"
      name="youtube"
      class="form-control bg-dark text-white border-secondary"
      placeholder="https://youtube.com/@username"
      value="{{ old('youtube', $social->youtube ?? '') }}">
    <small class="text-white-50">Contoh: https://youtube.com/@embunpelangi</small>
  </div>
</div>
