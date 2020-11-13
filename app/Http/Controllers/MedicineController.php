<?php

namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $medicines = request()->user()->medicines;

        return response()->json([
            'medicines' => $medicines,
        ], 200);
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
        $this->validate($request, [
            'name'        => 'required|max:255',
            'description' => 'required',
            'amount' => 'required',
            'price' => 'required',
            'storedDate' => 'required'
        ]);

        $medicine = Medincine::create([
            'name'        => request('name'),
            'description' => request('description'),
            'amount'        => request('amount'),
            'price'        => request('price'),
            'storedDate'        => request('storedDate'),
            'user_id'     => Auth::user()->id
        ]);

        return response()->json([
            'medicine'    => $medicine,
            'message' => 'Success'
        ], 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicine $medicine)
    {
        $this->validate($request, [
            'name'        => 'required|max:255',
            'description' => 'required',
        ]);

        $medicine->name = request('name');
        $medicine->description = request('description');
        $medicine->amount = request('amount');
        $medicine->price = request('price');
        $medicine->storedDate = request('storedDate');
        $medicine->save();

        return response()->json([
            'message' => 'medicine updated successfully!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return response()->json([
            'message' => 'medicine deleted successfully!'
        ], 200);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
