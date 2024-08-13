<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Log;
// use Barryvdh\DomPDF\Facade\Pdf;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortField = $request->query('sort', 'role');
        $sortDirection = $request->query('direction', 'desc');
        $search = $request->query('search');
        $perPage = 5;

        $allowedSortFields = ['name', 'email', 'role'];

        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'role';
        }

        if ($sortField === 'role') {
            $sortDirection = 'desc';
        }

        $query = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('role', 'like', '%' . $search . '%');
        });

        $papers = $query->orderBy($sortField, $sortDirection)->paginate($perPage);

        return view('superadmin.index', [
            'paper' => $papers,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nip' => 'required|unique:users,nip',
                'position' => 'required|unique:users,position|max:70',
                'name' => 'required|unique:users,name|max:70',
                'email' => 'required|unique:users,email|max:30',
                'password' => 'required|min:8|max:60',
                'role' => 'required|in:superadmin,admin',
            ], [
                'nip.unique' => 'This NIP is already registered.',
                'name.unique' => 'This Name is already registered.',
                'email.unique' => 'This Email is already registered.',
                'position.unique' => 'This Position is already registered.',
                'role.in' => 'The selected role is invalid.',
            ]);

            User::create($validatedData);

            return redirect()->route('superadmin.index')->with('success', 'Data Added Successfully!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $userData = $user->toArray();
        $userData['password'] = ''; // placeholder
        return response()->json($userData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $validatedData = $request->validate([
                'nip' => 'required|unique:users,nip,' . $id,
                'position' => 'required|max:70|unique:users,position,' . $id,
                'name' => 'required|max:70|unique:users,name,' . $id,
                'email' => 'required|email|max:30|unique:users,email,' . $id,
                'role' => 'required|in:superadmin,admin',
            ]);

            if ($request->filled('password')) {
                $validatedData['password'] = bcrypt($request->password);
            } else {
                unset($validatedData['password']);
            }

            $user = User::findOrFail($id);
            $user->update($validatedData);

            return redirect()->route('superadmin.index')->with('success', 'Data Updated Successfully!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function bulkDelete(Request $request)
    {
        try {
            $selectedItems = $request->input('selected');

            if (empty($selectedItems)) {
                $count = User::truncate();
                $message = 'All users have been deleted.';
            } else {
                $selectedIds = explode(',', $selectedItems);
                $count = User::whereIn('id', $selectedIds)->delete();
                $message = $count . ' user(s) deleted successfully.';
            }

            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting users: ' . $e->getMessage()], 500);
        }
    }
}
