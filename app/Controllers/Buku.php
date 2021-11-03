<?php
namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $bukuModel;
    public function __construct()
    {
        $this->bukuModel = new BukuModel();
    }
    public function index()
    {
   
        $data = [
            'title' => 'KoleksiBuku | Collection',
            'buku'  =>  $this->bukuModel->getBuku()
        ];

        return view('buku/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Buku',
            'buku'  => $this->bukuModel->getBuku($slug)
        ];

        // jika judul komik tidak ada di tabel
        if (empty($data['buku'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul buku' .$slug. 'tidak ditemukan');
        }

        return view('buku/detail', $data);
    }

    public function create()
    {
        // session();
        $data = [
            'title'     => 'Tambah Buku',
            'validation'=> $validation = \Config\Services::validation()
        ];
        return view('buku/create', $data);
    }

    public function save()
    { 
        // Validasi input
        if(!$this-> validate([
            'judul'     =>'required|is_unique[buku.judul]',
            'penulis'   =>'required[buku.penulis]',
            'penerbit'  =>'required[buku.penerbit]',
            'cover'     =>'max_size[cover,1024]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]'
        ])) {    
                return redirect()->to('/buku/create')->withInput();
        }
        // Ambil gambar
        $fileCover = $this->request->getFile('cover');

        // Apakah tidak ada gambar yang diupload
        if ($fileCover->getError()==4) {
            $namaCover = 'default.jpg';
        } else {
            // Ambil nama random
            $namaCover = $fileCover->getRandomName();
            
            // Pindahkan file ke folder img
            $fileCover->move('img', $namaCover);
        }

        // Ambil nama file
        // $namaCover = $fileCover->getName();

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bukuModel->save([
            'judul'     => $this->request->getVar('judul'),
            'slug'      => $slug,
            'penulis'   => $this->request->getVar('penulis'),
            'penerbit'  => $this->request->getVar('penerbit'),
            'cover'     => $namaCover
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/buku');
    }

    public function delete($id)
    {
        // Cari gambar berdasarkan id
        $buku   = $this->bukuModel->find($id);

        // Cek jika file gambarnya default jpg
        if ($buku['cover']!='default.jpg') {
        // Hapus gambar
        unlink('img/' .$buku['cover']);
        }
        $this->bukuModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/buku');
    }

    public function edit($slug)
    {
             $data = [
            'title'     => 'Ubah Buku',
            'validation'=> $validation = \Config\Services::validation(),
            'buku'=> $this->bukuModel->getBuku($slug)
        ];
        return view('buku/edit', $data);   
    }

    public function update($id)
    {
        $bukuLama = $this->bukuModel->getBuku($this->request->getVar('slug'));
        if ($bukuLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[buku.judul]';
        }

        if(!$this-> validate([
            'judul'     =>$rule_judul,
            'penulis'   =>'required[buku.penulis]',
            'penerbit'  =>'required[buku.penerbit]',
            'cover'     =>'max_size[cover,1024]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]'
        ])) {   
                return redirect()->to('/buku/edit/'. $this->request->getVar('slug'))->withInput();
        }
        // Menangkap gambar
        $fileCover = $this->request->getFile('cover');

        // cek gambar, apakah tetap gambar lama
        if ($fileCover->getError() == 4) {
            $namaCover = $this->request->getVar('coverLama');
        }else{
        // Generate nama file random
        $namaCover      = $fileCover->getRandomName();
        // Pndahkan gambar
        $fileCover->move('img', $namaCover);
        // Hapus file lama
        unlink('img/'. $this->request->getVar('coverLama'));
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bukuModel->save([
            'id'        => $id,
            'judul'     => $this->request->getVar('judul'),
            'slug'      => $slug,
            'penulis'   => $this->request->getVar('penulis'),
            'penerbit'  => $this->request->getVar('penerbit'),
            'cover'     => $namaCover
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/buku');
    }
}    