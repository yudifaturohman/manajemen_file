<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Fecades\Redirect;

use App\User;
use Alert;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->level == 'guru') {
            alert()->info('Informasi', 'Maaf Akses ditolak');
            return redirect()->to('/');
        }
        $datas = User::where('level', '=', 'guru')
        ->get();
        return view('manage_user.index', compact('datas'));
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
            alert()->info('Informasi', 'Maaf akses dilarang');
            return redirect()->to('/');
        }

        $data = User::findOrFail($id);
        return view('manage_user.edit', compact('data'));
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
        $this->validate($request, [
            'password' => 'required|string|min:6'
        ]);

        User::where('id', '=', $id)->update([
            'password' => bcrypt(($request->input('password')))
        ]);
        alert()->success('Berhasil', 'Password berhasil di ubah');
        return redirect()->route('manage_user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', '=', $id)->delete();
        alert()->success('Berhasil', 'Data telah di hapus');
        return redirect()->route('manage_user.index');
    }
}
