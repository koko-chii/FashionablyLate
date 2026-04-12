<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();

        $category = Category::find($contact['category_id']);
        $category_content = $category ? $category->content : '';

        return view('confirm', compact('contact', 'category_content'));
    }

    public function store(Request $request)
    {
        if($request->has('back')){
            return redirect('/')->withInput();
        }

        $contact = $request->only([
            'category_id', 'first_name', 'last_name', 'gender',
            'email', 'tel', 'address', 'building', 'detail'
        ]);

        Contact::create($contact);

        return view('thanks');
    }
}


