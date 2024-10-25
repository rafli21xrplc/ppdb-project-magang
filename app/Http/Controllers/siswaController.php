<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Http\Request;

class siswaController extends Controller
{
    public function __cunstruct()
    {
        $this->middleware('guest');
    }

    protected function index()
    {
        return view('pendaftaran');
    }

    protected function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:siswas',
            'telepon' => 'required',
            'jurusan' => 'required',
            'dokumen' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $dokumenPath = $request->file('dokumen')->store('dokumen', 'public');

        siswa::created([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'jurusan' => $request->jurusan,
            'dokumen' => $dokumenPath,
        ]);

        return redirect()->route('cek-status')->with('success', 'Pendaftaran berhasil.');
    }

    public function cekStatus(Request $request)
    {
        $siswa = null;

        if ($request->has('email')) {
            $siswa = Siswa::where('email', $request->input('email'))->first();

            if (!$siswa) {
                return redirect()->back()->with('error', 'Email tidak ditemukan.');
            }
        }

        return view('cek-status', compact('siswa'));
    }

    public function pengumuman()
    {
        $pengumuman = [
            ['judul' => 'Pengumuman 1', 'isi' => 'Pendaftaran dibuka hingga 30 September.'],
            ['judul' => 'Pengumuman 2', 'isi' => 'Ujian berlangsung pada 15 Oktober.'],
            ['judul' => 'Pengumuman 3', 'isi' => 'Hasil ujian akan diumumkan pada 1 November.'],
        ];

        return view('pengumuman', compact('pengumuman'));
    }
}
