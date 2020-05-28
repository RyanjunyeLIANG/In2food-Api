<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use App\Address;

class WarehouseController extends Controller
{   
    public function index() {
        $warehouses = Warehouse::with('address')->get()->toJson(JSON_PRETTY_PRINT);
        return response($warehouses, 200);
    }

    public function store(Request $request) {
        $warehouse = Warehouse::firstOrCreate($request->only('warehouseName', 'phone'));
        // $warehouse = new Warehouse;
        // $warehouse->warehouseName = $request->warehouseName;
        // $warehouse->phone = $request->phone;
        $address = Address::firstOrNew($request->only('street', 'suburb', 'state', 'postcode'));
        // $address = new Address;
        // $address->street = $request->street;
        // $address->suburb = $request->suburb;
        // $address->state = $request->state;
        // $address->postcode = $request->postcode;
        $address->addressable()->associate($warehouse);
        $address->save();

        return response()->json($warehouse, 201);
    }

    public function addAddress(Warehouse $warehouse, Address $address) {
        $warehouse->address()->associate($address);
        $warehouse->save();
        $warehouse->load('warehouses', 'address');
    }

    public function show(Warehouse $warehouse) {
       $warehouse->load('address');
       return response($warehouse, 200);
    }

    public function update(Request $request, Warehouse $warehouse) {
        $warehouse->update($request->all());
        $warehouse->load('address');
        return $warehouse;
    }

    public function destroy(Warehouse $warehouse) {
        $warehouse->address()->delete();
        $warehouse->delete();

        return 'deleted';
    }
}
