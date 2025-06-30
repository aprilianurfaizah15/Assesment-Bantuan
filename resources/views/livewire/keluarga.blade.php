<div> {{-- root tunggal Livewire --}}

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">{{ $isEdit ? 'Edit Data Keluarga' : 'Form Keluarga' }}</h5>

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
          <label class="col-sm-2 col-form-label">Jumlah Anak</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" wire:model="jumlah_anak">
            @error('jumlah_anak') <small class="text-danger">{{ $message }}</small> @enderror
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
      <h5 class="card-title">Data Keluarga</h5>

      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>NIK</th>
            <th>Jumlah Anak</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dataKeluarga as $index => $item)
            <tr>
              <th scope="row">{{ $index + 1 }}</th>
              <td>{{ $item->user_nik }}</td>
              <td>{{ $item->jumlah_anak }}</td>
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

</div> {{-- end root --}}
