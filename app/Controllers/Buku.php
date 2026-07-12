<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    protected BukuModel $bukuModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
    }

    /**
     * GET /buku
     * Menampilkan seluruh data buku
     */
    public function index()
    {
        $data = [
            'title' => 'Data Buku Perpustakaan',
            'buku'  => $this->bukuModel->orderBy('id', 'DESC')->findAll(),
        ];

        return view('buku/index', $data);
    }

    /**
     * GET /buku/tambah
     * Menampilkan form tambah buku
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Buku',
        ];

        return view('buku/create', $data);
    }

    /**
     * POST /buku/simpan
     * Validasi + simpan data buku baru
     */
    public function store()
    {
        $rules = [
            'isbn'    => 'required|min_length[10]|max_length[20]|is_unique[buku.isbn]',
            'judul'   => 'required|min_length[3]|max_length[255]',
            'penulis' => 'required|min_length[3]|max_length[100]',
            'tahun'   => 'required|numeric|greater_than[1400]|less_than_equal_to[' . date('Y') . ']',
            'stok'    => 'required|numeric|greater_than_equal_to[0]',
        ];

        $messages = [
            'isbn' => [
                'required'   => 'ISBN wajib diisi.',
                'min_length' => 'ISBN minimal 10 karakter.',
                'is_unique'  => 'ISBN sudah terdaftar, gunakan ISBN lain.',
            ],
            'judul' => [
                'required'   => 'Judul buku wajib diisi.',
                'min_length' => 'Judul buku minimal 3 karakter.',
            ],
            'penulis' => [
                'required'   => 'Nama penulis wajib diisi.',
                'min_length' => 'Nama penulis minimal 3 karakter.',
            ],
            'tahun' => [
                'required'             => 'Tahun terbit wajib diisi.',
                'numeric'              => 'Tahun terbit harus berupa angka.',
                'greater_than'         => 'Tahun terbit tidak valid.',
                'less_than_equal_to'   => 'Tahun terbit tidak boleh melebihi tahun sekarang.',
            ],
            'stok' => [
                'required'             => 'Stok wajib diisi.',
                'numeric'              => 'Stok harus berupa angka.',
                'greater_than_equal_to'=> 'Stok tidak boleh bernilai negatif.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/buku/tambah')
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->bukuModel->save([
            'isbn'    => $this->request->getPost('isbn'),
            'judul'   => $this->request->getPost('judul'),
            'penulis' => $this->request->getPost('penulis'),
            'tahun'   => $this->request->getPost('tahun'),
            'stok'    => $this->request->getPost('stok'),
        ]);

        return redirect()->to('/buku')->with('sukses', 'Data buku berhasil ditambahkan!');
    }

    /**
     * GET /buku/edit/{id}
     * Menampilkan form edit buku
     */
    public function edit($id = null)
    {
        $buku = $this->bukuModel->find($id);

        if (!$buku) {
            return redirect()->to('/buku')->with('gagal', 'Data buku tidak ditemukan!');
        }

        $data = [
            'title' => 'Edit Buku',
            'buku'  => $buku,
        ];

        return view('buku/edit', $data);
    }

    /**
     * POST /buku/update/{id}
     * Validasi + update data buku
     */
    public function update($id = null)
    {
        $buku = $this->bukuModel->find($id);

        if (!$buku) {
            return redirect()->to('/buku')->with('gagal', 'Data buku tidak ditemukan!');
        }

        $rules = [
            'isbn'    => "required|min_length[10]|max_length[20]|is_unique[buku.isbn,id,{$id}]",
            'judul'   => 'required|min_length[3]|max_length[255]',
            'penulis' => 'required|min_length[3]|max_length[100]',
            'tahun'   => 'required|numeric|greater_than[1400]|less_than_equal_to[' . date('Y') . ']',
            'stok'    => 'required|numeric|greater_than_equal_to[0]',
        ];

        $messages = [
            'isbn' => [
                'required'   => 'ISBN wajib diisi.',
                'min_length' => 'ISBN minimal 10 karakter.',
                'is_unique'  => 'ISBN sudah digunakan buku lain.',
            ],
            'judul' => [
                'required' => 'Judul buku wajib diisi.',
            ],
            'penulis' => [
                'required' => 'Nama penulis wajib diisi.',
            ],
            'tahun' => [
                'required'           => 'Tahun terbit wajib diisi.',
                'numeric'            => 'Tahun terbit harus berupa angka.',
                'greater_than'       => 'Tahun terbit tidak valid.',
                'less_than_equal_to' => 'Tahun terbit tidak boleh melebihi tahun sekarang.',
            ],
            'stok' => [
                'required'              => 'Stok wajib diisi.',
                'numeric'               => 'Stok harus berupa angka.',
                'greater_than_equal_to' => 'Stok tidak boleh bernilai negatif.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/buku/edit/' . $id)
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->bukuModel->update($id, [
            'isbn'    => $this->request->getPost('isbn'),
            'judul'   => $this->request->getPost('judul'),
            'penulis' => $this->request->getPost('penulis'),
            'tahun'   => $this->request->getPost('tahun'),
            'stok'    => $this->request->getPost('stok'),
        ]);

        return redirect()->to('/buku')->with('sukses', 'Data buku berhasil diperbarui!');
    }

    /**
     * GET /buku/hapus/{id}
     * Menghapus data buku
     */
    public function delete($id = null)
    {
        $buku = $this->bukuModel->find($id);

        if (!$buku) {
            return redirect()->to('/buku')->with('gagal', 'Data buku tidak ditemukan!');
        }

        $this->bukuModel->delete($id);

        return redirect()->to('/buku')->with('sukses', 'Data buku berhasil dihapus!');
    }
}
