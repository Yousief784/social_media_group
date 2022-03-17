<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Models\Group;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{

    public function index()
    {
        $groups = Group::latest()->paginate(15);

        return view('groups.index', [
            'groups' => $groups
        ]);
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(GroupRequest $request)
    {
        $slug = Str::slug($request->name);
        $created_by = Auth::id();

        $request->merge([
            'group_slug' => $slug,
            'group_created_by' => $created_by
        ]);

        Group::create($request->all());

        return view('groups.index', [
            'status' => __('your group in pending list')
        ]);
    }

    public function show($slug)
    {
        $group = Group::where('group_slug', $slug)->firstOrFail();

        return view('groups.show', [
            'group' => $group
        ]);
    }

    public function edit($slug)
    {
        $group = Group::where('group_slug', $slug)->firstOrFail();

        return view('groups.edit', [
            'group' => $group
        ]);
    }

    public function update(GroupRequest $request, $slug)
    {
        $group = Group::where('group_slug', $slug)->firstOrFail();

        $slug = Str::slug($request->name);
        $created_by = Auth::id();

        $request->merge([
            'group_slug' => $slug,
            'group_created_by' => $created_by,
            'group_status' => 'pending'
        ]);

        Group::create($request->all());

        return view('groups.index', [
            'status' => __('your group in pending list')
        ]);
    }

    public function destroy($slug)
    {
        $group = Group::where('group_slug', $slug)->firstOrFail();

        $group->delete();

        return view('groups.index', [
            'status' => __('group deleted successfully')
        ]);
    }
}
