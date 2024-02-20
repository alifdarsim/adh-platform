<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hub;
use App\Models\IndustryExpert;
use Illuminate\Http\Request;
use Yajra\DataTables\Exceptions\Exception;

class IndustryClassificationController extends Controller
{
    public function index()
    {
        return view('admin.industry.index');
    }

    /**
     * @throws Exception
     * @throws \Exception
     */
    public function datatable()
    {
        return datatables()->of(IndustryExpert::all())->make();
    }

    public function store()
    {
        $data = request()->validate([
            'main' => 'required',
            'sub' => 'required',
        ]);
        IndustryExpert::create($data);
        return success('Industry classification created successfully');
    }

    public function destroy($id)
    {
        IndustryExpert::where('id', $id)->delete();
        return success('Industry classification successfully');
    }

    public function update($id)
    {
        $data = request()->validate([
            'name' => 'required',
            'status' => 'required'
        ]);
        Hub::where('id', $id)->update($data);
        return success('Hub updated successfully');
    }
}
