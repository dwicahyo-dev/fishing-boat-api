<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreBoatRequest;
use App\Models\Boat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BoatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StoreBoatRequest $request)
    {
        $boat = DB::transaction(function () use ($request) {
            $boat = Auth::user()->boats()->create([
                'code' => $request->code,
                'name' => $request->name,
                'owner' => $request->owner,
                'address' => $request->address,
                'dimension' => $request->dimension,
                'captain' => $request->captain,
                'amount' => $request->amount,
                'picture' => $request->picture,
                'license_number' => $request->license_number,
                'document_license' => $request->document_license,
            ]);

            return $boat;
        });

        return response()->json([
            'status' => 'Created Boat successfully',
            'data' => [
                'boat' => $boat
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Boat  $boat
     * @return \Illuminate\Http\Response
     */
    public function show(Boat $boat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Boat  $boat
     * @return \Illuminate\Http\Response
     */
    public function edit(Boat $boat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Boat  $boat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Boat $boat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Boat  $boat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Boat $boat)
    {
        //
    }
}
