<?php

namespace App\Services;

use App\Models\Member;

class MemberService
{
    public function index()
    {
        return Member::all();
    }

    public function show(int $id)
    {
        return Member::findOrFail($id);
    }

    public function store(array $data)
    {
        return Member::create($data);
    }

    public function update(int $id, array $data)
    {
        $Member = Member::findOrFail($id);

        $Member->update($data);

        return $Member;
    }

    public function destroy(int $id)
    {
        $Member = Member::findOrFail($id);

        return $Member->delete();
    }
}