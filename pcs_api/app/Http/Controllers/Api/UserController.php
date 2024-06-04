<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Managers\Api\User\ShowManager;
use Illuminate\Http\Request;

class UserController extends Controller {

    protected $createManager;
    protected $showManager;

    public function __construct(
        ShowManager $showManager
    ) {
        $this->showManager = $showManager;
    }

    public function show(Request $request) {
        $user = $this->showManager->execute($request);

        return response()->json([
            'success' => true,
            'user'    => $user,
        ]);
    }
}
