<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Managers\Api\Order\CreateManager;
use App\Managers\Api\Order\IndexManager;
use App\Managers\Api\Order\ShowManager;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller {

    protected $createManager;
    protected $indexManager;
    protected $howManager;

    public function __construct(
        CreateManager $createManager,
        IndexManager $indexManager,
        ShowManager $showManager
    ) {
        $this->createManager = $createManager;
        $this->indexManager  = $indexManager;
        $this->showManager = $showManager;
    }

    public function create(Request $request) {
        $order = $this->createManager->execute($request);

        return response()->json($order);
    }

    public function index(Request $request) {
        $orders = $this->indexManager->execute($request);

        return response()->json($orders);
    }
    public function show(string $id, Request $request) {
        $order = $this->showManager->execute($id, $request);

        return response()->json($order);
    }
}
