<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Http\Resources\MenuResource;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $menus = Menu::all();

        if ($request->has('type')) {
            $menus = Menu::where('menuTypeId', $request->type)->get();
        }

        return response()->json([
            'code' => 200,
            'data' => $menus
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $request->validated();

        $menu = Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => (float)$request->price,
            'picture' => $request->picture,
            'menuTypeId' => $request->menuTypeId
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Menu Berhasil Ditambahkan',
            'data' => $menu
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        $menu = Menu::find($uuid);

        return response()->json([
            'code' => 200,
            'data' => $menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, $uuid)
    {
        $request->validated();

        $menu = Menu::find($uuid);

        if ($request->has('name') && $menu->name !== $request->name) {
            $menu->name = $request->name;
        }

        if ($request->has('description') && $menu->description !== $request->description) {
            $menu->description = $request->description;
        }

        if ($request->has('price') && $menu->price !== $request->price) {
            $menu->price = (float)$request->price;
        }

        if ($request->has('picture') && $menu->picture !== $request->picture) {
            $menu->picture = $request->picture;
        }

        if ($request->has('status') && $menu->status !== $request->status) {
            $menu->status = (float)$request->status;
        }

        if ($request->has('menuTypeId') && $menu->menuTypeId !== $request->menuTypeId) {
            $menu->menuTypeId = $request->menuTypeId;
        }

        if ($menu->isDirty('status')) {
            $menu->save();
            return response()->json([
                'code' => 200,
                'message' => 'Status Berhasil Diubah',
                'data' => $menu
            ]);
        }

        $menu->save();
        return response()->json([
            'code' => 200,
            'message' => 'Menu Berhasil Diubah',
            'data' => $menu
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        Menu::destroy($uuid);

        return response()->json([
            'code' => 200,
            'message' => 'Menu Berhasil Dihapus',
        ]);
    }
}
