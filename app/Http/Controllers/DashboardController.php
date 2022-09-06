<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(Request $request){ 
        $sekolah = \Auth::user()->sekolah;
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);

        if ($sekolah) {
            $roles = Role::all();
            $users_query = \Auth::user()->sekolah->user;
            $users = [];
            
            foreach ($roles as $key => $role) {
                if ($role->name != 'super_admin' && $role->name != 'admin' && $role->name != 'yayasan') {
                    foreach ($users_query as $key => $user) {
                        $users[$role->name] = User::whereHas("roles", function($q) use ($role) { $q->where("name", $role->name); })->where('sekolah_id', $sekolah->id)->get();
                    }
                }
            }
            $siswas = Siswa::filter(request(['idk', 'idj', 'search']))->select('siswas.*', 'kelas.nama as kelas', 'kompetensis.kompetensi as jurusan')->leftJoin('kelas', 'kelas.id', 'siswas.kelas_id')->leftJoin('tahun_ajarans', 'kelas.tahun_ajaran_id', 'tahun_ajarans.id')->leftJoin('kompetensis', 'kompetensis.id', 'siswas.kompetensi_id')->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->where('kelas.sekolah_id', \Auth::user()->sekolah_id)->count();

            return view('dashboard', [
                'users' => $users,
                'yayasan' => User::whereHas("roles", function($q) use ($role) { $q->where("name", 'yayasan'); })->where('sekolah_id', $sekolah->id)->first(),
                'siswas' => $siswas
            ]);
        }else{
            return view('dashboard');
        }
    }
}
