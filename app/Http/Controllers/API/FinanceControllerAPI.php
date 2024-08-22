<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FinanceResource;
use App\Models\Finance;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FinanceControllerAPI extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/finance",
     *      tags={"Finance"},
     *      summary="Get list transaction",
     *      description="mengambil data riwayat transaksi (masuk dan keluar)",
     *      operationId="get/finance",
     *      @OA\Parameter(
     *          name="limit",
     *          in="query",
     *          required=false,
     *          description="Limit value is number by default limit is 10. ex : ?limit=100",
     *          example="10",
     *          @OA\Schema(
     *              type="integer",
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="bulan",
     *          in="query",
     *          required=false,
     *          description="Untuk filter transaksi perbulan",
     *          example="01",
     *          @OA\Schema(
     *              type="integer",
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="return json array data"
     *      )
     * )
     */
    public function index(Request $request)
    {
        // dd($request->bulan);
        // if (!empty($request->bulan)) {
        //     return new FinanceResource(Finance::whereRaw("MONTH(tanggal) = $request->bulan")->paginate($request->limit));
        // } else {
        //     return new FinanceResource(Finance::paginate($request->limit));
        // }
        if ($request->bulan) {
            return FinanceResource::collection(Finance::whereRaw("MONTH(tanggal) = $request->bulan")->paginate($request->limit));
        } else {
            return FinanceResource::collection(Finance::paginate($request->limit));
        }

        // return FinanceResource::collection($data);
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
     *      path="/api/finance",
     *      tags={"Finance"},
     *      summary="Store transaction data",
     *      description="input data keuangan (pemasukan/pengeluaran)",
     *      operationId="finance/store",
     *      @OA\RequestBody(
     *          required=true,
     *          description="form data",
     *          @OA\JsonContent(
     *              required={"keterangan","tanggal"},
     *          @OA\Property(property="keterangan", type="string"),
     *          @OA\Property(property="masuk", type="number"),
     *          @OA\Property(property="keluar", type="number"),
     *          @OA\Property(property="tanggal", type="date"),
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
        // dd($request);
        $validatedData = Validator::make($request->all(), [
            'keterangan' => 'required',
            'masuk' => 'nullable',
            'keluar' => 'nullable',
            'tanggal' => 'required'
        ], [
            'keterangan' => "Keterangan wajib diisi!",
            'tanggal' => "Tanggal wajib diisi!"
        ]);

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()]);
        } else {
            $data = [
                'keterangan' => $request->keterangan,
                'masuk' => $request->masuk,
                'keluar' => $request->keluar,
                'tanggal' => $request->tanggal
            ];
            Finance::create($data);
            return response()->json([
                'status' => "success",
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
     * @OA\Patch(
     *      path="/api/finance/{id}",
     *      tags={"Finance"},
     *      summary="Edit transaction data",
     *      description="edit data transaksi",
     *      operationId="finance/edit",
     *      @OA\Parameter(
     *          name="id",
     *          description="insert transaction id on path",
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
     *              required={},
     *          @OA\Property(property="keterangan", type="string"),
     *          @OA\Property(property="masuk", type="number"),
     *          @OA\Property(property="keluar", type="number"),
     *          @OA\Property(property="tanggal", type="date"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response="default",
     *          description="return json array data"
     *      ),
     * )
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $validatedData = Validator::make($request->all(), [
            'keterangan' => 'sometimes|required',
            'masuk' => 'sometimes|required',
            'keluar' => 'sometimes|required',
            'tanggal' => 'sometimes|required'
        ], [
            'keterangan' => "Keterangan wajib diisi",
            'masuk' => "Jumlah uang masuk wajib diisi",
            'keluar' => "Jumlah uang keluar wajib diisi",
            'tanggal' => "Tanggal transaksi wajib diisi"
        ]);

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()]);
        } else {
            Finance::findOrFail($id)->update($request->all());
            return response()->json([
                'status' => 'success',
                'data' => $request->all()
            ]);
        }
        // Finance::findOrFail($id)->update($request->all());
        // return response()->json([
        //     'status' => 'success',
        //     'data' => $request->all()
        // ]);
    }

    /**
     * @OA\Delete(
     *      path="/api/finance/{id}",
     *      tags={"Finance"},
     *      summary="Delete transaction data",
     *      description="hapus data transaksi keuangan",
     *      operationId="finance/delete",
     *      @OA\Parameter(
     *          name="id",
     *          description="insert transaction id on path",
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
        $delete = Finance::findOrFail($id)->delete();
        if ($delete) {
            return response()->json([
                'status' => 'success',
            ]);
        }
    }
}
