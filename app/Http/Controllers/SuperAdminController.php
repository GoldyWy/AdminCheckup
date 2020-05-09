<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Jnscheckup;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('superadmin.dashboard');
    }

    public function postTambahJnscheckup(Request $request)
    {
      $this->validate($request,[
          'kode' => 'required|unique:jnscheckups,kode_jns_checkup',
          'nama' => 'required',
          'harga' => 'required'
        ],
        [
          'nama.required' => 'Nama Checkup tidak boleh kosong',
          'kode.required' => 'Kode tidak boleh kosong',
          'harga.required' => 'Harga tidak boleh kosong',
          'kode.unique' => 'Kode sudah tersedia'
        ]
      );

      $activity = Jnscheckup::create([
        'kode_jns_checkup' => $request->kode,
        'nama_jns_checkup' => $request->nama,
        'harga' => $request->harga,
        'status' => '1'
      ]);

      if ($activity) {
        return redirect(url('superadmin/jnscheckup'))->with(['success' => 'Berhasil membuat Checkup']);
      }else{
        return redirect(url('superadmin/jnscheckup'))->with(['failed' => 'Ada kesalahan']);
      }

    }

    public function getTambahJnscheckup()
    {
      return view('superadmin.tambahCheckup');
    }

    public function getJnscheckup()
    {
      $jnscheckup = Jnscheckup::where('status','1')->get();
      $countJnschehckup = $jnscheckup->count();
      if ($countJnschehckup>0) {
        $data['jnscheckup'] = $jnscheckup->toArray();
      }else{
        $data['jnscheckup'] = null;
      }

      return view('superadmin.jnscheckup', ['data' => $data]);
    }

    public function getTambahUser()
    {
      return view('superadmin.tambahUser');
    }

    public function postTambahUser(Request $request)
    {
      $this->validate($request,[
          'nama' => 'required',
          'username' => 'required',
          'password' => 'required|min:8',
          'role' => 'required'
        ],
        [
          'nama.required' => 'Isi nama anda',
          'username.required' => 'Isi username anda',
          'password.required' => 'Isi password anda',
          'role.required' => 'Pilih role anda',
          'password.min' => 'Panjang password minimal 8 huruf'
        ]
      );

      $enkripsi = PASSWORD_HASH($request->password,PASSWORD_BCRYPT);

      $activity = User::create([
        'nama' => $request->nama,
        'username' => $request->username,
        'password' => $enkripsi,
        'role' => $request->role
      ]);

      if ($activity) {
        return redirect(url('superadmin/user'))->with(['success' => 'User berhasil dibuat']);
      }else{
        return redirect(url('superadmin/user'))->with(['failed' => 'Ada kesalahan']);
      }

    }

    public function getAdmin()
    {
      $data['user'] = User::all()->toArray();


      return view('superadmin.user',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
