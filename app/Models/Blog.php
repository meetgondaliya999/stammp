<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;


    public function blog_image()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    /*
     * Role: create a slug for Product
     *
     * comments:
     */
    public static function getSlugForCustom($name, $id = null)
    {

        $slugReplace = strtolower(str_replace([" ", ", ", "/", ",", "(", ")", ".", "_", "__", "%", "&", "#"], "-", $name));
        $slug = str_replace("--", "-", $slugReplace);
        $count = Blog::where('slug', 'like', $slug . '%');
        if (!empty($id)) {
            $count->where('id', '<>', $id);
        }
        $count = $count->count();

        return ($count > 0) ? ($slug . '-' . $count) : $slug;

    }

    /*
     * role :save the Blog 
     *
     * comments:
     */
    public function saveBlog($request)
    {
        $blog = $this->findornew($request->blog_id);

        if (empty($request->blog_id) && \Auth::user()) {
            $blog->user_id = \Auth::user()->id;
        }

        $blog->title = $request->title;
        $blog->slug = $this->getSlugForCustom($request->title, $blog->id);
        $blog->description = $request->description;
        $blog->publication_date = $request->publication_date;
        $blog->save();

        return $blog;
    }

    /*
     * role:change status
     *
     * comments:
     */
    public function changeStatus($request)
    {
        $changestatus = $this->where('id', $request->id)->first();
        $changestatus->status = $request->status;
        $changestatus->save();
    }

    /*
     * role: Delete Blog
     *
     * comments:
     */
    public function deleteBlog($request)
    {
        $changestatus = $this->where('id', $request->id)->delete();
    }

    /*
     * role: Get All Blog
     *
     * comments:
     */
    public function getAllBlogs()
    {
        return $this->where('status', '1')->get();
    }

    /*
     * role: Blog Details
     *
     * comments:
     */
    public function bolgDetails($blog)
    {
        return $this->where('slug', $blog)->first();
    }

    /*
     * role: My Blogs
     *
     * comments:
     */
    public function myBlogs()
    {
        return $this->where('status', '1')->where('user_id', \Auth::user()->id)->get();
    }
}
