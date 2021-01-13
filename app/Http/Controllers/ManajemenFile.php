<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Fecades\Redirect;
use Illuminate\Support\Facades\Storage;
use Mail;
use App\Mail\KirimEmail;

use App\User;
use App\Guru;
use App\Folder;
use App\File;
use Carbon\Carbon;
use Alert;

use Session;
use Auth;
use DB;

class ManajemenFile extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Auth::user()->level == 'guru') {
        //     alert()->info('Informasi', 'Maaf akses ditolak');
        //     return redirect()->to('/');
        // }

        $datas = Folder::select(DB::raw('nm_folder, id_folder, name, id, folders.created_at'))
        ->join('users', 'users.id', '=', 'folders.id_user')
        ->get();

        $data_user = User::all();

        return view('file.index', compact('datas', 'data_user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $cek = Folder::where('nm_folder', $request->input('nm_folder'))->count();
        // if ($cek == 0) {
        //     Session::flash('message', 'Maaf Nama Folder sudah ada');
        //     Session::flash('message_type', 'danger');
        //     return redirect()->route('file.index');
        // }

        $this->validate($request, [
            'nm_folder' => 'required',
            'id_user' => 'required'
        ]);

        Folder::create([
            'nm_folder' => $request->get('nm_folder'),
            'id_user' => $request->get('id_user')
        ]);

        alert()->success('Berhasil', 'Folder telah di buat');
        return redirect()->route('file.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if (Auth::user()->level == 'guru') {
        //     alert()->info('Informasi', 'Maaf akses di tolak');
        //     return redirect()->to('/');
        // }

        // $detail = Folder::findOrFail($id);
        $detail = Folder::where('id_folder', $id)
        ->join('users', 'folders.id_user', '=', 'users.id')
        ->select('folders.*', 'users.name')
        ->first($id);

        $dataFile = Folder::where('id_folder', $id)
        ->join('files', 'folders.id_folder', '=', 'files.folder')
        ->select('folders.id_folder', 'files.*')
        ->get();

        return view('file.show', compact('detail', 'dataFile'));
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
            alert()->info('Informasi','Maaf Akses di larang!');
            return redirect()->to('/');
        }
        $data = Folder::findOrFail($id);
        return view('file.edit', compact('data'));
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
        Folder::where('id_folder', '=', $id)->update($request->except(['_token', '_method']));

        alert()->success('Berhasil', 'Data telah diubah');
        return redirect()->to('file');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Folder::where('id_folder',$id)->delete();
        alert()->success('Berhasil', 'Folder di hapus');
        return redirect()->back();
    }

    /**
    * Upload File
    *
    */
    public function upload(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                $files = $request->file('file');

                foreach ($files as $file) {
                   $fileExtension = $file->getClientOriginalExtension();
                   $fileSize      = $file->getClientSize();

                   $newName = uniqid() . '.' . $fileExtension;

                   Storage::disk('dropbox')->putFileAs('public/upload/', $file, $newName);
                   $this->dropbox->createSharedLinkWithSettings('public/upload/' . $newName);

                   File::create([
                    'nm_file' => $request->get('nm_file'),
                    'file'    => $newName,
                    'ukuran'  => $fileSize,
                    'folder'  => $request->get('folder')
                   ]);
                }

                alert()->success('Berhasil', 'File berhasil di upload');
                return redirect()->back();
            }
            
        } catch (\Exception $e) {
            return  "Pesan Error: {$e->getMessage()}";
            
        }
        
    }

    public function download($fileTitle)
    {
        try {
            return Storage::disk('dropbox')->download('public/upload/' . $fileTitle);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function hapusFile($id)
    {
        try {
            $file = File::find($id);
            Storage::disk('dropbox')->delete('public/upload/' . $file->file);
            $file->delete();

            alert()->success('Berhasil', 'File berhasil di hapus');
            return redirect()->back();
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function showFile($fileTitle)
    {
        try {
            $link = $this->dropbox->listSharedLinks('public/upload/' . $fileTitle);
            $raw = explode("?", $link[0]['url']);
            $path = $raw[0] . '?raw=1';
            $tempPath = tempnam(sys_get_temp_dir(), $path);
            $copy = copy($path, $tempPath);

            return response()->file($tempPath);
            
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function email($id)
    {
        $file = File::where('id_file', $id)
        ->join('folders', 'files.folder', '=', 'folders.id_folder')
        ->leftjoin('users', 'folders.id_user','=', 'users.id')
        ->select('folders.nm_folder', 'files.*', 'users.name')
        ->first($id);

        $users = User::all();

        return view('file.email', compact('file','users'));
    }

    public function sendMail(Request $request){
    // Mail::to($request->get('to'))
    // ->send(new KirimEmail($request->get('isi'), $request->get('from')));

    $link = $this->dropbox->listSharedLinks('public/upload/' . $request->get('isi'));
    $raw = explode("?", $link[0]['url']);
    $path = $raw[0] . '?raw=1';
    $tempPath = tempnam(sys_get_temp_dir(), $path);
    $copy = copy($path, $tempPath);

    $data = array('title' => $request->get('isi'), 'path' => $request->get('isi'));
        Mail::send('file.kirim-email', $data, function($message) use($request, $tempPath){
            $message->to($request->get('to'), 'a')->subject('Laravel file attachment and embed');
            $message->attach(storage_path('public/upload/'. $tempPath));
            $message->from($request->get('from'), 'as');
        });
    alert()->success('Berhasil', 'Email telah di kirim');
    return redirect()->back();
}
}
