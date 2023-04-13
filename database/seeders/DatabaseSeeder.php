<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\JajaranDireksi;
use App\Models\JajaranKomisaris;
use App\Models\User;
use App\Models\Survey;
use Illuminate\Database\Seeder;
use App\Models\ProfilePerusahaan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama_panjang' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt(12345678),
            'level' => 1,
        ]);

        User::create([
            'nama_panjang' => 'perusahaan0001',
            'email' => 'perusahaan0001@gmail.com',
            'password' => bcrypt(12345678),
            'level' => 'perusahaan',
        ]);

        User::create([
            'nama_panjang' => 'perusahaan0002',
            'email' => 'perusahaan0002@gmail.com',
            'password' => bcrypt(12345678),
            'level' => 'perusahaan',
        ]);

        ProfilePerusahaan::create([
            'sejarah_perusahaan' => 'PT.SARANAWISESA PROPERINDO adalah anak perusahaan Perumda Pembangunan Sarana Jaya ( BUMD milik Pemerintah Provinsi DKI Jakarta ) berdiri sejak tanggal 3 Februari 1993 yang bergerak dibidang Property. Seiring dengan perkembangan perusahaan yang semakin pesat maka kami melakukan diversifikasi usaha dengan mengembangkan bisnis baru di bidang Sarana Parkir, Management Properti, Agen Properti, Supplier serta Interior & Landscape.',
            'visi' => 'Menjadi Perusahaan Pengembang yang Terkemuka dan Berkelanjutan di Indonesia',
            'misi' => 'Mengembangkan bisnis properti yang mendukung strategi dan program kerja Pemerintah Provinsi Daerah Khusus Ibukota Jakarta# Menjalin kemitraan strategis untuk menciptakan nilai (value creation) produk dan jasa yang dapat memberikan manfaat kepada masyarakat luas# Berperan aktif dalam mendorong pembangunan kawasan di perkotaan',
        ]);

        JajaranDireksi::create([
            'nama_panjang' => 'HARWIN U. TENGGANO',
            'jabatan' => 'Presiden Direktur',
            'pendapat' => 'Oke',
        ]);

        JajaranKomisaris::create([
            'nama_panjang' => 'ANDI MUH. IQBAL ARIEF',
            'jabatan' => 'Ketua Dewan Pengawas',
            'pendapat' => 'Oke',
        ]);

        Survey::create([
            'nama_panjang' => 'angga wahyu ferdani',
            'email' => 'angga@gmail.com',
            'nama_perusahaan' => 'PT SPERO MAHAKARYA NUSANTARA',
            'pesan' => 'debitis aspernatur ad. Accusamus velit odio minima in aliquid voluptates. Saepe autem perferendis nulla vero distinctio ad omnis laboriosam beatae molestias maiores, in cum molestiae repellendus nostrum cumque quia magni eos. debitis aspernatur ad. Accusamus velit odio minima in aliquid voluptates. Saepe autem perferendis nulla vero distinctio ad omnis laboriosam beatae molestias maiores, in cum molestiae repellendus nostrum cumque quia magni eos. debitis aspernatur ad. Accusamus velit odio minima in aliquid voluptates. Saepe autem perferendis nulla vero distinctio ad omnis laboriosam beatae molestias maiores, in cum molestiae repellendus nostrum cumque quia magni eos.',
        ]);
    }
}
