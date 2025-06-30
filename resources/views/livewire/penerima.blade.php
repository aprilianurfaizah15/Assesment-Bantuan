<div> {{-- root tunggal Livewire --}}

  <!-- FORM -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">{{ $isEdit ? 'Edit Data Penerima' : 'Form Penerima Bantuan' }}</h5>

      @if (session()->has('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form wire:submit.prevent="submit">
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">NIK</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" wire:model="nik" {{ $isEdit ? 'readonly' : '' }}>
            @error('nik') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Nama Lengkap</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" wire:model="nama_lengkap">
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" wire:model="tanggal_lahir">
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Alamat</label>
          <div class="col-sm-10">
            <textarea class="form-control" wire:model="alamat"></textarea>
          </div>
        </div>

        <fieldset class="row mb-3">
          <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
          <div class="col-sm-10">
            <div class="form-check">
              <input class="form-check-input" type="radio" wire:model="jenis_kelamin" id="jkL" value="L">
              <label class="form-check-label" for="jkL">Laki-laki</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" wire:model="jenis_kelamin" id="jkP" value="P">
              <label class="form-check-label" for="jkP">Perempuan</label>
            </div>
          </div>
        </fieldset>

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">No HP</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" wire:model="no_hp">
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
      <h5 class="card-title">Data Penerima</h5>

      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>JK</th>
            <th>No HP</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dataPenerima as $index => $item)
            <tr>
              <th scope="row">{{ $index + 1 }}</th>
              <td>{{ $item->nik }}</td>
              <td>{{ $item->nama_lengkap }}</td>
              <td>{{ $item->jenis_kelamin }}</td>
              <td>{{ $item->no_hp }}</td>
              <td>
                <button class="btn btn-sm btn-warning" wire:click="edit('{{ $item->nik }}')">Edit</button>
                <button class="btn btn-sm btn-danger" wire:click="delete('{{ $item->nik }}')" onclick="return confirm('Yakin hapus?')">Delete</button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div> {{-- akhir root tunggal --}}
