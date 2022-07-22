<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Status;
use DateTime;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas2 = Anggota::all();
        $datas1 = User::all();
        $datas3 = Buku::all();
        $datas = Peminjaman::where('status', 'like', '%dipinjam%')->get();
        return view('peminjam.index', compact('datas', 'datas2', 'datas1', 'datas3'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas2 = Anggota::all();
        $datas1 = User::all();
        // $datas3 = Buku::all();
        $datas7 = Buku::where('stok','>=', 1)->get();
        $datas = Peminjaman::all();
        return view('peminjam.create', compact('datas', 'datas2', 'datas1', 'datas7'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate(
            [
                'tgl_pinjam' => 'required',
                'id_anggota' => 'required',
                'id_buku' => 'required',
                'id_pengguna' => 'required'
                
            ],
            [
                'tgl_pinjam.required' => 'Wajib di isi !',
                'id_anggota.required' => 'Wajib di isi !',
                'id_buku.required' => 'Wajib di isi !',
                'id_pengguna.required' => 'Wajib di isi !'
                ]
            );
            
            $fdate = $request->tgl_pinjam;
            $tdate = $request->tgl_kembali;
            $datetime1 = new DateTime($fdate);
            $datetime2 = new DateTime($tdate);
            $interval = $datetime1->diff($datetime2);
            //now do whatever you like with $days
            

        $dtpeminjam = new Peminjaman();
        $dtpeminjam->tgl_pinjam = $request->tgl_pinjam;
        $dtpeminjam->id_anggota = $request->id_anggota;
        $dtpeminjam->lama_terlambat = $interval->format('%a');

        $dtpeminjam->id_buku = $request->id_buku;
        $dtpeminjam->id_pengguna = $request->id_pengguna;

        $dtpeminjam->status = 'dipinjam';
        $dtpeminjam->save();

        $buku = Buku::find($request->id_buku);
        $buku->stok -= 1;
        $buku->save();

        return redirect('peminjam')->with('toast_success', 'Data Berhasil di Simpan');
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



        $peminjam = Peminjaman::findorfail($id);
        $peminjam->status = 'Dikembalikan';
        $datas2 = Anggota::all();
        $datas1 = User::all();
        $datasb = Peminjaman::select('id_buku')->where('id', $id)->first();
        $datas3 = Buku::all();
        $datas = Peminjaman::all();
        $denda = Denda::all();
        return view('peminjam.detail-peminjam', compact('denda', 'peminjam', 'datas', 'datas2', 'datas1', 'datas3', 'datasb'));
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
        $anggota = Peminjaman::select('id_anggota')->where('id', $id)->first();
        $status = Anggota::select('status_id')->where('id',$anggota['id_anggota'])->first();
        $batas_hari = Status::select('batas_hari')->where('id', $status['status_id'])->first();
        $batas_hari1 = date("d", strtotime($batas_hari));
        // Ambil batas hari
        $tgl = Peminjaman::select('tgl_pinjam')->where('id', $id)->first();
        $tgl1 = date("d", strtotime($tgl['tgl_pinjam']));
        $tgk = $request->tgl_kembali;
        $tgg1 = date("d", strtotime($tgk));
        $hsl = $tgg1 - ($tgl1 + $batas_hari1);
        // Ambil kelebihan hari

        if($request->id_denda == 1) {
            $denda = 15000;
        }elseif ($request->id_denda == 2){
            if ($hsl >= 1){
                $denda = $hsl * 1000;
            }else {
                $denda = 0;
            }
        }else {
            $denda = 0;
        }
        //Kalkulasi Denda
        $peminjam = Peminjaman::findorfail($id);
        $peminjam->status = 'Dikembalikan';
        $peminjam->total_denda = $denda ;
        $peminjam->update($request->all());

        $buku = Buku::find($request->id_buku);
        $buku->stok += 1;
        $buku->save();

        return redirect('peminjam')->with('toast_success', 'Buku Telah Berhasil Dikembalikan');
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

    public function updateStatus($id)
    {

        // $dtpeminjam = Peminjaman::findorfail($id);
        // $dtpeminjam->status = 'Dikembalikan';
        // $dtpeminjam->save();

        // return back()->with('toast_success', 'Buku Telah di Kembalikan');
    }

    public function export()
    {
        $cek = Peminjaman::all();
        $datas = DB::table('peminjaman')
                    ->join('anggota', 'peminjaman.id_anggota', '=', 'anggota.id')
                    ->join('users', 'peminjaman.id_pengguna', '=', 'users.id')
                    ->join('buku', 'peminjaman.id_buku', '=', 'buku.id')
                    ->select('anggota.nama_anggota', 'users.name', 'peminjaman.tgl_pinjam','peminjaman.tgl_kembali', 'buku.judul_buku', 'peminjaman.status')
                    ->get();
        // dd($datas);
        return view('peminjam.export', compact('datas'));
    }
}
