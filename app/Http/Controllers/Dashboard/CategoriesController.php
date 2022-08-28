<?php

namespace App\Http\Controllers\Dashboard;

use App\Traits\CategoryTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;
use DB;

class CategoriesController extends Controller
{
    use CategoryTrait;
    public $success = 'Success Transaction';
    public $errors = 'Failed Transaction';
    //View All Categories Route
    public function index($type)
    {
        if (in_array($type, ['main-category', 'sub-category'])) {
            if ($type == 'main-category') {
                $categories = Category::where('category_id',null)->get();
                return view('dashboard.categories.index', compact('categories'), compact('type'));
            } else {
                $categories = Category::where('category_id', '!=', Null)->get();
                return view('dashboard.categories.index', compact('categories'), compact('type'));
            }

        } else {
            return redirect()->back()->with(['errors' => 'Enter From Sidebar']);
        }

    }

    //View Add New Main Category Form
    public function addCategory($type)
    {
        if (in_array($type, ['main-category', 'sub-category'])) {
            $category = Category::get();
            return view('dashboard.categories.create', compact('type'), compact('category'));
        } else {
            return redirect()->back()->with(['errors' => 'Visit Categories From The Sidebar']);
        }
    }


    //Store In Database New Main Category
    public function storeMainCategory(MainCategoryRequest $request, $type)
    {
        if (in_array($type, ['main-category', 'sub-category'])) {
            if (!$request->has('status'))
                $request->request->add(['status' => 0]);
            $category_id = Null;
            if($request->has('category_id')) {
                if ($request->has('category_id') && is_numeric($request->category_id)) {
                    $category_id = $request->category_id;
                } else {
                    return 'Choose A Valid Main Category For This Sub Category';
                }
            }
            $image_name = handleCreateImage('categories',$request);
            if($this->notValidName($request->name)) {
                $category = Category::create([
                    'slug' => $request->slug,
                    'is_active' => $request->status,
                    'is_translatable' => 0,
                    'photo' => $image_name,
                    'category_id' => $category_id,
                ]);
                return $this->success($this->success);
            } else {
                $category = Category::create([
                    'slug' => $request->slug,
                    'is_active' => $request->status,
                    'is_translatable' => 1,
                    'photo' => $image_name,
                    'name' => $request->name,
                    'category_id' => $category_id,
                ]);
                return $this->success($this->success);
            }

        } else {
            return $this->errors($this->errors);
        }
    }

    //View Edit Category Form
    public function editCategory($category_id)
    {
        $category = Category::find($category_id);
        if($category->category_id!=null){
            $type = 'sub-category';
        } else{
            $type = 'main-category';
        }
        if (!$category) {
            return redirect()->back()->with(['type' => $type,'error' => 'Category ID Is Not Exists']);
        }

        if (count($category->translations) > 0) {
            $name = $category->translations[0]->name;
            return view('dashboard.categories.edit', compact('category'), compact('name'), compact('type'));
        } else {
            return view('dashboard.categories.edit', compact('category'), compact('type'));
        }
    }

    //UPDATE CATEGORY FUNCTION
    public function updateCategory(MainCategoryRequest $request, $category_id)
    {
        $category = $this->findID(Category::class,$category_id);
//        return $request->image
        ##########################################
        if (!$request->has('status')) {
            $request->request->add(['status' => 0]);
        }
        $image_name = handleUpdateImage('categories',$request,$category);
        try {
            if ($this->notValidName($request->name)) {
                $category->update([
                    'slug' => $request->slug,
                    'is_active' => $request->status,
                    'photo' => $image_name,
                    'category_id' => $category->category_id,
                ]);
                return $this->success($this->success) ;

            } else {
                $category->update([
                    'slug' => $request->slug,
                    'is_active' => $request->status,
                    'photo' => $image_name,
                    'is_translatable' => 1,
                    'name' => $request->name,
                    'category_id' => $category->category_id,
                ]);
                return $this->success($this->success) ;
            }
        } catch (\Exception $exception) {return 'Something Went Wrong Try Again Later!';}
        ##########################################
    }

    //Delete Category Function
    public function deleteCategory($category_id)
    {
        $category = Category::find($category_id);
        if (!$category) {
            return redirect()->back()->with(['errors' => 'Category Not Found In Database']);
        }

        $category->delete();
        return redirect()->back()->with(['success' => 'Deleted Successfully From Database']);


    }

    //Store Image To Database And Moves It TO Images/Offers File
    public function storeImage($photo, $path)
    {
        $extension = $photo->getClientOriginalExtension();
        $file_name = time() . '.' . $extension;
        $path = 'assets/images/categories';
        $photo->move($path, $file_name);
        return $file_name;
    }
}




