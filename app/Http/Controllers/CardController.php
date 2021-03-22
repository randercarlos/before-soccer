<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardFormRequest;
use App\Models\Card;
use App\Services\CardService;
use Illuminate\Http\Request;

class CardController extends Controller
{
    private $cardService;

    public function __construct(CardService $cardService) {
        $this->cardService = $cardService;
    }

    public function index(Request $request)
    {
        return response()->json($this->cardService->loadAll($request));
    }

    public function show(int $id)
    {
        return response()->json($this->cardService->find($id));
    }

    public function store(CardFormRequest $request)
    {
        return response()->json($this->cardService->save($request), 201);
    }

    public function update(CardFormRequest $request, Card $card)
    {
        return response()->json($this->cardService->save($request, $card));
    }

}
