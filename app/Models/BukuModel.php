<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul','slug','penulis','penerbit','cover'];

    public function getBuku($slug = false)
    {
        if($slug == false){
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function search($cari)
    {
        return $this->table('buku')->like('judul', $cari)->orLike('penulis', $cari);
    }
}