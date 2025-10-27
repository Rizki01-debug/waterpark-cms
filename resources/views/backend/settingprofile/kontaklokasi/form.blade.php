<div class="row">
  <div class="col-md-12 mb-3">
    <label class="form-label text-white fw-semibold">Alamat Lengkap</label>
    <textarea name="alamat" class="form-control bg-dark text-white border-secondary" rows="2" placeholder="Masukkan alamat lengkap" required>{{ old('alamat', $kontak->alamat ?? '') }}</textarea>
  </div>

  <div class="col-md-6 mb-3">
    <label class="form-label text-white fw-semibold">Nomor Telepon</label>
    <input type="text" name="telepon" class="form-control bg-dark text-white border-secondary" placeholder="Contoh: 087707987456" value="{{ old('telepon', $kontak->telepon ?? '') }}">
  </div>

  <div class="col-md-6 mb-3">
    <label class="form-label text-white fw-semibold">Email</label>
    <input type="email" name="email" class="form-control bg-dark text-white border-secondary" placeholder="waterpark@gmail.com" value="{{ old('email', $kontak->email ?? '') }}">
  </div>

  <div class="col-md-12 mb-3">
    <label class="form-label text-white fw-semibold">Link Google Maps</label>
    <textarea name="google_maps" class="form-control bg-dark text-white border-secondary" rows="2" placeholder="Tempelkan link Google Maps">{{ old('google_maps', $kontak->google_maps ?? '') }}</textarea>
  </div>

  <div class="col-md-6 mb-4">
    <label class="form-label text-white fw-semibold">Jam Operasional</label>
    <input type="text" name="jam_operasional" class="form-control bg-dark text-white border-secondary" placeholder="07:00 - 17:30" value="{{ old('jam_operasional', $kontak->jam_operasional ?? '') }}">
  </div>

  <div class="col-md-12 d-flex justify-content-start gap-2 mt-3">
    <button type="submit" class="btn btn-success px-4">
      <i class="fas fa-save me-2"></i> Simpan Perubahan
    </button>
    <a href="{{ route('admin.settingprofile.kontak.index') }}" class="btn btn-secondary px-4">
      <i class="fas fa-undo me-2"></i> Kembali
    </a>
  </div>
</div>
