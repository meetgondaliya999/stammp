<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;
use App\Models\Image;
use Carbon\Carbon;

class BlogController extends Controller
{
    /*
     * role: Recsource Blog
     *
     * comments:
     */
    public function allBlog()
    {
        return view('pages.blog.list');
    }

    /*
     * role: Listing Blog
     *
     * comments:
     */
    public function blogListing(Request $request)
    {
        extract($this->DTFilters($request->all()));
        $records = [];
        $records['data'] = [];

        $content = Blog::select('*');
        if (!empty($search)) {
            $content->where(function ($query) use ($search) {
                $query->Where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $count = $content->count();
        $records['recordsTotal'] = $count;
        $records['recordsFiltered'] = $count;

        $content->offset($offset)->limit($limit)->orderBy($sort_column, $sort_order);
        $content = $content->get();

        $co = 1;
        if (count($content) > 0) {
            foreach ($content as $val) {

                $action_btn = view('layouts.action-btn', compact('val'))->with(['edit' => true, 'delete' => true, 'statusshow' => true, 'routeName' => 'blog'])->render();

                if ($val->status == 1) {
                    $status = '<span class="badge bg-success">ACTIVE</span>';
                } else {
                    $status = '<span class="badge bg-warning">In-ACTIVE</span>';
                }

                $records['data'][] = [
                    'no' => $co,
                    'title' => $val->title,
                    'publication_date' => Carbon::parse($val->publication_date)->format('d-m-Y'),
                    'description' => \Str::limit($val->description, 100, '...'),
                    'status' => $status,
                    'action' => $action_btn,
                ];
                $co++;
            }
        }
        return $records;
    }

    /*
     * role: create Blog
     *
     * comments:
     */
    public function create()
    {
        return view('pages.blog.add');
    }

    /*
     * role: save Blog
     *
     * comments:
     */
    public function save(BlogRequest $request)
    {
        $blog = (new Blog())->saveBlog($request);

        (new Image())->saveImage($request, get_class($blog), $blog);

        return redirect()->route('blogs');
    }

    /*
     * role: Get Blog data for edit.
     *
     * comments:
     */
    public function edit(Blog $blog)
    {
        return view('pages.blog.add', compact('blog'));
    }

    /*
     * role: Change Blog status.
     *
     * comments:
     */
    public function changeStatus(Request $request)
    {
        (new Blog())->changeStatus($request);

        return redirect()->route('blogs')->with('success', 'Blog status update successfully');
    }

    /*
     * role: Delete Blog.
     *
     * comments:
     */
    public function delete(Request $request)
    {
        //Delete Blog.
        (new Blog())->deleteBlog($request);

        return redirect()->route('blogs')->with('success', 'Blog delete successfully');

    }

    /*
     * role: Delete Blog Single Image.
     *
     * comments:
     */
    public function deleteImage(Request $request)
    {

        (new Image())->deleteImage($request);

        return redirect()->back();
    }

    /*
     * role: Bolg Details.
     *
     * comments:
     */
    public function bolgDetails($blog)
    {
        $blog = (new Blog())->bolgDetails($blog);

        return view('pages.blog.details', compact('blog'));
    }

    /*
     * role: My Blogs.
     *
     * comments:
     */
    public function myBlogs()
    {
        $blogs = (new Blog())->myBlogs();

        return view('dashboard', compact('blogs'));
    }
}
