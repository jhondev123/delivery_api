<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ToppingRequest;
use App\Application\DTO\Topping\ToppingDTO;
use App\Application\Services\ToppingsService;

class ToppingsController extends Controller
{
    public function __construct(private ToppingsService $toppingService) {}
    public function index()
    {
        return response()->json($this->toppingService->getAllToppings());
    }

    public function store(ToppingRequest $request)
    {
        $toppingDTO = new ToppingDTO(
            $request->input('name'),
            $request->input('description'),
            $request->input('price'),
            $request->input('group_id'),
        );
        $createdTopping = $this->toppingService->store($toppingDTO);
        return response()->json([
           'message' => 'Topping created successfully',
            'data' => $createdTopping,
        ]);
        
    }


    public function show(string $id)
    {
        return response()->json($this->toppingService->getToppingById($id));
        
    }

    public function update(ToppingRequest $request, string $id)
    {
        $toppingDTO = new ToppingDTO(
            $request->input('name'),
            $request->input('description'),
            $request->input('price'),
            $request->input('group_id'),
        );
        $updatedTopping = $this->toppingService->update($toppingDTO, $id);
        return response()->json([
           'message' => 'Topping updated successfully',
            'data' => $updatedTopping,
        ]);
        
    }


    public function destroy(string $id)
    {
        $this->toppingService->destroy($id);
        return response()->json(['message' => 'Topping deleted successfully']);
        
    }
}
