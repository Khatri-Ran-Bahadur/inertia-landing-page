<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Http\Controllers\Admin\BaseController;

class ServiceController extends BaseController
{
    private $service;

    private $counts;

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


    public function __construct()
    {
        $this->service = new Service();
        $this->datatableHeaders = [
            '<input type="checkbox"  class="form-check-input" id="allCheckRow"/> ',
            __('Title'),
            __('Status'),
            __('Date'),
            __('Action')
        ];
        $this->datatableColumns = [
            ['data' => 'checkbox', 'searchable' => false, 'orderable' => false],
            ['data' => 'title'],
            ['data' => 'status', 'searchable' => false, 'orderable' => false],
            ['data' => 'created_at'],
            ['data' => 'action', 'searchable' => false, 'orderable' => false]
        ];
        $this->datatableUrl = route('admin.services.index');
        $this->counts = [
            'all' => $this->service->count(),
            'trashed' => $this->service->onlyTrashed()->count()
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->datatable) {
            $data = $this->service->latest();
            if ($request->status === 'trash') {
                $data->onlyTrashed();
            }

            return DataTables::of($data)
                ->addColumn('checkbox', function ($row) {
                    return "<input type='checkbox' class='form-check-input checkboc-item' name='service_id[]' value='$row->id'>";
                })
                ->editColumn('status', function ($row) use ($request) {
                    return make_status(route('admin.services.change-status', $row->id), $row->id, $row->status);
                })
                ->addColumn('action', function ($row) use ($request) {
                    if ($request->status === 'trash') {
                        $btn = '<li><a href="' . route('admin.services.restore', $row->id) . '" class="restore-record text-success dropdown-item"> <i class="bi bi-arrow-return-left"></i> ' . __('Restore') . '</a> </li> ';

                        $btn .= '<li><a href="' . route('admin.services.delete', $row->id) . '" class="text-danger delete-record dropdown-item"> <i class="bi bi-trash"></i> ' . __('Delete') . '</a>';
                        return make_button($btn);
                    }
                    $btn = '<li><a href="' . route('admin.services.edit', $row->id) . '" class="text-success dropdown-item edit-record"> <i class="bi bi-pencil"></i> ' . __('Edit') . '</a>  </li>';

                    $btn .= '<li><a href="' . route('admin.services.destroy', $row->id) . '" class="text-danger dropdown-item trash-record"> <i class="bi bi-trash"></i> ' . __('Trash') . '</a></li>';
                    return make_button($btn);
                })
                ->rawColumns(['action', 'checkbox', 'status'])
                ->make(true);
        }


        return Inertia::render('Admin/Service/Index')
            ->with('status', $request->status ?? 'all')
            ->with('counts', $this->counts)
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
        return Inertia::render('Admin/Service/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $data = $request->all();
        $data['status'] = 1;
        $data['image'] = get_org_img($request->image);
        $this->service->create($data);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = new ServiceResource($this->service->find($id));
        return Inertia::render('Admin/Service/Edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        $data = $request->all();
        $data['status'] = 1;
        $data['image'] = get_org_img($request->image);
        $service = $this->service->find($id);
        $service->update($data);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->findOrFail($id)->delete();
        return redirect()->route('admin.services.index');
    }

    /**
     * Restore the specified resource from storage.
     * trashed
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */

    public function restore($id)
    {
        $this->service->withTrashed()->findOrFail($id)->restore();
        return back();
    }


    /**
     * Permanently Deleted the specified resource from storage.
     * trashed
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $this->service->withTrashed()->findOrFail($id)->forceDelete();
        return back();
    }

    public function bulk_action(Request $request)
    {

        $this->validate($request, [
            'service_id' => 'required',
            'bulk_action' => 'required'
        ]);
        if ($request->bulk_action === 'trash') {
            $this->service->whereIn('id', $request->service_id)->delete();
        }
        if ($request->bulk_action === 'delete') {
            $this->service->whereIn('id', $request->service_id)->withTrashed()->forceDelete();
        }
        if ($request->bulk_action === 'restore') {
            $this->service->whereIn('id', $request->service_id)->restore();
        }
        return back();
    }

    public function change_status($id)
    {
        $service = $this->service->find($id);
        $service->status = $service->status === 1 ? 0 : 1;
        $service->save();
        return back();
    }
}
