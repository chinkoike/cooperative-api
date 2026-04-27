<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCooperativeRequest;
use App\Models\CooperativeRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CooperativeRequestController extends Controller
{
    use ApiResponseTrait;

    // GET /api/public/requests
    public function index(Request $request): JsonResponse
    {
        $requests = CooperativeRequest::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return $this->successResponse($requests, 'Requests retrieved successfully');
    }

    // POST /api/public/requests
    public function store(StoreCooperativeRequest $request): JsonResponse
    {
        $cooperativeRequest = CooperativeRequest::create([
            'user_id'      => $request->user()->id,
            'name'         => $request->name,
            'member_count' => $request->member_count,
            'status'       => 'pending',
        ]);

        return $this->successResponse($cooperativeRequest, 'Request submitted successfully', 201);
    }
}
