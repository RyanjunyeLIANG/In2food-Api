<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\Warehouse;

class AddressController extends Controller
{

    public function index() {
        return response(Address::get()->toJson(JSON_PRETTY_PRINT), 200);
    }

    public function store(Request $request) {
        Address::create($request->all());

        return response(Address::create($request->all()), 201);
    }

    public function show(Address $address) {
        return response($address, 200);
    }

    public function update(Request $request, Address $address) {
        $address->update($request->all());
        return $address;
    }

    public function destroy(Address $address) {
        $address->delete();

        return 'deleted';
    }
}
