<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\BrandRequest;
use DB;

class BrandsController extends Controller
{
        //Viewing Brands Table
        public function index()
        {
            $brands = Brand::orderBy('id' ,'DESC') -> paginate(PAGINATION_COUNT);
            return view('dashboard.brands.index' , compact('brands'));
        }
        // Add New Brands
        public function addBrand()
        {
            return view('dashboard.brands.create');
        }
        //Store In Database New Brand
        public function storeBrand(BrandRequest $request)
        {

            if(!$request->has('is_active')) {
                    $request->request->add(['is_active' => 0]);
                } else {
                    $request->request->add(['is_active' => 1]);
                }

                $brand = Brand::create($request->except('_token', 'photo'));
                $image_name = handleCreateImage('brands',$request);
                $brand->name = $request->name;
                $brand->photo = $image_name;
                $brand->save();
                return redirect()->route('add-brand')->with(['success' => 'Brand Added Successfully']);
        }

    //View Edit Brand Form
        public function editBrand($brand_id)
        {
            $brand = Brand::find($brand_id);

            if (!$brand) {
                return redirect()->back()->with(['error' => 'Brand ID Is Not Exists']);
            }

            if (count($brand->translations) > 0) {
                $name = $brand->translations[0]->name;
                return view('dashboard.brands.edit', compact('brand'), compact('name'));
            } else {
                return view('dashboard.brands.edit', compact('brand'));
            }
        }

    //UPDATE BRABD FUNCTION
    public function updateBrand($id, BrandRequest $request)
    {
        try {
            DB::beginTransaction();
            $brand = Brand::find($id);
            if(!$brand)
                return redirect()->back()->with(['error' => 'This brand does not exist']);

            $image_name = handleUpdateImage('brands',$request,$brand);
            $brand->photo = $image_name;

            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else
                $request->request->add(['is_active' => 1]);

            $brand->update($request->except('_token', 'photo', 'id'));

            $brand->name = $request->name;
            $brand->save();
            DB::commit();
            return redirect()->route('view-brands')->with(['success' => 'Brand Updated Successfully']);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errors($this->errors);}
    }

    //Delete Beand Function
    public function deletebrand($id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->back()->with(['errors' => 'Brand Not Found In Database']);
        }

        $brand->delete();
        return redirect()->back()->with(['success' => 'Deleted Successfully From Database']);

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

