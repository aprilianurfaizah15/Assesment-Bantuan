<?php

namespace App\Livewire;

use App\Models\Kendaraan;
use Livewire\Component;
use Livewire\Attributes\Layout;

class KendaraanPage extends Component
{
    #[Layout('components.layouts.app')]
    public $id, $user_nik, $jenis_kendaraan, $jumlah_kendaraan;
    public $isEdit = false;

    public function submit()
    {
        $this->validate([
            'user_nik' => 'required|string|max:16',
            'jenis_kendaraan' => 'required|in:Motor,Mobil,Tidak Punya',
            'jumlah_kendaraan' => 'required|integer|min:0',
        ]);

        if ($this->isEdit) {
            Kendaraan::where('id', $this->id)->update($this->only([
                'user_nik', 'jenis_kendaraan', 'jumlah_kendaraan'
            ]));
            session()->flash('success', 'Data kendaraan berhasil diperbarui');
        } else {
            Kendaraan::create($this->only([
                'user_nik', 'jenis_kendaraan', 'jumlah_kendaraan'
            ]));
            session()->flash('success', 'Data kendaraan berhasil disimpan');
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $data = Kendaraan::findOrFail($id);
        $this->id = $data->id;
        $this->user_nik = $data->user_nik;
        $this->jenis_kendaraan = $data->jenis_kendaraan;
        $this->jumlah_kendaraan = $data->jumlah_kendaraan;
        $this->isEdit = true;
    }

    public function delete($id)
    {
        Kendaraan::destroy($id);
        session()->flash('success', 'Data kendaraan berhasil dihapus');
    }

    public function resetForm()
    {
        $this->reset(['id', 'user_nik', 'jenis_kendaraan', 'jumlah_kendaraan', 'isEdit']);
    }

    public function render()
    {
        return view('livewire.kendaraan', [
            'dataKendaraan' => Kendaraan::all()
        ]);
    }
}
