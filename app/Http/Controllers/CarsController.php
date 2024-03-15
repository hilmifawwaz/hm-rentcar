<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = new Car;
        $data = $cars->index();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('harga', function ($data) {
                return $data->harga_weekday . ' | ' . $data->harga_weekend;
            })
            ->addColumn('aksi', function ($data) {
                return view('properties.btn-cars')->with('data', $data);
            })
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
        $validatedData = Validator::make($request->all(), [
            'merk' => 'required',
            'jenis' => 'required',
            'plat' => 'required',
            'tahun' => 'required',
            'transmisi' => 'required',
            'harga_weekdays' => 'required',
            'harga_weekend' => 'required'
        ], [
            'merk.required' => 'Merk Mobil Wajib Diisi!',
            'jenis.required' => 'Jenis Mobil Wajib Diisi!',
            'plat.required' => 'Plat Nomor Wajib Diisi!',
            'tahun.required' => 'Tahun Mobil Wajib Diisi!',
            'transmisi.required' => 'Jenis Transmisi Wajib Diisi!',
            'harga_weekdays.required' => 'Harga Sewa Weekday Wajib Diisi!',
            'harga_weekend.required' => 'Harga Sewa Weekend Wajib Diisi!'
        ]);

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()]);
        } else {
            $data = [
                'merk' => $request->merk,
                'jenis' => $request->jenis,
                'plat_nomor' => $request->plat,
                'tahun' => $request->tahun,
                'tranmisi' => $request->transmisi,
                'harga_weekday' => $request->harga_weekdays,
                'harga_weekend' => $request->harga_weekend
            ];
            Car::create($data);
            return response()->json(['success' => 'Data berhasil ditambahkan']);
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
