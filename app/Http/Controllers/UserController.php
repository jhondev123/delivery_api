<?php

namespace App\Http\Controllers;

use App\Application\DTO\AddressDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Application\Services\AddressService;
use App\Application\Services\User\UserService;
use App\Http\Requests\AddressRequest;

class UserController extends Controller
{
    public function __construct(private AddressService $addressService, private UserService $userService) {}
    public function profile()
    {
        $user = Auth::user()->load('addresses');
        return response()->json($user);
    }
    public function storeAddress(AddressRequest $request)
    {
        $dto = new AddressDTO(
            $request->street,
            $request->city,
            $request->state,
            $request->country,
            $request->district,
            $request->number,
            $request->complement,
            $request->zip_code
        );
        try {

            return response()->json([
                'message' => 'Address created successfully',
                'data' => $this->addressService->store($dto, Auth::id())
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function removeAddress(string $id)
    {

        $this->addressService->destroy($id);
        return response()->json(['message' => 'Address removed successfully']);
    }
    public function index(Request $request)
    {
        $search = "";
        if (isset($request->search)) {
            $search = $request->search;
        }
        return response()->json($this->userService->index($search));
    }
    public function show(string $id)
    {
        return response()->json($this->userService->show($id));
    }
    public function destroy(string $id)
    {
        try {
            $this->userService->destroy($id);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => 'User removed successfully']);
    }
}
