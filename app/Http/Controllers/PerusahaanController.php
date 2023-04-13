<?php

namespace App\Http\Controllers;

use App\Services\BarangService;
use App\Services\PengadaanService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerusahaanController extends Controller
{
  public function __construct(PengadaanService $pengadaanService, BarangService $barangService, UserService $userService)
  {
      $this->pengadaanService = $pengadaanService;
      $this->barangService = $barangService;
      $this->userService = $userService;
  }

  public function dashboard()
  {
      $pengadaan = $this->pengadaanService->handleGetAllPengadaan();
      $barang = $this->barangService->handleGetAllBarang();
      $user = $this->userService->handleGetAllUser();
      return view('pages.eproc.perusahaan.dashboard', [
          'pengadaan' => $pengadaan,
          'barang' => $barang,
          'user' => $user,
      ]);
  }
}