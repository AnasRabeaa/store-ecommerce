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

