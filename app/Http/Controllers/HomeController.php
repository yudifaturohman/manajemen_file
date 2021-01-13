<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guru;
use App\Folder;
use App\File;
use App\User;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $guru = Auth::user()->id;
        $folder = Folder::where('id_user', '=', $guru)->first();

        $jumG = Guru::count();
        $jumF = Folder::count();
        $jumFl = File::count();
        $jumKbA = File::sum('ukuran');

        $jumKb = Folder::select(DB::raw('distinct(id_user) as id,ukuran ,id_folder'))
        ->join('users', 'users.id', '=', 'folders.id_user')
        ->join('files', 'files.folder','=','folders.id_folder')
        ->where('id_user', '=', $guru)
        ->sum('ukuran');

        $datas = Folder::select(DB::raw('distinct(id_user) as id,nm_folder, id_folder, name, id, folders.created_at'))
        ->join('users', 'users.id', '=', 'folders.id_user')
        ->where('id_user', '=', $guru)
        ->get();

        return view('home', compact('jumG','jumF', 'jumFl','jumKb','datas', 'jumKbA'));
    }

     public function store(Request $request)
    {
        $this->validate($request, [
            'nm_folder' => 'required',
            'id_user' => 'required'
        ]);

        Folder::create([
            'nm_folder' => $request->get('nm_folder'),
            'id_user' => $request->get('id_user')
        ]);

        alert()->success('Berhasil', 'Folder telah di buat');
        return redirect()->back();
}
/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guru = Auth::user()->id;
        $folder = Folder::where('id_user', '=', $guru)->first();

        $jumKb = Folder::select(DB::raw('distinct(id_user) as id,ukuran ,id_folder'))
        ->join('users', 'users.id', '=', 'folders.id_user')
        ->join('files', 'files.folder','=','folders.id_folder')
        ->where('id_user', '=', $guru)
        ->sum('ukuran');

        $detail = Folder::where('id_folder', $id)
        ->join('users', 'folders.id_user', '=', 'users.id')
        ->select('folders.*', 'users.name')
        ->first($id);

        $dataFile = Folder::where('id_folder', $id)
        ->join('files', 'folders.id_folder', '=', 'files.folder')
        ->select('folders.id_folder', 'files.*')
        ->get();

        return view('guru.show', compact('detail', 'dataFile', 'jumKb'));
    }
}
