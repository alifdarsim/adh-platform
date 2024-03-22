<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\CmsAuthor;
use App\Models\CmsPage;
use App\Models\CmsTag;
use Exception;
use Illuminate\Http\Request;
use Str;

class PostController extends Controller
{
    public function index()
    {
        $pages = CmsPage::all()->load('author');
        foreach ($pages as $page) $page->url = config('app.landing_page') . '/' . $page->type . '/' . $page->slug;
        return view('admin.cms.post.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.cms.post.create');
    }

    public function edit($id)
    {
        $page = CmsPage::where('id', $id)->first();
        if (!$page) return view('errors.not-exist');
        return view('admin.cms.post.edit', compact('page'));
    }

    public function update(Request $request)
    {
        // get page content
        $request->validate([
            'title' => 'required|max:255|min:3',
            'slug' => 'required|max:255|min:3',
            'type' => 'required|max:255|min:1',
            'status' => 'required|max:255|min:1',
            'author' => 'required|max:255|min:1',
            'content' => 'required|min:3',
            'post_date' => 'required|date',
        ]);

        // if image is not update then use the old image
        $data = [
            'title' => $request->title,
            'type' => $request->type,
            'slug' => $request->slug,
            'content' => $request["content"],
            'status' => $request->status,
            'author' => $request->author,
            'post_date' => $request->post_date,
        ];

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = request()->file('image');
            $file_name = Str::uuid() . '.' . $file->extension();
            $file->move(public_path('resources'), $file_name);
            $data['featured_image_path'] = config('app.app_page') . '/resources/' . $file_name;
        }

        $base64 = $this->getAllBase64($data['content']);
        $data['content'] = $this->convertBase64ToImage($base64, $data['content']);
        $data['content'] = str_replace('../../../..', config('app.app_page'), $data['content']);
        $updated = CmsPage::where('id', $request->id)->update($data);
        if ($updated) {
            return [
                'success' => true,
                'message' => 'Page updated successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Page not updated'
            ];
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|min:3',
            'slug' => 'required|max:255|min:3',
            'type' => 'required|max:255|min:1',
            'status' => 'required|max:255|min:1',
            'author' => 'required|max:255|min:1',
            'content' => 'required|min:3',
            'post_date' => 'required|date',
        ]);
        $file = request()->file('image');
        $file_name = Str::uuid() . '.' . $file->extension();
        $file->move(public_path('resources'), $file_name);
        $inserted = CmsPage::insert([
            'title' => $request->title,
            'type' => $request->type,
            'slug' => $request->slug,
            'featured_image_path' => config('app.app_page') . '/resources/' . $file_name,
            'content' => $request["content"],
            'status' => $request->status,
            'author' => $request->author,
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

    public function datatable()
    {
        $pages = CmsPage::all();
        foreach ($pages as $page) $page->url = config('app.landing_page') . '/' . $page->type . '/' . $page->slug;
        return datatables()->of($pages)
            ->make(true);

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

    public function get()
    {
        return CmsPage::select('id','title','slug','type','featured_image_path','featured','post_date','description')->where('status','published')->get();
    }

    public function get_id($id)
    {
        return CmsPage::where('id', $id)->first();
    }

    function convertBase64ToImage($matches , $content) {
//        $images_path = [];
        foreach ($matches[0] as $key => $value) {
            $base64string = $value;
            $extension = explode('/', explode(';', $base64string)[0])[1];
            $image = $matches[2][$key];
            $image = base64_decode($image);
            $image_name = Str::uuid() . $key . '.' . $extension;
            $path = public_path() . '/resources/' . $image_name;
            file_put_contents($path, $image);
//            $images_path[] = config('app.url') . '/resources/' . $image_name;
            $content = str_replace($base64string, config('app.app_page') . '/resources/' . $image_name, $content);
        }
        return $content;
    }

    function getAllBase64($content) {
        $base64 = [];
        preg_match_all('/data:image\/([a-zA-Z]*);base64,([^"]*)/', $content, $base64);
        return $base64;
    }

}
