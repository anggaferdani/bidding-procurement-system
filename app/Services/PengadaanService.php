<?php

namespace App\Services;

use App\Models\HistoryPengadaan;
use App\Models\Pengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengadaanService
{
    public function __construct(Pengadaan $pengadaan, HistoryPengadaan $historyPengadaan)
    {
        $this->pengadaan = $pengadaan;
        $this->historyPengadaan = $historyPengadaan;
    }
    
    public function handleGetAllPengadaan()
    {
        $data = $this->pengadaan->get();
        return $data;
    }

    public function handleGetHistoryPengadaan($id)
    {
        $data = $this->historyPengadaan->where('pengadaan_id', $id)->orderBy('price_quotation', 'desc')->get();
        return $data;
    }

    public function handleGetPengadaan($id)
    {
        $data = $this->pengadaan->find($id);
        return $data;
    }

    public function handleBidPengadaan($request, $id)
    {
        $this->historyPengadaan->create([
            'pengadaan_id' => $id,
            'barang_id' => $request->barang_id,
            'user_id' => Auth::user()->id,
            'price_quotation' => $request->price_quotation,
        ]);
    }

    public function handleBuka($id, $request)
    {
        dd($id);
    }
}