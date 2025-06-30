<?php

// app/Livewire/SkorPage.php
namespace App\Livewire;

use Livewire\Component;
use App\Models\PenerimaanSkor;
use Livewire\Attributes\Layout;

class SkorPage extends Component
{
    #[Layout('components.layouts.app')]
    public $id_skor, $id_penerima, $skor_rumah, $skor_kendaraan, $skor_pendapatan, $skor_anak, $total_skor, $kelayakan;
    public $isEdit = false;

    public function submit()
    {
        $this->validate([
            'id_penerima' => 'required|numeric',
            'skor_rumah' => 'required|numeric',
            'skor_kendaraan' => 'required|numeric',
            'skor_pendapatan' => 'required|numeric',
            'skor_anak' => 'required|numeric',
            'total_skor' => 'required|numeric',
            'kelayakan' => 'required|in:Layak,Tidak Layak',
        ]);

        if ($this->isEdit) {
            PenerimaanSkor::where('id', $this->id_skor)->update($this->only([
                'id_penerima', 'skor_rumah', 'skor_kendaraan', 'skor_pendapatan', 'skor_anak', 'total_skor', 'kelayakan'
            ]));
            session()->flash('success', 'Data berhasil diperbarui');
        } else {
            PenerimaanSkor::create($this->only([
                'id_penerima', 'skor_rumah', 'skor_kendaraan', 'skor_pendapatan', 'skor_anak', 'total_skor', 'kelayakan'
            ]));
            session()->flash('success', 'Data berhasil disimpan');
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $data = PenerimaanSkor::findOrFail($id);
        $this->id_skor = $data->id;
        $this->id_penerima = $data->id_penerima;
        $this->skor_rumah = $data->skor_rumah;
        $this->skor_kendaraan = $data->skor_kendaraan;
        $this->skor_pendapatan = $data->skor_pendapatan;
        $this->skor_anak = $data->skor_anak;
        $this->total_skor = $data->total_skor;
        $this->kelayakan = $data->kelayakan;
        $this->isEdit = true;
    }

    public function delete($id)
    {
        PenerimaanSkor::destroy($id);
        session()->flash('success', 'Data berhasil dihapus');
    }

    public function resetForm()
    {
        $this->reset([
            'id_skor', 'id_penerima', 'skor_rumah', 'skor_kendaraan', 'skor_pendapatan', 'skor_anak', 'total_skor', 'kelayakan', 'isEdit'
        ]);
    }

    public function render()
    {
        return view('livewire.skor-page', [
            'dataSkor' => PenerimaanSkor::all()
        ]);
    }
}
