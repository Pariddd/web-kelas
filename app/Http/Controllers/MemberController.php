<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $maleCount = Member::where('gender', 'male')->count();
        $femaleCount = Member::where('gender', 'female')->count();
        $q = (string) $request->query('q', '');
        $role = (string) $request->query('role', '');
        $sortBy = (string) $request->query('sort_by', 'created_at');
        $sortDir = (string) $request->query('sort_dir', 'desc');
        $perPage = (int) $request->query('per_page', 10);

        $allowedPerPage = [5, 10, 20, 50];
        if (! in_array($perPage, $allowedPerPage, true)) {
            $perPage = 10;
        }

        $allowedSorts = ['name', 'nickname', 'created_at'];
        if (! in_array($sortBy, $allowedSorts, true)) {
            $sortBy = 'created_at';
        }

        $sortDir = strtolower($sortDir) === 'asc' ? 'asc' : 'desc';

        $query = \App\Models\Member::query();

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', '%' . $q . '%')
                    ->orWhere('nickname', 'like', '%' . $q . '%');
            });
        }

        if ($role !== '') {
            $query->where('role', $role);
        }

        $members = $query->orderBy($sortBy, $sortDir)
            ->paginate($perPage)
            ->withQueryString();

        $memberCount = \App\Models\Member::count();
        $galleryCount = 0;
        try {
            if (class_exists(\App\Models\Gallery::class)) {
                $galleryCount = \App\Models\Gallery::count();
            }
        } catch (\Throwable $e) {
            Log::debug('Gallery count skipped: ' . $e->getMessage());
        }

        $rolesList = Member::whereNotNull('role')
            ->whereRaw("TRIM(role) != ''")
            ->select('role')
            ->distinct()
            ->orderBy('role')
            ->pluck('role');

        return view('admin.member.index', [
            'members'      => $members,
            'rolesList'    => $rolesList,
            'q'            => $q,
            'role'         => $role,
            'sortBy'       => $sortBy,
            'sortDir'      => $sortDir,
            'perPage'      => $perPage,
            'memberCount'  => $memberCount,
            'galleryCount' => $galleryCount,
            'maleCount' => $maleCount,
            'femaleCount' => $femaleCount
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|string|max:255',
                'nickname' => 'nullable|string|max:100',
                'role' => 'required|string|max:50',
                'gender' => 'required|in:male,female',
                'avatar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
                'birth_date' => 'nullable|date',
            ],
            [
                'name.required' => 'Nama lengkap wajib diisi.',
                'name.string' => 'Nama lengkap harus berupa teks.',
                'nickname.string' => 'Nickname harus berupa teks.',
                'role.required' => 'Role wajib dipilih.',
                'role.string' => 'Role harus berupa teks.',
                'gender.required' => 'Jenis kelamin wajib dipilih.',
                'gender.in'       => 'Jenis kelamin harus berupa male atau female.',
                'avatar.required' => 'Avatar wajib diunggah.',
                'avatar.image' => 'File avatar harus berupa gambar.',
                'avatar.mimes' => 'Avatar harus berformat JPG, JPEG, PNG, atau WEBP.',
                'avatar.max' => 'Ukuran avatar tidak boleh lebih dari 2MB.',
                'birth_date.date' => 'Tanggal lahir tidak valid.',
            ]
        );

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('avt_item_upload'), $avatarName);
            $validatedData['avatar'] = $avatarName;
        }

        $member = Member::create($validatedData);

        return redirect()->route('member.index')->with('success', 'Member Add successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('admin.member.edit', [
            'member' => $member
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $validatedData = $request->validate(
            [
                'name'        => 'nullable|string|max:255',
                'nickname'    => 'nullable|string|max:100',
                'role'        => 'nullable|string|max:50',
                'gender'      => 'nullable|in:male,female',
                'avatar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'birth_date'  => 'nullable|date',
            ],
            [
                'name.string'     => 'Nama lengkap harus berupa teks.',
                'nickname.string' => 'Nickname harus berupa teks.',
                'role.string'     => 'Role harus berupa teks.',
                'gender.in'       => 'Jenis kelamin harus berupa male atau female.',
                'avatar.image'    => 'File avatar harus berupa gambar.',
                'avatar.mimes'    => 'Avatar harus berformat JPG, JPEG, PNG, atau WEBP.',
                'avatar.max'      => 'Ukuran avatar tidak boleh lebih dari 2MB.',
                'birth_date.date' => 'Tanggal lahir tidak valid.',
            ]
        );

        if ($request->hasFile('avatar')) {

            if ($member->avatar && file_exists(public_path('img_item_upload/' . $member->avatar))) {
                unlink(public_path('avt_item_upload/' . $member->avatar));
            }

            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('avt_item_upload'), $avatarName);
            $validated['avatar'] = $avatarName;
        }

        $member->update($validatedData);

        return redirect()->route('member.index')->with('success', 'Member Add successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        if ($member->avatar && file_exists(public_path('avt_item_upload/' . $member->avatar))) {
            unlink(public_path('avt_item_upload/' . $member->avatar));
        }

        $member->delete();

        return redirect()->route('member.index')->with('success', 'Data member berhasil dihapus.');
    }
}
