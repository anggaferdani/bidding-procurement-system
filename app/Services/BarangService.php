<?php

namespace App\Services;

use App\Models\Barang;
use App\Models\HistoryPengadaan;
use App\Models\Pengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangService
{
    public function __construct(Barang $barang, Pengadaan $pengadaan, HistoryPengadaan $historyPengadaan)
    {
        $this->barang = $barang;
        $this->pengadaan = $pengadaan;
        $this->historyPengadaan = $historyPengadaan;
    }
    
    public function handleGetAllBarang()
    {
        $data = $this->barang->all();
        return $data;
    }

    public function handleStoreBarang($request)
    {
        $request->validate([
          'nama_barang' => 'required',
          'jenis_barang' => 'required',
          'hps' => 'required',
        ]);

        $barang = $this->barang->create([
            'nama_barang' => $request->nama_barang,
            'jenis_barang' => $request->jenis_barang,
            'hps' => $request->hps,
        ]);

        $pengadaan = $this->pengadaan->create([
            'barang_id' => $barang->id,
            'user_id' => Auth::id(),
            'status_pengadaan' => $request->status_pengadaan,
        ]);

        return $pengadaan;
    }

    public function handleGetBarang($id)
    {
        $barang = $this->barang->find($id);
        return $barang;
    }

    public function handlePutUpdateBarang($id, $request)
    {
        $request->validate([
          'nama_barang' => 'required',
          'jenis_barang' => 'required',
          'hps' => 'required',
        ]);

        $this->barang->find($id)->update([
            'nama_barang' => $request->nama_barang,
            'jenis_barang' => $request->jenis_barang,
            'hps' => $request->hps,
        ]);

        $pengadaan = $this->pengadaan->find($request->pengadaan_id)->update([
            'status_pengadaan' => $request->status_pengadaan,
        ]);

        return $pengadaan;
    }

    public function handleDeleteBarang($id, $request)
    {
        $dataDetailPengadaan = $this->historyPengadaan->where('pengadaan_id', $request->pengadaan_id)->get();
        if ($dataDetailPengadaan) {
            foreach ($dataDetailPengadaan as $key => $ddlitem) {
                $this->historyPengadaan->find($ddlitem->id)->delete();
            }
        }
        $this->pengadaan->find($request->pengadaan_id)->delete();
        $data = $this->barang->find($id)->delete();
        return $data;
    }
}