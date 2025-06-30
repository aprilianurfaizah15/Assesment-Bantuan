<div> {{-- root tunggal Livewire --}}

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">{{ $isEdit ? 'Edit Data Kendaraan' : 'Form Kendaraan' }}</h5>

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
          <label class="col-sm-2 col-form-label">Jenis Kendaraan</label>
          <div class="col-sm-10">
            <select class="form-control" wire:model="jenis_kendaraan">
              <option value="">-- Pilih --</option>
              <option value="Motor">Motor</option>
              <option value="Mobil">Mobil</option>
              <option value="Tidak Punya">Tidak Punya</option>
            </select>
            @error('jenis_kendaraan') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Jumlah Kendaraan</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" wire:model="jumlah_kendaraan" min="0">
            @error('jumlah_kendaraan') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Update' : 'Submit' }}</button>
          <button type="button" class="btn btn-secondary" wire:click="resetForm">Reset</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card mt-4">
    <div class="card-body">
      <h5 class="card-title">Data Kendaraan</h5>

      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>NIK</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dataKendaraan as $index => $item)
            <tr>
              <th>{{ $index + 1 }}</th>
              <td>{{ $item->user_nik }}</td>
              <td>{{ $item->jenis_kendaraan }}</td>
              <td>{{ $item->jumlah_kendaraan }}</td>
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

</div>
