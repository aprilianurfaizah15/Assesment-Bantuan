<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Penerima;
use Livewire\Attributes\Layout;

class PenerimaPage extends Component
{
    #[Layout('components.layouts.app')]
    public $nik, $nama_lengkap, $tanggal_lahir, $alamat, $jenis_kelamin, $no_hp;
    public $isEdit = false;
    public $editNik = null;

    public function submit()
    {
        $this->validate([
            'nik' => 'required|string|max:16',
            'nama_lengkap' => 'required|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'nullable|in:L,P',
            'no_hp' => 'nullable|string|max:15',
        ]);

        if ($this->isEdit) {
            Penerima::where('nik', $this->editNik)->update($this->only([
                'nik', 'nama_lengkap', 'tanggal_lahir', 'alamat', 'jenis_kelamin', 'no_hp'
            ]));
            session()->flash('success', 'Data berhasil diperbarui');
        } else {
            Penerima::create($this->only([
                'nik', 'nama_lengkap', 'tanggal_lahir', 'alamat', 'jenis_kelamin', 'no_hp'
            ]));
            session()->flash('success', 'Data berhasil disimpan');
        }

        $this->resetForm();
    }

    public function edit($nik)
    {
        $data = Penerima::findOrFail($nik);
        $this->nik = $data->nik;
        $this->nama_lengkap = $data->nama_lengkap;
        $this->tanggal_lahir = $data->tanggal_lahir;
        $this->alamat = $data->alamat;
        $this->jenis_kelamin = $data->jenis_kelamin;
        $this->no_hp = $data->no_hp;
        $this->editNik = $nik;
        $this->isEdit = true;
    }

    public function delete($nik)
    {
        Penerima::where('nik', $nik)->delete();
        session()->flash('success', 'Data berhasil dihapus');
    }

    public function resetForm()
    {
        $this->reset(['nik', 'nama_lengkap', 'tanggal_lahir', 'alamat', 'jenis_kelamin', 'no_hp', 'isEdit', 'editNik']);
    }

    public function render()
    {
        return view('livewire.penerima', [
            'dataPenerima' => Penerima::all()
        ]);
    }
}
