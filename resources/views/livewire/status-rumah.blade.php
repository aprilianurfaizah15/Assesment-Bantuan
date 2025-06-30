<div> {{-- root tunggal Livewire --}}

  <!-- FORM -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">{{ $isEdit ? 'Edit Data Rumah' : 'Form Status Rumah' }}</h5>

      @if (session()->has('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form wire:submit.prevent="submit">
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">NIK</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" wire:model="user_nik" {{ $isEdit ? 'readonly' : '' }}>
            @error('user_nik') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Status Rumah</label>
          <div class="col-sm-10">
            <select class="form-control" wire:model="status_rumah">
              <option value="">-- Pilih --</option>
              <option value="Milik Sendiri">Milik Sendiri</option>
              <option value="Sewa">Sewa</option>
              <option value="Menumpang">Menumpang</option>
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Luas Rumah (m²)</label>
          <div class="col-sm-10">
            <input type="number" step="0.1" class="form-control" wire:model="luas_rumah">
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Kondisi Rumah</label>
          <div class="col-sm-10">
            <select class="form-control" wire:model="kondisi_rumah">
              <option value="">-- Pilih --</option>
              <option value="Layak">Layak</option>
              <option value="Kurang Layak">Kurang Layak</option>
              <option value="Tidak Layak">Tidak Layak</option>
            </select>
          </div>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Update' : 'Submit' }}</button>
          <button type="button" class="btn btn-secondary" wire:click="resetForm">Reset</button>
        </div>
      </form>
    </div>
  </div>

  <!-- TABEL -->
  <div class="card mt-4">
    <div class="card-body">
      <h5 class="card-title">Data Rumah</h5>

      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>NIK</th>
            <th>Status</th>
            <th>Luas</th>
            <th>Kondisi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dataRumah as $index => $item)
            <tr>
              <th>{{ $index + 1 }}</th>
              <td>{{ $item->user_nik }}</td>
              <td>{{ $item->status_rumah }}</td>
              <td>{{ $item->luas_rumah }} m²</td>
              <td>{{ $item->kondisi_rumah }}</td>
              <td>
                <button class="btn btn-sm btn-warning" wire:click="edit({{ $item->id }})">Edit</button>
                <button class="btn btn-sm btn-danger" wire:click="delete({{ $item->id }})" onclick="return confirm('Yakin hapus?')">Delete</button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div> {{-- akhir root tunggal --}}
