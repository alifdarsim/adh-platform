<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\CmsAuthor;

class AuthorsController extends Controller
{
    public function show()
    {
        $authors = CmsAuthor::all();
        return view('cms.authors', [
            'authors' => $authors
        ]);
    }

    public function store()
    {
        // validate request
        request()->validate([
            'name' => 'required',
            'position' => 'required',
            'company' => 'required',
        ]);

        $author = new CmsAuthor();
        $author->name = request()->name;
        $author->position = request()->position;
        $author->company = request()->company;
        $author->status = 1;
        $author->save();
        return success('Author added successfully');
    }

    public function update()
    {
        CmsAuthor::find(request()->id)->update([
            'status' => request()->status
        ]);
        return success('Author updated successfully');
    }

    public function destroy()
    {
        $author = CmsAuthor::find(request()->id);
        $author->delete();
        return success('Author deleted successfully');
    }
}
