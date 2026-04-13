<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $contacts = Contact::paginate(7);

        return view('admin.index', compact('categories', 'contacts'));
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $query = Contact::query();
            if ($request->filled('keyword')) {
                $query->where(function($q) use ($request) {
                    $q->where('last_name', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('first_name', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('email', 'LIKE', "%{$request->keyword}%");
                });
            }
        $contacts = $query->paginate(7);
        $contacts->appends($request->all());

        return view('admin.index', compact('categories', 'contacts'));
    }

    public function destroy(Request $request)
    {
        \App\Models\Contact::find($request->id)->delete();

        return redirect()->route('admin.index')->with('success', '削除しました');;
    }
}
