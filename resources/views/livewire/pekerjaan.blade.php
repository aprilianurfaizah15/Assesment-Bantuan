<div> {{-- root tunggal Livewire --}}

  <!-- FORM -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">{{ $isEdit ? 'Edit Data Pekerjaan' : 'Form Pekerjaan' }}</h5>

      @if (session()->has('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form wire:submit.prevent="submit">
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">NIK</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" wire:model="user_nik">
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Jenis Pekerjaan</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" wire:model="jenis_pekerjaan">
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Penghasilan</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" wire:model="penghasilan">
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
      <h5 class="card-title">Data Pekerjaan</h5>

      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>NIK</th>
            <th>Jenis Pekerjaan</th>
            <th>Penghasilan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dataPekerjaan as $index => $item)
            <tr>
              <th scope="row">{{ $index + 1 }}</th>
              <td>{{ $item->user_nik }}</td>
              <td>{{ $item->jenis_pekerjaan }}</td>
              <td>{{ number_format($item->penghasilan, 0, ',', '.') }}</td>
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

</div> {{-- root tunggal --}}
