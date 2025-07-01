<div>
  <!-- FORM -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">{{ $isEdit ? 'Edit Skor' : 'Form Skor Penerimaan' }}</h5>

      @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form wire:submit.prevent="submit">
        <div class="mb-3">
          <label>ID Penerima</label>
          <input type="text" class="form-control" wire:model="id_penerima">
        </div>

        <div class="mb-3">
          <label>Skor Rumah</label>
          <input type="number" class="form-control" wire:model="skor_rumah">
        </div>

        <div class="mb-3">
          <label>Skor Kendaraan</label>
          <input type="number" class="form-control" wire:model="skor_kendaraan">
        </div>

        <div class="mb-3">
          <label>Skor Pekerjaan</label>
          <input type="number" class="form-control" wire:model="skor_pekerjaan">
        </div>

        <div class="mb-3">
          <label>Skor Anak</label>
          <input type="number" class="form-control" wire:model="skor_anak">
        </div>

        <div class="mb-3">
          <label>Total Skor (Otomatis)</label>
          <input type="number" class="form-control" value="{{ $total_skor }}" readonly>
        </div>

        <div class="mb-3">
          <label>Kelayakan</label>
          <select class="form-select" wire:model="kelayakan">
            <option value="">- Pilih -</option>
            <option value="Layak">Layak</option>
            <option value="Tidak Layak">Tidak Layak</option>
          </select>
        </div>

        <button class="btn btn-primary" type="submit">{{ $isEdit ? 'Update' : 'Simpan' }}</button>
        <button class="btn btn-secondary" type="button" wire:click="resetForm">Reset</button>
      </form>
    </div>
  </div>

  <!-- TABLE -->
  <div class="card mt-4">
    <div class="card-body">
      <h5 class="card-title">Data Skor</h5>
      <table class="table table-bordered">
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
                <button class="btn btn-warning btn-sm" wire:click="edit({{ $item->id }})">Edit</button>
                <button class="btn btn-danger btn-sm" wire:click="delete({{ $item->id }})" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
