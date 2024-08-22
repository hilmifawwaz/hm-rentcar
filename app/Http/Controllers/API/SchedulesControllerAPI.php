<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Models\Finance;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchedulesControllerAPI extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/schedule",
     *      tags={"Schedule"},
     *      summary="Get list schedules",
     *      description="mengambil data jadwal peminjaman mobil",
     *      operationId="get/schedules",
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
     *          name="mulai",
     *          in="query",
     *          required=false,
     *          description="Tanggal awal untuk filter per-periode (opsional)",
     *          example="2024-03-18",
     *          @OA\Schema(
     *              type="string",
     *              format="date-time"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="selesai",
     *          in="query",
     *          required=false,
     *          description="Tanggal akhir untuk filter per-periode (opsional)",
     *          example="2024-03-18",
     *          @OA\Schema(
     *              type="string",
     *              format="date-time"
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
        // dd($request->mulai);
        $data = Schedule::with('mobil');
        if ($request->mulai) {
            $data->where('mulai', $request->mulai);
        }
        if ($request->selesai) {
            $data->where('selesai', $request->selesai);
        }


        // return response()->json([
        //     'status' => 'data berhasil diambil!',
        //     'data' => $data->paginate($request->limit)
        // ]);
        return ScheduleResource::collection($data->paginate($request->limit));
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
     *      path="/api/schedule",
     *      tags={"Schedule"},
     *      summary="Store schedules data",
     *      description="input data jadwal peminjaman mobil",
     *      operationId="schedule/store",
     *      @OA\RequestBody(
     *          required=true,
     *          description="form data",
     *          @OA\JsonContent(
     *              required={"id_mobil","nama_pelanggan","mulai","selesai","harga","jaminan","status","status_pembayaran"},
     *          @OA\Property(property="id_mobil", type="number"),
     *          @OA\Property(property="nama_pelanggan", type="string"),
     *          @OA\Property(property="mulai", type="datetime"),
     *          @OA\Property(property="selesai", type="datetime"),
     *          @OA\Property(property="harga", type="string"),
     *          @OA\Property(property="jaminan", type="string"),
     *          @OA\Property(property="status", type="string"),
     *          @OA\Property(property="status_pembayaran", type="string"),
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
            'id_mobil' => 'required|numeric',
            'nama_pelanggan' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            'harga' => 'required',
            'jaminan' => 'required',
            'status' => 'required',
            'status_pembayaran' => 'required'
        ], [
            'id_mobil' => 'Jenis mobil wajib diisi!',
            'nama_pelanggan' => 'Nama pelanggan wajib diisi!',
            'mulai' => 'Waktu mulai wajib diisi!',
            'selesai' => 'Waktu selesai wajib diisi!',
            'harga' => 'Harga sewa wajib diisi!',
            'jaminan' => 'Jaminan wajib diisi!',
            'status' => 'Status sewa wajib diisi!',
            'status_pembayaran' => 'Status pembayaran wajib diisi!'
        ]);

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()]);
        } else {
            $data = [
                'id_mobil' => $request->id_mobil,
                'nama_pelanggan' => $request->nama_pelanggan,
                'mulai' => $request->mulai,
                'selesai' => $request->selesai,
                'harga' => $request->harga,
                'jaminan' => $request->jaminan,
                'status' => $request->status,
                'status_pembayaran' => $request->status_pembayaran
            ];
            Schedule::create($data);
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
        $data = Schedule::with('mobil')->where('id_jadwal', $id)->first();
        return ScheduleResource::collection($data);
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
     *      path="/api/schedule/{id}",
     *      tags={"Schedule"},
     *      summary="Edit schedule data",
     *      description="edit data jadwal persewaan",
     *      operationId="schedule/edit",
     *      @OA\Parameter(
     *          name="id",
     *          description="insert schedule Id on path",
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
     *              required={"id_mobil","nama_pelanggan","mulai","selesai","harga","jaminan","status","status_pembayaran"},
     *          @OA\Property(property="id_mobil", type="number"),
     *          @OA\Property(property="nama_pelanggan", type="string"),
     *          @OA\Property(property="mulai", type="datetime"),
     *          @OA\Property(property="selesai", type="datetime"),
     *          @OA\Property(property="harga", type="string"),
     *          @OA\Property(property="jaminan", type="string"),
     *          @OA\Property(property="status", type="string"),
     *          @OA\Property(property="status_pembayaran", type="string"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response="default",
     *          description="return json array data"
     *      )
     * )
     */
    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
            'id_mobil' => 'required|numeric',
            'nama_pelanggan' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            'harga' => 'required',
            'jaminan' => 'required',
            'status' => 'required',
            'status_pembayaran' => 'required'
        ], [
            'id_mobil' => 'Jenis mobil wajib diisi!',
            'nama_pelanggan' => 'Nama pelanggan wajib diisi!',
            'mulai' => 'Waktu mulai wajib diisi!',
            'selesai' => 'Waktu selesai wajib diisi!',
            'harga' => 'Harga sewa wajib diisi!',
            'jaminan' => 'Jaminan wajib diisi!',
            'status' => 'Status sewa wajib diisi!',
            'status_pembayaran' => 'Status pembayaran wajib diisi!'
        ]);

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()]);
        } else {
            $data = [
                'id_mobil' => $request->id_mobil,
                'nama_pelanggan' => $request->nama_pelanggan,
                'mulai' => $request->mulai,
                'selesai' => $request->selesai,
                'harga' => $request->harga,
                'jaminan' => $request->jaminan,
                'status' => $request->status,
                'status_pembayaran' => $request->status_pembayaran
            ];
            Schedule::findOrFail($id)->update($data);
            return response()->json([
                'success' => 'Data berhasil diperbarui',
                'data' => $data
            ]);
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/schedule/{id}",
     *      tags={"Schedule"},
     *      summary="Delete schedule data",
     *      description="hapus data jadwal persewaan",
     *      operationId="schedule/delete",
     *      @OA\Parameter(
     *          name="id",
     *          description="insert schedule Id on path",
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
        $data = Schedule::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'data berhasil dihapus',
            'data' => $data
        ]);
    }

    public function checkSchedule($start, $end)
    {
        $data = Schedule::with('mobil')->where('mulai', $start)->where('selesai', $end)->first();
        return ScheduleResource::collection($data);
    }

    /**
     * @OA\Patch(
     *      path="/api/schedule/status/{id}",
     *      tags={"Schedule"},
     *      summary="Update schedule status",
     *      description="memperbarui status penyewaan (booking, proses, selesai)",
     *      operationId="schedule/status/update",
     *      @OA\Parameter(
     *          name="id",
     *          description="insert schedule Id on path",
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
     *              required={"status", "status_pembayaran"},
     *          @OA\Property(property="status", type="string"),
     *          @OA\Property(property="status_pembayaran", type="string"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="return json array data"
     *      )
     * )
     */
    public function updateStatus(Request $request, $id)
    {
        $data = [
            'status' => $request->status,
            'status_pembayaran' => $request->status_pembayaran
        ];
        $update = Schedule::findOrFail($id);
        $update->update($data);
        // dd($update);
        if ($update != NULL) {
            $this->keuangan($update->harga);
        }
        return response()->json([
            'success' => 'Status berhasil diperbarui',
            'data' => $data
        ]);
    }

    public function keuangan($request)
    {
        $data = [
            'keterangan' => "uang masuk " . date('d-m-Y'),
            'masuk' => intval($request)
        ];
        // dd($data);
        Finance::create($data);
    }
}
