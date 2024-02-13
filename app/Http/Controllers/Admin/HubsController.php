<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hub;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Exceptions\Exception;

class HubsController extends Controller
{
    public function index()
    {
        return view('admin.hubs.index');
    }

    /**
     * @throws Exception
     * @throws \Exception
     */
    public function datatable()
    {
        return datatables()->of(Hub::all())->make();
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required'
        ]);
         if (Hub::where('name', $data['name'])->exists()) {
             return error('Hub already exists');
         }
        Hub::create($data);
        return success('Hub created successfully');
    }

    public function destroy($id)
    {
        Hub::where('id', $id)->delete();
        return success('Hub deleted successfully');
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
