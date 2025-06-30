<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\StatusRumah;
use Livewire\Attributes\Layout;

class StatusRumahPage extends Component
{
    #[Layout('components.layouts.app')]
    public $user_nik, $status_rumah, $luas_rumah, $kondisi_rumah;
    public $isEdit = false;
    public $editId = null;

    public function submit()
    {
        $this->validate([
            'user_nik' => 'required|string|max:16',
            'status_rumah' => 'required|in:Milik Sendiri,Sewa,Menumpang',
            'luas_rumah' => 'nullable|numeric',
            'kondisi_rumah' => 'required|in:Layak,Kurang Layak,Tidak Layak'
        ]);

        if ($this->isEdit) {
            StatusRumah::where('id', $this->editId)->update($this->only([
                'user_nik', 'status_rumah', 'luas_rumah', 'kondisi_rumah'
            ]));
            session()->flash('success', 'Data berhasil diperbarui');
        } else {
            StatusRumah::create($this->only([
                'user_nik', 'status_rumah', 'luas_rumah', 'kondisi_rumah'
            ]));
            session()->flash('success', 'Data berhasil disimpan');
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $data = StatusRumah::findOrFail($id);
        $this->user_nik = $data->user_nik;
        $this->status_rumah = $data->status_rumah;
        $this->luas_rumah = $data->luas_rumah;
        $this->kondisi_rumah = $data->kondisi_rumah;
        $this->editId = $data->id;
        $this->isEdit = true;
    }

    public function delete($id)
    {
        StatusRumah::destroy($id);
        session()->flash('success', 'Data berhasil dihapus');
    }

    public function resetForm()
    {
        $this->reset(['user_nik', 'status_rumah', 'luas_rumah', 'kondisi_rumah', 'isEdit', 'editId']);
    }

    public function render()
    {
        return view('livewire.status-rumah', [
            'dataRumah' => StatusRumah::all()
        ]);
    }
}
