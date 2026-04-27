<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewCooperativeRequest;
use App\Models\CooperativeRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CooperativeRequestController extends Controller
{
    use ApiResponseTrait;

    // GET /api/staff/requests
    public function index(Request $request): JsonResponse
    {
        $query = CooperativeRequest::with('user:id,name,email');

        // Filter by status ถ้ามีการส่ง ?status=pending มา
        if ($request->has('status')) {
            $request->validate([
                'status' => 'in:pending,approved,rejected',
            ]);

            $query->where('status', $request->status);
        }

        $requests = $query->latest()->get();

        return $this->successResponse($requests, 'Requests retrieved successfully');
    }

    // PATCH /api/staff/requests/{id}/review
    public function review(ReviewCooperativeRequest $request, int $id): JsonResponse
    {
        $cooperativeRequest = CooperativeRequest::findOrFail($id);

        // ป้องกันการเปลี่ยนสถานะซ้ำ
        if ($cooperativeRequest->status !== 'pending') {
            return $this->errorResponse(
                'This request has already been reviewed.',
                422
            );
        }

        $cooperativeRequest->update([
            'status' => $request->status,
            'reason' => $request->reason ?? null,
        ]);

        $message = $request->status === 'approved'
            ? 'Request approved successfully'
            : 'Request rejected successfully';

        return $this->successResponse($cooperativeRequest, $message);
    }
}
