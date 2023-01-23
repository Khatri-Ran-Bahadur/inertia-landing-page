<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Translation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\BaseController;

class TranslationController extends BaseController
{
    private $translation;

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
        $this->translation = new Translation();
        $this->datatableHeaders = [
            '<input type="checkbox"  class="form-check-input" id="allCheckRow"/> ',
            __('Key'),
            __('EN'),
            __('RU'),
            __('Action')
        ];
        $this->datatableColumns = [
            ['data' => 'checkbox', 'searchable' => false, 'orderable' => false],
            ['data' => 'key'],
            ['data' => 'en'],
            ['data' => 'ru'],
            ['data' => 'action', 'searchable' => false, 'orderable' => false]
        ];
        $this->datatableUrl = route('admin.translations.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->datatable) {
            $data = $this->translation->latest();

            return DataTables::of($data)
                ->addColumn('checkbox', function ($row) {
                    return "<input type='checkbox' class='form-check-input checkboc-item' name='service_id[]' value='$row->id'>";
                })
                ->addColumn('action', function ($row) use ($request) {

                    $btn = '<li><a href="' . route('admin.translations.edit', $row->id) . '" class="text-success dropdown-item edit-record"> <i class="bi bi-pencil"></i> ' . __('Edit') . '</a>  </li>';

                    $btn .= '<li><a href="' . route('admin.translations.destroy', $row->id) . '" class="text-danger dropdown-item trash-record"> <i class="bi bi-trash"></i> ' . __('Trash') . '</a></li>';
                    return make_button($btn);
                    return $btn;
                })
                ->rawColumns(['action', 'checkbox', 'status'])
                ->make(true);
        }

        return Inertia::render('Admin/Translation/Index')
            ->with('datatableUrl', $this->datatableUrl)
            ->with('datatableColumns', $this->datatableColumns)
            ->with('datatableHeaders', $this->datatableHeaders);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Translation/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'key' => 'required|unique:translations',
        ]);
        $data['key'] = $request->key;
        foreach (config('translatable.locales') as $lang) {
            $data[$lang] = $request[$lang];
        }

        $this->translation->create($data);
        $this->export_json();
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
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $translation = $this->translation->find($id);
        return Inertia::render('Admin/Translation/Edit', compact('translation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'key' => 'required|unique:translations,id,' . $id,
        ]);
        $data['key'] = $request->key;
        foreach (config('translatable.locales') as $lang) {
            $data[$lang] = $request[$lang];
        }
        $this->translation->find($id)->update($data);
        $this->export_json();
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
        $this->translation->find($id)->delete();
        $this->export_json();
        return $this->success();
    }

    public function export_json()
    {
        foreach (config('translatable.locales') as $lang) {
            $translations = $this->translation->select($lang, 'key')
                ->pluck($lang, 'key')
                ->all();
            Storage::disk('lang')->put($lang . '.json', json_encode($translations));
        }
    }
}
