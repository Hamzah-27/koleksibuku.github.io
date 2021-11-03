<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'KoleksiBuku | Home'
        ];

        return view('pages/home', $data);
    }

        public function about()
    {
        $data = [
            'title' => 'KoleksiBuku | About'
        ];
        
        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'KoleksiBuku | Contact',
            'alamat' => [
            [
                'tipe' => 'Rumah',
                'alamat' => 'JL. Mayor zen No.44',
                'kota' => 'Palembang'
            ],
            [
                'tipe' => 'Kantor',
                'alamat' => 'JL. Ahmad Yani',
                'kota' => 'Palembang'
            ]
         ]
     ];

        return view('pages/contact', $data);
    }
}