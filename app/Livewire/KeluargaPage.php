<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Keluarga;
use Livewire\Attributes\Layout;

class KeluargaPage extends Component
{
    #[Layout('components.layouts.app')]
    public $user_nik, $jumlah_anak;
    public $isEdit = false;
    public $editId = null;

    public function submit()
    {
        $this->validate([
            'user_nik' => 'required|string|max:16',
            'jumlah_anak' => 'nullable|integer|min:0',
        ]);

        if ($this->isEdit) {
            Keluarga::where('id', $this->editId)->update($this->only(['user_nik', 'jumlah_anak']));
            session()->flash('success', 'Data berhasil diperbarui');
        } else {
            Keluarga::create($this->only(['user_nik', 'jumlah_anak']));
            session()->flash('success', 'Data berhasil disimpan');
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $data = Keluarga::findOrFail($id);
        $this->user_nik = $data->user_nik;
        $this->jumlah_anak = $data->jumlah_anak;
        $this->editId = $id;
        $this->isEdit = true;
    }

    public function delete($id)
    {
        Keluarga::where('id', $id)->delete();
        session()->flash('success', 'Data berhasil dihapus');
    }

    public function resetForm()
    {
        $this->reset(['user_nik', 'jumlah_anak', 'isEdit', 'editId']);
    }

    public function render()
    {
        return view('livewire.keluarga', [
            'dataKeluarga' => Keluarga::all()
        ]);
    }
}
