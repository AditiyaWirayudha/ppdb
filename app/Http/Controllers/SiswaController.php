<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::all();
        $jurusan = Jurusan::all();
        return view('siswa.index', compact('siswa','jurusan'));
    }

    public function data() // Menambahkan DataTable
    {


        $siswa = Siswa::orderBy('id', 'desc')->get();

        return datatables()
        ->of($siswa)
        ->addIndexColumn()
        ->addColumn('jurusan', function($siswa){
            return !empty($siswa->jurusan->nama) ? $siswa->jurusan->nama : '-';
        })
        ->addColumn('aksi', function($siswa){
            return '
            
            <div class="btn-group">
                <button onclick="editData(`' .route('siswa.update', $siswa->id). '`)" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                <button onclick="deleteData(`' .route('siswa.destroy', $siswa->id). '`)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            </div>
        ';
    })
    ->rawColumns(['aksi'])
    ->make(true);
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
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jurusan' => 'required',
            'asal_sekolah' => 'required',
           
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $siswa = Siswa::create([
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'asal_sekolah' => $request->asal_sekolah,

        ]);

        return response()->json(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $barang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = Siswa::find($id);
        return response()->json($siswa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::find($id);
        return view ('siswa.index', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        $siswa->nama = $request->nama;
        $siswa->update();

        return response()->json('Data Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();

        return redirect('siswa');
    }
}
