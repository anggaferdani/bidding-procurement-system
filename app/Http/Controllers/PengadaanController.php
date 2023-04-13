<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PengadaanService;
use Illuminate\Support\Facades\Auth;

class PengadaanController extends Controller
{
    public function __construct(PengadaanService $pengadaanService)
    {
        $this->pengadaanService = $pengadaanService;
    }

    public function index()
    {
        $pengadaan = $this->pengadaanService->handleGetAllPengadaan();
        return view('pages.eproc.pengadaan.index', [
            'pengadaan' => $pengadaan,
        ]);
    }

    public function detail_pengadaan($id)
    {
        $historyPengadaan = $this->pengadaanService->handleGetHistoryPengadaan($id);
        $pengadaan = $this->pengadaanService->handleGetPengadaan($id);
        return view('pages.eproc.pengadaan.detail-pengadaan', [
            'pengadaan' => $pengadaan,
            'history_pengadaan' => $historyPengadaan,
        ]);
    }

    public function bid(Request $request, $id)
    {
        $this->pengadaanService->handleBidPengadaan($request, $id);
        return back();
    }

    public function bukaPengadaan($id, $request)
    {
        $this->pengadaanService->handleBuka($id, $request);
        return back();
    }

    public function getAllPengadaanApi()
    {
        return response()->JSON($this->pengadaanService->handleGetAllPengadaan(), 200);
    }
}