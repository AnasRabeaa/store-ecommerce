<?php
define('PAGINATION_COUNT', 10);
function getCssFile()
{
    return app()->getLocale() === 'ar' ? 'css-rtl' : 'css';
}


function getAdminImage()
{
    return auth()->guard('admin')->user()->photo;
}

function uploadImage($folder, $image)
{
//    $image_name = time() . '.' .$image->getClientOriginalExtension();
    $image_name = time() . '.' .$image->extension();
//    $image->store('/', $folder);
    $image->move('assets/images/'.$folder,$image_name);
//    $image_name = time() . $image->hashName();
    return $image_name;
}

function handleCreateImage($folder,$request)
{
    if ($request->has('image')) {
         return $image_name = uploadImage($folder, $request->image);
    } else {
        return $image_name = '';
    }
}

function handleUpdateImage($folder,$request,$model) {
    if ($request->has('image')) {
        return $image_name = uploadImage($folder, $request->image);
    } else {
        return $image_name = $model->photo;
    }
}

function success($string) {
    return redirect()->back()->with(['success' => $string]);
}

function errors($string) {
    return redirect()->back()->with(['errors' ,$string]);
}
