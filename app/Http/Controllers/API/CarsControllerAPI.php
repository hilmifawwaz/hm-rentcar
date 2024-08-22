<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;

class CarsControllerAPI extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/cars",
     *      tags={"Cars"},
     *      summary="Get list cars",
     *      description="get/mengambil data mobil",
     *      operationId="get/cars",
     *      @OA\Response(
     *          response="default",
     *          description="return json array data"
     *      )
     * )
     */
    public function index()
    {
        $data = Car::all();
        return response()->json([
            'status' => 'data berhasil diambil!',
            'data' => $data
        ]);
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
     * @OA\Post(
     *      path="/api/cars",
     *      tags={"Cars"},
     *      summary="Store cars data",
     *      description="input data mobil",
     *      operationId="cars/store",
     *      @OA\RequestBody(
     *          required=true,
     *          description="form data",
     *          @OA\JsonContent(
     *              required={"merk","jenis","plat","tahun","transmisi","harga_weekdays","harga_weekend"},
     *          @OA\Property(property="merk", type="string"),
     *          @OA\Property(property="jenis", type="string"),
     *          @OA\Property(property="plat", type="string"),
     *          @OA\Property(property="tahun", type="string"),
     *          @OA\Property(property="transmisi", type="string"),
     *          @OA\Property(property="harga_weekdays", type="string"),
     *          @OA\Property(property="harga_weekend", type="string"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response="default",
     *          description="return json array data"
     *      )
     * )
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
            return response()->json([
                'success' => 'Data berhasil ditambahkan',
                'data' => $data
            ]);
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
     * @OA\Patch(
     *      path="/api/cars/{id}",
     *      tags={"Cars"},
     *      summary="Edit cars data",
     *      description="input data mobil",
     *      operationId="cars/edit",
     *      @OA\Parameter(
     *          name="id",
     *          description="insert car Id on path",
     *          required=true,
     *          example="1",
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="form data",
     *          @OA\JsonContent(
     *              required={"merk","jenis","plat","tahun","transmisi","harga_weekdays","harga_weekend"},
     *          @OA\Property(property="merk", type="string"),
     *          @OA\Property(property="jenis", type="string"),
     *          @OA\Property(property="plat", type="string"),
     *          @OA\Property(property="tahun", type="string"),
     *          @OA\Property(property="transmisi", type="string"),
     *          @OA\Property(property="harga_weekdays", type="string"),
     *          @OA\Property(property="harga_weekend", type="string"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response="default",
     *          description="return json array data"
     *      )
     * )
     */
    public function edit($id, Request $request)
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
            Car::findOrFail($id)->update($data);
            return response()->json([
                'success' => 'Data berhasil diubah!',
                'data' => $data
            ]);
        }
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
     * @OA\Delete(
     *      path="/api/cars/{id}",
     *      tags={"Cars"},
     *      summary="Delete car data",
     *      description="hapus data mobil",
     *      operationId="cars/delete",
     *      @OA\Parameter(
     *          name="id",
     *          description="insert car Id on path",
     *          required=true,
     *          example="1",
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response="default",
     *          description="return json array data"
     *      )
     * )
     */
    public function destroy($id)
    {
        // $data = DB::table('mobil')->where('id_mobil', $id)->first();
        // if ($data != NULL) {
        //     $delete = $data->delete();
        //     return response()->json([
        //         'status' => 'data berhasil dihapus!',
        //         'data' => $data
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => 'gagal! data tidak ada'
        //     ]);
        // }
        $data = Car::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'data berhasil dihapus!',
            'data' => $data
        ]);
    }
}
