<?php

namespace App\Http\Controllers;

use App\Models\MenuType;
use App\Http\Requests\StoreMenuTypeRequest;
use App\Http\Requests\UpdateMenuTypeRequest;
use Illuminate\Http\JsonResponse;

class MenuTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menuType = MenuType::all();

        return response()->json([
            'code' => 200,
            'data' => $menuType
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuTypeRequest $request): JsonResponse
    {
        $request->validated();

        $menuType = MenuType::create([
            'name' => $request->name
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Jenis Menu Berhasil Ditambahkan',
            'data' => $menuType
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuTypeRequest $request, $uuid): JsonResponse
    {
        $request->validated();


        $menuType = MenuType::find($uuid);

        $menuType->name = $request->name;

        $menuType->save();

        return response()->json([
            'code' => 200,
            'message' => 'Jenis Menu Berhasil Diubah',
            'data' => $menuType
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        MenuType::destroy($uuid);

        return response()->json([
            'code' => 200,
            'message' => 'Jenis Menu Berhasil Dihapus',
        ]);
    }
}
