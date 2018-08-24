<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Faq;
use Yajra\Datatables\Datatables;
use Validator;

class FaqController extends AdminController {

    public function index(Request $request) {
        return view('admin.faq.index');
    }

    public function get_list() {
        $email = Faq::select(['*']);
        return Datatables::of($email)
                        ->addColumn('action', function ($model) {
                            return '<a href="' . Route("faqpage-edit", ["id" => $model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-pencil"></i> Edit</a>'
                                    . '<a href="' . Route("faqpage-delete", ["id" => $model->id]) . '" class="btn btn-xs btn-danger pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->make(true);
    }

    public function get_add() {
        $model = new Faq();
        return view('admin.faq.add', ['model' => $model]);
    }

    public function post_add(Request $request) {
        $model = new Faq();
        $validator = Validator::make($request->all(), [
                    'question' => 'required',
                    'answere' => 'required'
        ]);
        if ($validator->passes()) {
            $model->question = $request->input('question');
            $model->answere = $request->input('answere');
            $model->save();
            $request->session()->flash('success_msg', 'Faq added successfully.');
            return redirect()->route('faqpage');
        } else {
            return redirect()->route('faqpage-add')->withErrors($validator)->withInput();
        }
    }

    public function get_edit($id = "") {
        if ($id == "") {
            return redirect()->route('faqpage');
        }
        $model = Faq::find($id);
        if (empty($model)) {
            return redirect()->route('faqpage')->with('error_msg', 'Data Not found.');
        }
        return view('admin.faq.edit', ['model' => $model]);
    }

    public function post_edit(Request $request, $id = "") {
        if ($id == "") {
            return redirect()->route('faqpage');
        }
        $model = Faq::find($id);
        if (empty($model)) {
            return redirect()->route('faqpage')->with('error_msg', 'Data Not found.');
        }
        $validator = Validator::make($request->all(), [
                    'question' => 'required',
                    'answere' => 'required'
        ]);
        if ($validator->passes()) {
            $model->question = $request->input('question');
            $model->answere = $request->input('answere');
            $model->save();
            $request->session()->flash('success_msg', 'Faq updated successfully.');
        }
        return redirect()->route('faqpage-edit', ['id' => $id])->withErrors($validator)->withInput();
    }
    
    public function get_delete($id){
        if ($id == "") {
            return redirect()->route('faqpage');
        }
        $model = Faq::find($id);
        if (empty($model)) {
            return redirect()->route('faqpage')->with('error_msg', 'Data Not found.');
        }
        $model->delete();
        return redirect()->route('faqpage')->with('success_msg', 'Faq Page Deleted Successfully.');
    }

}
