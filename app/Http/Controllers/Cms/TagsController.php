<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\CmsTag;

class TagsController extends Controller
{
    public function show()
    {
        $tags = CmsTag::all();
        return view('cms.tags', [
            'tags' => $tags
        ]);
    }

    public function store()
    {
        $tag = new CmsTag();
        $tag->name = request()->name;
        $tag->status = request()->status;
        $tag->save();
        return success('Tag added successfully');
    }

    public function update()
    {
        CmsTag::find(request()->id)->update([
            'status' => request()->status
        ]);
        return success('Tag updated successfully');
    }

    public function destroy()
    {
        $tag = CmsTag::find(request()->id);
        $tag->delete();
        return success('Tag deleted successfully');
    }
}
