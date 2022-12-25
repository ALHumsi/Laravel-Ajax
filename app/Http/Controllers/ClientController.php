<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $data = Client::all();
        return view('clients.show', compact('data'));
    }

    public function store(Request $request)
    {
        if ($request->ajax())
        {
            $request->validate([
                'name' =>'required|string|max:255',
                'email' =>'required|string|email|max:255|unique:users',
                'position' =>'required|string|min:6',
                'mobile' => 'required|string|max:255',
            ]);

            $data = new Client;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->position = $request->position;
            $data->mobile = $request->mobile;
            $data->save();

            $row = $data;
            return view('clients.row', compact('row'));
        }
    }

    public function edit($id)
    {
        $data = Client::findOrFail($id);
        return response()->json($data);
    }


    public function update(Request $request)
    {
        if ($request->ajax())
        {
            $request->validate([
                'name' =>'required|string|max:255',
                'email' =>'required|string|email|max:255|unique:users',
                'position' =>'required|string|min:6',
                'mobile' => 'required|string|max:255',
            ]);

            $data = Client::findOrFail($request->id);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->position = $request->position;
            $data->mobile = $request->mobile;
            $data->save();

            $row = $data;
            return view('clients.rowEdit', compact('row'));
        }
    }

    public function delete($id)
    {
        Client::findOrFail($id)->delete();
        return response()->json(["message" => "Deleted successfully", 'id' => $id]);
    }
}
