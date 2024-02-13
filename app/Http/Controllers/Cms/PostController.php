<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\CmsAuthor;
use App\Models\CmsPage;
use App\Models\CmsTag;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show()
    {
        $pages = CmsPage::all()->load('author');
        foreach ($pages as $page) $page->url = config('app.landing_page') . '/' . $page->type . '/' . $page->slug;
        return view('cms.list', [
            'pages' => $pages
        ]);
    }

    public function create()
    {
        $tags = CmsTag::all();
        $authors = CmsAuthor::all();
        return view('cms.add', [
            'tags' => $tags,
            'authors' => $authors,
        ]);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $page = CmsPage::where('id', $id)->first();
        if (!$page) return redirect()->route('post.show');
        $tags = CmsTag::all();
        $authors = CmsAuthor::all();
        return view('cms.edit', [
            'page' => $page,
            'tags' => $tags,
            'authors' => $authors,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|min:3',
            'tags' => 'required',
            'content' => 'required|min:3',
        ]);

        $data = [
            'title' => $request->title,
            'type' => $request->type,
            'tags' => $request->tags,
            'slug' => $request->slug,
            'content' => $request->input('content'),  // You can use input() method directly
            'status' => $request->status,
            'author_id' => $request->author_id,
        ];

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $fileName = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads', $fileName, 'public');
            $data['featured_image_path'] = "/storage/$path";
        }

        $updated = CmsPage::where('id', $request->id)->update($data);

        return [
            'success' => $updated,
            'message' => $updated ? 'Page updated successfully' : 'Page not updated',
        ];
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|min:3',
            'tags' => 'required',
            'slug' => 'required|max:255|min:3',
            'type' => 'required|max:255|min:1',
            'status' => 'required|max:255|min:1',
            'author_id' => 'required|max:255|min:1',
            'content' => 'required|min:3',
            'post_date' => 'required|date',
        ]);
        $fileName = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('uploads', $fileName, 'public');

        $inserted = CmsPage::insert([
            'title' => $request->title,
            'type' => $request->type,
            'tags' => $request->tags,
            'slug' => $request->slug,
            'featured_image_path' => "/storage/$path",
            'content' => $request["content"],
            'status' => $request->status,
            'author_id' => $request->author_id,
            'post_date' => $request->post_date,
        ]);

        if ($inserted) {
            return [
                'success' => true,
                'message' => 'Page added successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Page not added'
            ];
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        try {
            $deleted = CmsPage::where('id', $id)->delete();
            if ($deleted) {
                return [
                    'success' => true,
                    'message' => 'Page deleted successfully'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Page not deleted'
                ];
            }
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e
            ];
        }
    }

    public function quick_view(Request $request)
    {
        return CmsPage::where('id', $request->id)->first()->content;
    }

    public function mce_image(Request $request)
    {
        $fileName = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->storeAs('uploads', $fileName, 'public');
        return response()->json(['location' => "/storage/$path"]);
    }

}
