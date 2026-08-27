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
        $member = $this->service->store(
            $request->validated()
        );
        return new MemberResource($member);
    }


    public function update(UpdateMemberRequest $request, string $id)
    {
        $member = $this->service->update($id, $request->validated());
        return new MemberResource($member);
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

        return new MemberResource($member);
    }
}
