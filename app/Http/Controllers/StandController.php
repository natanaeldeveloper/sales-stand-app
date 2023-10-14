<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStandRequest;
use App\Http\Requests\UpdateStandRequest;
use App\Http\Resources\StandCollection;
use App\Http\Resources\StandResource;
use App\Models\Stand;
use Illuminate\Http\Request;

class StandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $stands = Stand::paginate(10);

        return new StandCollection($stands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStandRequest $request)
    {
        $data = $request->all();

        $stand = Stand::create($data);

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.POST.success'),
            'data'      => new StandResource($stand),
        ], 202);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stand $stand)
    {
        return response()->json([
            'data'  => new StandResource($stand),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStandRequest $request, Stand $stand)
    {
        $stand->update($request->all());

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.PUT.success'),
            'data'      => new StandResource($stand)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stand $stand)
    {
        $stand->delete();

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.DELETE.success'),
            'id'        => $stand->id,
        ], 200);
    }
}
