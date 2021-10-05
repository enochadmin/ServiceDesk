<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;


class ClientController extends Controller{

    public function index()
    {
        return client::all();
    }

    public function create()
    {
        //to be Implemented
    }
    public function store(Request $request)
    {
        $request->validate([
            'ClientName' => 'required',
            'ClientAddress' => 'required',
            'Representative_FirstName' => 'required',
            'Representative_LastName' => 'required',
            'Representative_email' => 'required',

        ]);
        Client::create($request->all());
    }
    public function show($id)
    {
        return Client::find($id);
        $client = Client::findOrFail($id)->get();
    }

    public function edit(Client $client)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $Client= client::find($id);
        $Client-> update($request->all());
        return $Client;

    }

    public function destroy($id)
    {
        return Client::destroy($id);
    }

    public function searchClient($ClientName)
    {
        return Client::where('ClientName','like','%'.$ClientName.'%')->get();
    }
}



