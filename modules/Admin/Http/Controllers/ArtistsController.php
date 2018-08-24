<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserMaster;
use Yajra\Datatables\Datatables;
use Validator;
use URL;

class ArtistsController extends AdminController {

    public function get_artists_list() {
        return view('admin.artists.artists_list');
    }

    public function get_artists_list_datatable() {
        $artists_list = UserMaster::select(['id', 'full_name', 'email', 'image'])->where('type_id', 2)->where('status', '<>', '3');
        return Datatables::of($artists_list)
                        ->editColumn('image', function ($model) {
                            if (@getimagesize(URL::asset('public/uploads/user/' . $model->image)) == true) {
                                $path = URL::asset('public/uploads/user/' . $model->image);
                            } else {
                                $path = URL::asset('themes/admin/assets/no-image.png');
                            }
                            return '<img height="50" width="50" src="' . $path . '"/>';
                        })
                        ->addColumn('action', function ($model) {
                            return
                                    '<a href="' . Route("artists-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="btnDelete(this)" data-href="' . Route("artists-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->make(true);
    }

    public function get_add_artists() {
        $data = [];
        return view('admin.artists.artists_add', $data);
    }

    public function post_add_artists(Request $request) {
        $validator = Validator::make($request->all(), [
                    'full_name' => 'required',
                    'image' => 'required|mimes:png,jpeg,jpg,JPEG,gif',
        ]);
        if ($validator->passes()) {
            $model = new UserMaster;
            $model->full_name = $request->input('full_name');
            $model->type_id = 2;
            $model->status = '1';
            if ($request->hasFile('image')) {
                $model->image = $this->uploadimage($request);
            }
            $model->save();
            return redirect()->route('artists-list')->with('success_msg', 'Artist created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function get_edit_artists($id) {
        $data['artists'] = $artists = UserMaster::where('id', '=', $id)->first();
        if (!$artists) {
            return redirect()->route('artists-list')->with('error_msg', 'Invalid Link!');
        }
        $data['id'] = $id;
        return view('admin.artists.artists_edit', $data);
    }

    public function post_edit_artists(Request $request, $id) {
        $validator = Validator::make($request->all(), [
                    'full_name' => 'required',
                    'image' => 'image|mimes:png,jpeg,jpg,JPEG,gif',
        ]);
        if ($validator->passes()) {
            $model = UserMaster::where('id', '=', $id)->first();
            $model->full_name = $request->input('full_name');
            $model->type_id = 2;
            $model->status = '1';
            if ($request->hasFile('image')) {
                $model->image = $this->uploadimage($request);
            }
            $model->save();
            return redirect()->route('artists-list')->with('success_msg', 'Artist updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function delete($id) {
        $model = UserMaster::where('id', $id)->get()->first();
        $model->status = '3';
        $model->save();
        return redirect()->route('artists-list')->with('success_msg', 'Artist deleted successfully.');
    }
    
    public function uploadimage($request) {
        $sample_image = $request->file('image');
        $imagename = rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
        $destinationPath = public_path('uploads/user');
        $sample_image->move($destinationPath, $imagename);
        return $imagename;
    }

}
