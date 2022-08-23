<?php
namespace App\Traits;

trait CategoryTrait {
    public function findID($model, $id)
    {
        $findModel = $model::find($id);
        if (!$findModel) {
            return redirect()->back()->with(['errors' => 'Category Not Found In Database']);
        }
        return $findModel;
    }

    public function notValidName($name) {
        if ($name == null || trim(strlen($name)) < 4 || trim(is_numeric($name))) {
            return true;
        }
        return false;
    }

    public function success($string) {
        return redirect()->back()->with(['success' => $string]);
    }

    public function errors($string) {
        return redirect()->back()->with(['errors' => $string]);
    }



}
