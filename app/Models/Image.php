<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /*
     * Role: Morph Relationship.
     *
     * comments:
     */
    public function imageable()
    {

        return $this->morphTo();
    }

    /*
     * Role: Save Image.
     *
     * comments:
     */
    public function saveImage($request, $class, $obj)
    {
        if ($request->hasFile('image')) {

            foreach ($request->file('image') as $key => $img) {

                $local_url = $img->store('blog');

                $image = $this->findornew($request->image_id);
                $image->imageable_type = $class;
                $image->imageable_id = $obj->id;
                $image->image = $local_url;

                $image->save();
            }
        }
    }

    /*
     * Role: Delete Image.
     *
     * comments:
     */
    public function deleteImage($request)
    {
        $image = $this->find($request->id);

        if (\Storage::exists($image->image)) {
            \Storage::delete($image->image);
        }
        $image->delete();
    }
}
