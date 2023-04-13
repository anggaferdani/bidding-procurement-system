<?php

namespace App\Http\Controllers;

use App\Services\BarangService;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function __construct(BarangService $barangService)
    {
        $this->barangService = $barangService;
    }

    public function index()
    {
        $barang = $this->barangService->handleGetAllBarang();
        return view('pages.eproc.barang.index', [
            'barang' => $barang,
        ]);
    }

    public function create()
    {
        return view('pages.eproc.barang.create');
    }

    public function store(Request $request)
    {
        $this->barangService->handleStoreBarang($request);
        return redirect()->route('eproc.superadmin.barang.index');
    }

    public function edit($id)
    {
        $data = $this->barangService->handleGetBarang($id);
        return view('pages.eproc.barang.edit', [
            'data' => $data,
        ]);
    }

    public function update($id, Request $request)
    {
        $this->barangService->handlePutUpdateBarang($id, $request);
        return redirect()->route('eproc.superadmin.akun.index');
    }

    public function destroy($id, Request $request)
    {
        $this->barangService->handleDeleteBarang($id, $request);
        return redirect()->route('eproc.admin.barang.index');
    }

    public function getAllBarangApi()
    {
        return response()->JSON($this->barangService->handleGetAllPengadaan(), 200);
    }
}