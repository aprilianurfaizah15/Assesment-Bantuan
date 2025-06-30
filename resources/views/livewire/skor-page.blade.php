<div>
  <!-- FORM -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">{{ $isEdit ? 'Edit Skor' : 'Form Skor Penerimaan' }}</h5>
      @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form wire:submit.prevent="submit">
        @foreach ([
          'id_penerima' => 'ID Penerima',
          'skor_rumah' => 'Skor Rumah',
          'skor_kendaraan' => 'Skor Kendaraan',
          'skor_pekerjaan' => 'Skor Pekerjaan',
          'skor_anak' => 'Skor Anak',
          'total_skor' => 'Total Skor'
        ] as $field => $label)
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">{{ $label }}</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" wire:model="{{ $field }}">
          </div>
        </div>
        @endforeach

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label">Kelayakan</label>
          <div class="col-sm-10">
            <select class="form-select" wire:model="kelayakan">
              <option value="">- Pilih -</option>
              <option value="Layak">Layak</option>
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
      <h5 class="card-title">Data Skor Penerimaan</h5>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>ID Penerima</th>
            <th>Total Skor</th>
            <th>Kelayakan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dataSkor as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $item->id_penerima }}</td>
              <td>{{ $item->total_skor }}</td>
              <td>{{ $item->kelayakan }}</td>
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

