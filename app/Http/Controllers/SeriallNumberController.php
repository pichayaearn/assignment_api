<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SeriallNumberController extends Controller
{
    public function getSerialNumber(Request $request)
    {
        $index_of_x = $request->input('index_of_x');
        $index_of_y = $request->input('index_of_y');
        $index_of_z = $request->input('index_of_z');
        $validator = Validator::make($request->all(), [
            'index_of_x' => 'required|integer|min:1',
            'index_of_y' => 'required|integer|min:1',
            'index_of_z' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            $response['errors']['detail'] = $validator->errors();
            $response['errors']['message'] = 'Validate input error';
            return response()->json($response, 400);
        }
        if (($index_of_x === $index_of_y) || ($index_of_x === $index_of_z) || ($index_of_y === $index_of_z)) {
            $response['errors']['message'] = 'Input must be sp';
            return response()->json($response, 400);

        }

        $x = (($index_of_x - 1) * $index_of_x) + 3;
        $y = (($index_of_y - 1) * $index_of_y) + 3;
        $z = (($index_of_z - 1) * $index_of_z) + 3;
        $response['data'] = (object) ["x" => $x, "y" => $y, "z" => $z];
        return response()->json($response, 200);

    }
}
