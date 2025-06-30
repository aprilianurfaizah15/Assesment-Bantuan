<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pekerjaan;
use Livewire\Attributes\Layout;

class PekerjaanPage extends Component
{
    #[Layout('components.layouts.app')]
    public $user_nik, $jenis_pekerjaan, $penghasilan;
    public $isEdit = false;
    public $editId = null;

    public function submit()
    {
        $this->validate([
            'user_nik' => 'nullable|string|max:16',
            'jenis_pekerjaan' => 'required|string|max:50',
            'penghasilan' => 'nullable|numeric',
        ]);

        if ($this->isEdit && $this->editId) {
            Pekerjaan::where('id', $this->editId)->update($this->only(['user_nik', 'jenis_pekerjaan', 'penghasilan']));
            session()->flash('success', 'Data berhasil diperbarui');
        } else {
            Pekerjaan::create($this->only(['user_nik', 'jenis_pekerjaan', 'penghasilan']));
            session()->flash('success', 'Data berhasil disimpan');
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $data = Pekerjaan::findOrFail($id);
        $this->user_nik = $data->user_nik;
        $this->jenis_pekerjaan = $data->jenis_pekerjaan;
        $this->penghasilan = $data->penghasilan;
        $this->editId = $data->id;
        $this->isEdit = true;
    }

    public function delete($id)
    {
        Pekerjaan::where('id', $id)->delete();
        session()->flash('success', 'Data berhasil dihapus');
    }

    public function resetForm()
    {
        $this->reset(['user_nik', 'jenis_pekerjaan', 'penghasilan', 'isEdit', 'editId']);
    }

    public function render()
    {
        return view('livewire.pekerjaan', [
            'dataPekerjaan' => Pekerjaan::all()
        ]);
    }
}
