<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Member;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'asc')
            ->take(5)
            ->get();

        $members = Member::where('role', '!=', 'guru')
            ->orWhereNull('role')
            ->orderBy('name', 'asc')
            ->get();

        $memberCount = Member::count();
        $male   = Member::where('gender', 'male')->count();
        $femaleCount = Member::where('gender', 'female')->count();
        $nonGuruCount = Member::where('role', '!=', 'guru')->orWhereNull('role')->count();
        $teachers = Member::where('role', 'guru')
            ->orderBy('name', 'asc')
            ->get();

        $member = $memberCount - $nonGuruCount;
        $female = $femaleCount - $nonGuruCount;

        return view('members.home', [
            'galleries' => $galleries,
            'members'     => $members,
            'member' => $member,
            'male'   => $male,
            'female' => $female,
            'teachers'    => $teachers,
        ]);
    }
}
