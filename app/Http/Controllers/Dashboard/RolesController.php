<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolesRequest;
use Illuminate\Http\Request;
use App\Models\Role;
use Carbon\Carbon;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::get(); // use pagination and  add custom pagination on index.blade
        return view('dashboard.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('dashboard.roles.create');
    }

    public function saveRole(RolesRequest $request)
    {

        try {

            $role = $this->process(new Role, $request);
            if ($role)
                return redirect()->route('admin.roles.index')->with(['success' => 'تم ألاضافة بنجاح']);
            else
                return redirect()->route('admin.roles.index')->with(['error' => 'رساله الخطا']);
        } catch (\Exception $ex) {
            return $ex;
            // return message for unhandled exception
            return redirect()->route('admin.roles.index')->with(['error' => 'رساله الخطا']);
        }
    }

    public function edit($id)
    {
          $role = Role::findOrFail($id);
        return view('dashboard.roles.edit',compact('role'));
    }

    public function update($id,RolesRequest $request)
    {
        try {
            $role = Role::findOrFail($id);
            $role = $this->process($role, $request);
            if ($role)
                return redirect()->route('admin.roles.index')->with(['success' => 'تم التحديث بنجاح']);
            else
                return redirect()->route('admin.roles.index')->with(['error' => 'رساله الخطا']);
        } catch (\Exception $ex) {
            // return message for unhandled exception
            return redirect()->route('admin.roles.index')->with(['error' => 'رساله الخطا']);
        }
    }

    protected function process(Role $role, Request $r)
    {
        $role->name = $r->name;
        $role->permissions = json_encode($r->permissions);
        $role->save();
        return $role;
    }


    public function destroy($id)
    {

        try {
            //get specific categories and its translations
            $role = Role::orderBy('id', 'DESC')->find($id);

            if (!$role)
                return redirect()->back()->with(['error' => 'هذا القسم غير موجود ']);

            $role->delete();

            return redirect()->back()->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


}
