<?php

namespace App\Http\Controllers;

use App\Models\Booth;
use App\Http\Requests\StoreBoothRequest;
use App\Http\Requests\UpdateBoothRequest;
use Illuminate\Http\JsonResponse;

class BoothController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $booths = Booth::all();

        return response()->json([
            'code' => 200,
            'data' => $booths
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBoothRequest $request): JsonResponse
    {
        $request->validated();

        $booth = Booth::create([
            'name' => $request->name,
            'capacity' => (float)$request->capacity,
            'picture' => $request->picture,
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Stan Berhasil Ditambahkan',
            'data' => $booth
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBoothRequest $request, $uuid): JsonResponse
    {
        $request->validated();

        $booth = Booth::find($uuid);

        if ($request->has('name') && $booth->name !== $request->name) {
            $booth->name = $request->name;
        }

        if ($request->has('capacity') && $booth->capacity !== $request->capacity) {
            $booth->capacity = (float)$request->capacity;
        }

        if ($request->has('picture') && $booth->picture !== $request->picture) {
            $booth->picture = $request->picture;
        }

        if ($request->has('status') && $booth->status !== $request->status) {
            $booth->status = (float)$request->status;
        }

        if ($booth->isDirty('status')) {
            $booth->save();
            return response()->json([
                'code' => 200,
                'message' => 'Status Berhasil Diubah',
                'data' => $booth
            ]);
        }

        $booth->save();
        return response()->json([
            'code' => 200,
            'message' => 'Stan Berhasil Diubah',
            'data' => $booth
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        Booth::destroy($uuid);

        return response()->json([
            'code' => 200,
            'message' => 'Stan Berhasil Dihapus',
        ]);
    }
}
