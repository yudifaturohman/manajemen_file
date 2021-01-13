<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Fecades\Redirect;

use App\User;
use App\Guru;
use Carbon\Carbon;
use Alert;

use Session;
use Auth;
use DB;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->level == 'guru') {
            Alert::info('Maaf akses di tolak !');
            return redirect()->to('/');
        }
        // $datas = Guru::get();
        $datas = Guru::select(DB::raw("users.id as id_users,id_guru ,nik, nama, password, level"))
        ->leftjoin('users', 'users.username', '=', 'gurus.nik')
        ->get();
        return view('guru.index', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = Guru::where('nik', $request->input('nik'))->count();
        if ($cek > 0) {
            Session::flash('message', 'Maaf NIP sudah ada');
            Session::flash('message_type', 'danger');
            return redirect()->to('guru');
        }

        $this->validate($request, [
            'nik' => 'required|max:20',
            'nama' => 'required|string|max:30',
            'tmp_lhr' => 'required|string|max:30',
            'tgl_lhr' => 'required|date|max:30',
            'jk' => 'required'
        ]);
        
        Guru::create([
            'nik' => $request->get('nik'),
            'nama' => $request->get('nama'),
            'tmp_lhr' => $request->get('tmp_lhr'),
            'tgl_lhr' => $request->get('tgl_lhr'),
            'jk' => $request->get('jk')
        ]);

        alert()->success('Berhasil', 'Data sudah di tambahkan');
        return redirect()->route('guru.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->level == 'guru') {
            Alert::info('Maaf akses di tolak !');
            return redirect()->to('/');
        }

        $detail = Guru::where('id_guru', '=', $id)
        ->first();

        return view('guru.detail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->level == 'guru') {
            Alert::info('Maaf akses di tolak !');
            return redirect()->to('/');
        }

        $detail = Guru::where('id_guru','=', $id)
        ->first();

        return view('guru.edit', compact('detail'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Guru::where('id_guru', '=', $id)->update($request->except(['_token', '_method']));

        alert()->success('Berhasil', 'Data telah diubah');
        return redirect()->to('guru');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Guru::where('id_guru', '=', $id)->delete();
        alert()->success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('guru.index');
    }

    /**
    * Register Akun Guru
    * 
    */
    public function register($id)
    {
        if (Auth::user()->level == 'guru') {
            Alert::info('Maaf akses di tolak !');
            return redirect()->to('/');
        }

        $register = Guru::where('id_guru', '=', $id)
        ->first();
        return view('guru.register', compact('register'));
    }

    /**
    * Tambah data user baru
    */
    public function addUser(Request $request)
    {
        $count = User::where('username',$request->input('username'))->count();

        if($count>0){
            Session::flash('message', 'Already exist!');
            Session::flash('message_type', 'danger');
            return redirect()->to('guru.index');
        }

        $this->validate($request, [
            'name' => 'required|string|max:30',
            'username' => 'required|string|max:10|unique:users',
            'email' => 'required|string|email|max:30|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);


        if($request->file('foto') == '') {
            $gambar = NULL;
        } else {
            $file = $request->file('foto');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('foto')->move("images/user", $fileName);
            $gambar = $fileName;
        }

        User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'level' => 'guru',
            'password' => bcrypt(($request->input('password'))),
            'foto' => $gambar
        ]);

        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('guru.index');
    }
}
