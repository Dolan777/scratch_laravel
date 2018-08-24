<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Slider;
use Yajra\Datatables\Datatables;
use Validator;
use URL;

class SliderController extends AdminController {

    public function index(Request $request) {
        return view('admin.slider.index');
    }

    public function get_list() {
        $email = Slider::select(['*'])->where('status', '1');
        return Datatables::of($email)
                        ->editColumn('background_image', function ($model) {
                            return '<img height="50" src="' . URL::asset('public/uploads/slider/' . $model->background_image) . '"/>';
                        })
                        ->addColumn('action', function ($model) {
                            $html = '<a href="' . Route("slider-edit", ["id" => $model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>';
                            $html .= '<a href="javascript:;" onclick="deleteConfirm(this)" data-href="' . Route("slider-delete", ["id" => $model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                            return $html;
                        })
                        ->make(true);
    }

    public function get_add() {
        return view('admin.slider.add', []);
    }

    public function post_add(Request $request) {
        $validator = Validator::make($request->all(), [
                    'background_image' => 'required|mimes:png,jpeg,jpg,JPEG,gif',
        ]);
        if ($validator->passes()) {
            $model = new Slider;
            $model->title = $request->input('title');
            $model->description = $request->input('description');
            $model->status = '1';
            if ($request->hasFile('background_image')) {
                $sample_image = $request->file('background_image');
                $imagename = rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/slider');
                $sample_image->move($destinationPath, $imagename);
                $model->background_image = $imagename;
            }
            $model->save();
            return redirect()->route('slider')->with('success_msg', 'Slider Created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function get_edit($id) {
        $model = Slider::where('id', $id)->get()->first();
        return view('admin.slider.edit', ['model' => $model]);
    }

    public function post_edit($id, Request $request) {
        $validator = Validator::make($request->all(), [
                    'background_image' => 'mimes:png,jpeg,jpg,JPEG,gif',
        ]);
        if ($validator->passes()) {
            $model = Slider::where('id', $id)->get()->first();
            $model->title = $request->input('title');
            $model->description = $request->input('description');
            $model->status = '1';
            if ($request->hasFile('background_image')) {
                $sample_image = $request->file('background_image');
                $imagename = rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/slider');
                $sample_image->move($destinationPath, $imagename);
                $model->background_image = $imagename;
            }
            $model->save();
            return redirect()->route('slider')->with('success_msg', 'Slider updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function delete($id) {
        $model = Slider::where('id', $id)->get()->first();
        $model->status = '3';
        $model->save();
        return redirect()->route('slider')->with('success_msg', 'Slider deleted successfully.');
    }

}
