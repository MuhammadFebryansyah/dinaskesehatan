<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function profil()
    {
        $page = (object) [
            'title' => 'Profil Dinas Kesehatan',
            'content' => '<h2>Visi</h2><p>Mewujudkan masyarakat yang sehat dan sejahtera.</p><h2>Misi</h2><ul><li>Meningkatkan kualitas pelayanan kesehatan</li><li>Mengembangkan program pencegahan penyakit</li><li>Memberdayakan masyarakat dalam hidup sehat</li></ul>',
        ];
        
        return view('frontend.pages.profil', compact('page'));
    }
}