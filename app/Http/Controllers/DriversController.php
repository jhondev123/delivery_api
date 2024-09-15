<?php

namespace App\Http\Controllers;

use App\Application\DTO\Driver\DriverDTO;
use App\Application\Services\DriverService;
use App\Http\Requests\DriverRequest;
use Illuminate\Http\Request;

class DriversController extends Controller
{
    public function __construct(private DriverService $service) {}

    public function index()
    {
        return response()->json($this->service->getAllDrivers());
    }


    public function store(DriverRequest $request)
    {
        $driverDTO = new DriverDTO(
            $request->get('name'),
            $request->get('phone'),
            $request->get('vehicle'),
            $request->get('plate')
        );
        $createdDriver = $this->service->store($driverDTO);
        return response()->json([
            'message' => 'Driver created successfully',
            'data' => $createdDriver,
        ]);
    }


    public function show(string $id)
    {
        return response()->json($this->service->getDeliveryById($id));
    }

    public function update(DriverRequest $request, string $id)
    {
        $driverDTO = new DriverDTO(
            $request->get('name'),
            $request->get('phone'),
            $request->get('vehicle'),
            $request->get('plate')
        );
        $updatedDriver = $this->service->update($driverDTO, $id);
        return response()->json([
            'message' => 'Driver updated successfully',
            'data' => $updatedDriver,
        ]);
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Driver deleted successfully']);
    }
}
