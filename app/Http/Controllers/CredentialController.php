<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use App\Http\Requests\StoreCredentialRequest;
use App\Http\Requests\UpdateCredentialRequest;

class CredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $credential = Credential::all();

        return response()->json([
            'code' => 200,
            'data' => $credential
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCredentialRequest $request)
    {
        $request->validated();

        $credential = Credential::create($request->all());

        return response()->json([
            'code' => 200,
            'message' => 'Rekening Berhasil Ditambahkan',
            'data' => $credential
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCredentialRequest $request, $uuid)
    {
        $request->validated();

        $credential = Credential::find($uuid);

        if ($request->has('accountName') && $credential->accountName !== $request->accountName) {
            $credential->accountName = $request->accountName;
        }

        if ($request->has('accountNumber') && $credential->accountNumber !== $request->accountNumber) {
            $credential->accountNumber = $request->accountNumber;
        }

        if ($request->has('bank') && $credential->bank !== $request->bank) {
            $credential->bank = $request->bank;
        }

        $credential->save();

        return response()->json([
            'code' => 200,
            'message' => 'Rekening Berhasil Diubah',
            'data' => $credential
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        Credential::destroy($uuid);

        return response()->json([
            'code' => 200,
            'message' => 'Rekening Berhasil Dihapus',
        ]);
    }
}
