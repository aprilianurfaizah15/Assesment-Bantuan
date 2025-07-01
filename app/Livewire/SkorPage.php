<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PenerimaanSkor;

class SkorPage extends Component
{
    public $id, $id_penerima;
    public $skor_rumah = 0, $skor_kendaraan = 0, $skor_pekerjaan = 0, $skor_anak = 0;
    public $total_skor = 0, $kelayakan;
    public $dataSkor = [];
    public $isEdit = false;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->dataSkor = PenerimaanSkor::all();
    }

    public function updated($property)
    {
        if (in_array($property, ['skor_rumah', 'skor_kendaraan', 'skor_pekerjaan', 'skor_anak'])) {
            $this->calculateTotalSkor();
        }
    }

    public function calculateTotalSkor()
    {
        $this->total_skor = (int)$this->skor_rumah + (int)$this->skor_kendaraan + (int)$this->skor_pekerjaan + (int)$this->skor_anak;
    }

    public function submit()
    {
        $this->calculateTotalSkor();

        $this->validate([
            'id_penerima' => 'required',
            'skor_rumah' => 'required|integer',
            'skor_kendaraan' => 'required|integer',
            'skor_pekerjaan' => 'required|integer',
            'skor_anak' => 'required|integer',
            'kelayakan' => 'required'
        ]);

        if ($this->isEdit && $this->id) {
            $skor = PenerimaanSkor::findOrFail($this->id);
            $skor->update([
                'id_penerima' => $this->id_penerima,
                'skor_rumah' => $this->skor_rumah,
                'skor_kendaraan' => $this->skor_kendaraan,
                'skor_pekerjaan' => $this->skor_pekerjaan,
                'skor_anak' => $this->skor_anak,
                'total_skor' => $this->total_skor,
                'kelayakan' => $this->kelayakan,
            ]);
        } else {
            PenerimaanSkor::create([
                'id_penerima' => $this->id_penerima,
                'skor_rumah' => $this->skor_rumah,
                'skor_kendaraan' => $this->skor_kendaraan,
                'skor_pekerjaan' => $this->skor_pekerjaan,
                'skor_anak' => $this->skor_anak,
                'total_skor' => $this->total_skor,
                'kelayakan' => $this->kelayakan,
            ]);
        }

        session()->flash('success', 'Data berhasil disimpan.');
        $this->resetForm();
        $this->loadData();
    }

    public function edit($id)
    {
        $skor = PenerimaanSkor::findOrFail($id);
        $this->id = $skor->id;
        $this->id_penerima = $skor->id_penerima;
        $this->skor_rumah = $skor->skor_rumah;
        $this->skor_kendaraan = $skor->skor_kendaraan;
        $this->skor_pekerjaan = $skor->skor_pekerjaan;
        $this->skor_anak = $skor->skor_anak;
        $this->total_skor = $skor->total_skor;
        $this->kelayakan = $skor->kelayakan;
        $this->isEdit = true;
    }

    public function delete($id)
    {
        PenerimaanSkor::findOrFail($id)->delete();
        session()->flash('success', 'Data berhasil dihapus.');
        $this->loadData();
    }

    public function resetForm()
    {
        $this->id = null;
        $this->id_penerima = '';
        $this->skor_rumah = 0;
        $this->skor_kendaraan = 0;
        $this->skor_pekerjaan = 0;
        $this->skor_anak = 0;
        $this->total_skor = 0;
        $this->kelayakan = '';
        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.skor-page');
    }
}
