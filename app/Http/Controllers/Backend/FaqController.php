<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Faq;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function store(Request $request)
    {
    	$faq = new Faq;

    	$faq->question = $request->question;
        $faq->question_bd = $request->question_bd;
    	$faq->answer = $request->answer;
        $faq->answer_bd = $request->answer_bd;
    	$faq->save();

    	session()->flash('success', 'Faq addedd successfully.');
    	return back();
    }

    public function update(Request $request, $id)
    {
    	$faq = Faq::find($id);

    	$faq->question = $request->question;
        $faq->question_bd = $request->question_bd;
        $faq->answer = $request->answer;
        $faq->answer_bd = $request->answer_bd;
    	$faq->save();

    	session()->flash('success', 'Faq Updated successfully.');
    	return back();
    }

    public function delete($id)
    {
    	$faq = Faq::find($id);

    	$faq->delete();

    	session()->flash('success', 'Faq Deleted successfully.');
    	return back();
    }
}
