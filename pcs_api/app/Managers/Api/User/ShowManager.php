<?php

namespace App\Managers\Api\User;
use App\Models\User;
use Illuminate\Http\Request;

class ShowManager {
    public function execute(Request $request) {
        $id = $request->route("user");

        $user = User::find($id);

        if ($user == null) return response()->json("User Not Found", 404);

        return $user;
    }
}
