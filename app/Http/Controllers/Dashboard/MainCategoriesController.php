<?php

namespace App\Http\Controllers\Dashboard;

use App\Traits\CategoryTrait;
use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;

class MainCategoriesController extends Controller
{
    use CategoryTrait;
    public $success = 'Success Transaction';
    public $errors = 'Failed Transaction';
    //View All Categories Route

    public function index()
    {
        $categories = Category::with('_parent')->orderBy('id','DESC') -> paginate(PAGINATION_COUNT);
        return view('dashboard.categories.index', compact('categories'));
    }

    //View Add New Category Form
    public function create()
    {
        $categories = Category::select('id','parent_id')->get();
        return view('dashboard.categories.create',compact('categories'));
    }

    //Store In Database New Category
        public function store(MainCategoryRequest $request)
        {
            try {
                //validation
                if(!$request->has('is_active')) {
                    $request->request->add(['is_active' => 0]);
                } else {
                    $request->request->add(['is_active' => 1]);
                }

                //if user choose main category then we must remove paret id from the request

                if($request -> type == CategoryType::mainCategory) //main category
                {
                    $request->request->add(['parent_id' => null]);
                }

                //if he choose child category we must add parent id
                DB::beginTransaction();
                    $category = Category::create($request->except('_token', 'photo'));

                    $image_name = handleCreateImage('categories',$request);
                    $category->name = $request->name;
                    $category->photo = $image_name;
                    $category->save();
                    DB::commit();
                    return redirect()->route('admin.maincategories')->with(['success' => 'تم ألاضافة بنجاح']);
            }catch (\Exception $ex) {
                DB::rollback();
                return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            }
        }

    public function edit($id)
    {

        //get specific categories and its translations
        $category = Category::orderBy('id', 'DESC')->find($id);

        if (!$category)
            return redirect()->back()->with(['error' => 'Category ID Is Not Exists']);


        if (count($category->translations) > 0) {
                $name = $category->translations[0]->name;
                return view('dashboard.categories.edit', compact('category'), compact('name'));
            } else {
                return view('dashboard.categories.edit', compact('category'));
            }

    }


    public function update($id, MainCategoryRequest $request)
    {
        try {
            //validation

            //update DB

            $category = Category::find($id);

            if (!$category)
            return redirect()->back()->with(['error' => 'هذا القسم غير موجود']);

            $image_name = handleUpdateImage('categories',$request,$category);

            if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
            else
            $request->request->add(['is_active' => 1]);

            DB::beginTransaction();
            $category->update($request->except('_token', 'photo', 'id'));
            $category->photo = $image_name;

            //save translations
            $category->name = $request->name;
            $category->save();
            DB::commit();
            return redirect()->back()->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }



    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $category = Category::orderBy('id', 'DESC')->find($id);

            if (!$category)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);

            $category->delete();

            return redirect()->route('admin.maincategories')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    //Store Image To Database And Moves It TO Images/Offers File
        public function storeImage($folder, $photo)
        {
            $extension = $photo->getClientOriginalExtension();
            $file_name = time() . '.' . $extension;
            $path = 'assets/images/' . $folder;
            $photo->move($path, $file_name);
            return $file_name;
        }

}
