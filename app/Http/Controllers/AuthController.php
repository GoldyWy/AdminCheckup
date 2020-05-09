<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    public function logout(){
      Session::flush();
      return redirect('');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $time = Carbon::now()->toDateTimeString();
        // $pass = 'henry';
        // $enkripsi = password_hash($pass,PASSWORD_BCRYPT);
        // echo $enkripsi;
        $date = Carbon::parse(now()->toDateTimeString())->format('d F Y | G:i');

        dd($date);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
        'username' => 'required',
        'password' => 'required'
      ]);

      // // $password = password_hash("goldy",PASSWORD_BCRYPT);
      // // dd($password);
      $user = User::where('username', $request->username)->first();
      // dd($user);
      if ($user != null) {


        $passinput = $request->password;
        $datauser = $user->toArray();

        $samain = password_verify($passinput, $datauser['password']);
        if ($samain){
          Session::put('nama', $datauser['nama']);
          Session::put('username', $datauser['username']);
          Session::put('role', $datauser['role']);
          if (Session::get('role') == 'superadmin') {
            return redirect(url('superadmin/user'));
          }
          if (Session::get('role') == 'admin') {
            return redirect(url('admin/pasien'));
          }
          if (Session::get('role') == 'pegawai') {
            return redirect(url('pegawai/antrian'));
          }
          // dd("pass benar");

        }else {
          return redirect(url(''))->with(['failed' => 'Your password is incorrect ']);
          // dd("salah pass");
        }
      }else{
        // dd('email gaada');
        return redirect(url(''))->with(['failed' => 'Username is not registered']);
        // dd("salah username");
      }
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
