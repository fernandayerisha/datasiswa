<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

use App\Siswa;
use App\model_login;

class AdminController extends Controller
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
        
    }

	public function home()
	{
		$siswa = Siswa::all();

        $perempuan = DB::table('siswa')
                     ->select(DB::raw('count(*) as perempuan_count'))
                     ->where('j_k', '=', 'perempuan')
                     ->get();
        $laki = DB::table('siswa')
                     ->select(DB::raw('count(*) as laki_count'))
                     ->where('j_k', '=', 'laki-laki')
                     ->get();
        $total = DB::table('siswa')
                     ->select(DB::raw('count(*) as total'))
                     ->get();

        return view('home', array(
                'siswa' => $siswa,
                'perempuan' => $perempuan,
                'laki' => $laki,
                'total' => $total
                ));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modal_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $siswa = new Siswa;
        $siswa->nis          = $request->nis;
        $siswa->nama         = $request->nama;
        $siswa->tgl_lahir    = $request->tgl_lahir;
        $siswa->j_k          = $request->j_k;
        $siswa->alamat       = $request->alamat;
        $siswa->save();
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
      //   $siswa = Siswa::find($id);
      //   if(!$siswa)
      //   {
      //     abort(404);
      //   }

      // return view('modal_edit', array(
      //   'siswa' => $siswa
      //   ));
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
          $siswa = Siswa::find($id);
          $siswa->nis       = $request->nis;
          $siswa->nama      = $request->nama;
          $siswa->tgl_lahir = $request->tgl_lahir;
          $siswa->j_k       = $request->j_k;
          $siswa->alamat    = $request->alamat;
          $siswa->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $siswa = Siswa::find($id);
          if(!$siswa){
            abort(404);
            $return['status'] = 'error';
          }else{
            $return['status'] = 'success';
            $siswa->delete();
          }
          return $return;
    }

    public function delete($id)
    {
    	$i = DB::table('siswa')->where('id', $id)->delete();
    	if ($i > 0) 
    	{
    		return view('home');
    	}
    }

    public function modal_create(Request $request)
    {
      return view('modal_create');
    }

    public function modal_edit(Request $request)
    {
        $siswa = Siswa::find($request->id);
        return view('modal_edit', array(
            'siswa' => $siswa  
            ));
    }

    public function modal_delete(Request $request)
    {
        $siswa = Siswa::find($request->id);
        return view('modal_delete', array(
            'siswa' => $siswa  
            ));
    }

    // untuk validasi form
      public function validation(Request $request)
      {
        $return = array();

        $rules = array(
            'nis'         => 'required|integer',
            'nama'        => 'required',
            'tgl_lahir'   => 'required',
            'j_k'         => 'required',
            'alamat'      => 'required',
            '_token'      => 'required'
        );
          $messages = array(
              'required'  => 'Kolom ini harus diisi.',
              'integer'   => 'Kolom harus berisi angka'
          );

          $validator  = Validator::make($request->all(), $rules, $messages);

          if (!$validator->fails()){
            $return['status'] = 'success';
          } else {
            $return['status'] = 'error';
            $return['message'] = $validator->messages();
          }

          return $return;
      }

      // fungsi untuk validasi pada form penambahan product+simpan ke db
      public function do_create(Request $request)
      {
        $validasi = $this->validation($request);
        if ($validasi['status'] == 'success')
        {
          $this->store($request);
        }else {
          return $validasi;
        }
      }

      // fungsi untuk validasi pada form edit product+simpan ke db
        public function do_edit(Request $request, $id)
        {
          $validasi = $this->validation($request);
          if ($validasi['status'] == 'success')
          {
            $this->update($request, $id);
          }else {
            return $validasi;
          }
        }

        public function do_delete(Request $request)
        {
          $id = $request->id;
          if(empty($id)){
            $return['status'] = 'error';
          }else{
            Siswa::destroy($id);
            $return['status'] = 'success';
          }
          return $return;
        }

        public function chartjs()
        {
            $year = 1996;
            $perempuan = DB::table('siswa')
                     ->select(DB::raw('count(*) as perempuan_count'))
                     ->where('j_k', '=', 'perempuan')
                     ->get();
            $laki = DB::table('siswa')
                     ->select(DB::raw('count(*) as laki_count'))
                     ->where('j_k', '=', 'laki-laki')
                     ->get();
            $tahun = DB::table('siswa')
                      ->select(DB::raw('YEAR(tgl_lahir) as thn'), DB::raw('COUNT(id) as jumlah'))
                      ->groupBy('thn')
                      ->get();
            return view('chartjs', array(
                'perempuan' => $perempuan,
                'laki' => $laki,
                'tahun' => $tahun
                ));
        }

        
}
