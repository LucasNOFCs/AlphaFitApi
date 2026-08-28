<?php

namespace App\Http\Controllers;

use App\Http\Resources\MemberResource;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Http\Requests\AssignPlanRequest;
use App\Services\MemberService;

class MemberController extends Controller
{

    private MemberService $service;

    public function __construct(MemberService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $members = $this->service->index();
        return MemberResource::collection($members);
    }

    public function show(string $id)
    {
        $member = $this->service->show($id);
        return new MemberResource($member);
    }
    public function store(StoreMemberRequest $request)
    {
        $data = $request->validated();
        $member = $this->service->store($data);

        return response()->json([
            'message' => 'Member created successfully.',
            'data' => new MemberResource($member)
        ], 201);
    }


    public function update(UpdateMemberRequest $request, string $id)
    {
        $data = $request->validated();
        $member = $this->service->update($id, $data);

        return response()->json([
            'message' => 'Member updated successfully.',
            'data' => new MemberResource($member)
        ]);
    }



    public function destroy(string $id)
    {
        $this->service->destroy($id);
        return response()->noContent();
    }

    public function assignPlan(
        AssignPlanRequest $request,
        string $memberId
    ) {
        $member = $this->service->assignPlan(
            $memberId,
            $request->validated()['plan_id']
        );

        return response()->json([
            'message' => 'Plan assigned successfully.',
            'data' => new MemberResource($member)
        ]);
    }
}
