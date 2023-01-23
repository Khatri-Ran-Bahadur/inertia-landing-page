<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreUserRequest;
use App\Http\Controllers\Admin\BaseController;

class UserController extends BaseController
{

    /**
     * Datatable Columns Array
     *
     * @var Array
     */
    private $datatableColumns;

    /**
     * Datatable Headers Array
     *
     * @var Array
     */
    private $datatableHeaders;

    /**
     * Datatables Data URL
     *
     * @var String
     */
    private $datatableUrl;


    private $user;

    /**
     * Controller constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = new User();
        $this->datatableHeaders = [
            'ID',
            'Name',
            'Email',
            'Action'
        ];

        $this->datatableColumns = [
            ['data' => 'id'],
            ['data' => 'name'],
            ['data' => 'email'],
            ['data' => 'action', 'searchable' => false, 'orderable' => false]
        ];

        $this->datatableUrl = route('admin.users.index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->datatable) {

            $data = $this->user->latest()->select('id', 'name', 'email', 'phone');
            return DataTables::of($data)
                ->addColumn('checkbox', function ($row) {
                    return "<input type='checkbox' name='user_ids[]' value='$row->id'>";
                })
                ->addColumn('action', function ($row) use ($request) {
                    if ($request->tab === 'trash') {
                        $btn = '<a href="' . route('admin.users.restore', $row->id) . '" class="restore-delete-record text-success">' . __('Restore') . '</a> | ';

                        $btn .= '<a href="' . route('admin.users.delete', $row->id) . '" class="text-danger permanently-delete-record">' . __('Delete') . '</a>';
                        return $btn;
                    }
                    $btn = '<a href="' . route('admin.users.edit', $row->id) . '" class="text-success">' . __('Edit') . '</a> | ';
                    $btn .= '<a href="' . route('admin.users.destroy', $row->id) . '" class="delete-record text-danger">' . __('Delete') . '</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'checkbox', 'status'])
                ->make(true);
        }
        return Inertia::render('Admin/Users/Index')
            ->with('datatableUrl', $this->datatableUrl)
            ->with('datatableColumns', $this->datatableColumns)
            ->with('datatableHeaders', $this->datatableHeaders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token', 'role');
        $data['image'] = get_org_img($request->image);
        $data['password'] = bcrypt($request->password);
        $data['user_type'] = 'admin';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $data = $request->except('_token');
        $data['image'] = get_org_img($request->image);
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            $data['password'] = $user->password;
        }
        $user->update($data);
        $user->syncRoles($request->role);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * trashed
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */

    public function destroy(user $user)
    {
        $user->delete();
        return $this->success();
    }


    /**
     * Restore the specified resource from storage.
     * trashed
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */

    public function restore($user)
    {
        $this->user->withTrashed()->findOrFail($user)->restore();
    }


    /**
     * Permanently Deleted the specified resource from storage.
     * trashed
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */

    public function delete($user)
    {

        $this->user->withTrashed()->findOrFail($user)->forceDelete();
    }

    public function bulk_action(Request $request)
    {
        $this->validate($request, [
            'user_ids' => 'required',
            'bulk_action' => 'required'
        ]);

        if ($request->bulk_action === 'trash') {
            $this->user->whereIn('id', $request->user_ids)->delete();
        }
        if ($request->bulk_action === 'delete') {
            $this->user->whereIn('id', $request->user_ids)->withTrashed()->forceDelete();
        }
        if ($request->bulk_action === 'restore') {
            $this->user->withTrashed()->whereIn('id', $request->user_ids)->restore();
        }

        return back();
    }
}
