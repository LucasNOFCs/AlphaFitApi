<?php

namespace App\Services;

use App\Models\Member;
use App\Models\Plan;

class MemberService
{
    public function index()
    {
        return Member::all();
    }

    public function show(string $id)
    {
        return Member::findOrFail($id);
    }

    public function store(array $data)
    {
        return Member::create($data);
    }

    public function update(string $id, array $data)
    {
        $member = member::findOrFail($id);

        $member->update($data);

        return $member;
    }

    public function destroy(string $id)
    {
        $member = member::findOrFail($id);

        return $member->delete();
    }

    public function assignPlan(string $memberId, string $planId)
    {
        $member = Member::findOrFail($memberId);

        $plan = Plan::findOrFail($planId);

        $member->plan_id = $plan->id;
        $member->save();

        return $member;
    }
}