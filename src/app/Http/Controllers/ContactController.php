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

        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        Contact::create($contact);

        return view('thanks');
    }

    public function admin(Request $request)
    {
        $categories = Category::all();

        $contacts = Contact::with('category')
            ->where(function($query) use ($request) {
                if ($request->keyword) {
                    $query->where('first_name', 'like', '%' . $request->keyword . '%')
                        ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                        ->orWhere('email', 'like', '%' . $request->keyword . '%');
                }
            })
            ->where(function($query) use ($request) {
                if (!is_null($request->gender) && $request->gender !== '') {
                    $query->where('gender', $request->gender);
                }
            })
            ->where(function($query) use ($request) {
                if ($request->category_id) {
                    $query->where('category_id', $request->category_id);
                }
            })
            ->where(function($query) use ($request) {
                if ($request->date) {
                    $query->whereDate('created_at', $request->date);
                }
            })
            ->paginate(7);

        return view('admin', compact('contacts', 'categories'));
    }

    public function destroy(ContactRequest $request)
    {
        Contact::find($request->id)->delete();

        return redirect('/admin');
    }

    public function export(Request $request)
    {
        $contacts = Contact::with('category')
            ->get();

        $csvHeader = ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', 'お問い合わせ内容'];
        $csvData = [];

        foreach ($contacts as $contact) {
            $gender = $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他');
            $csvData[] = [
                $contact->last_name . $contact->first_name,
                $gender,
                $contact->email,
                $contact->category->content,
                $contact->detail,
            ];
        }

        $response = new \Symfony\Component\HttpFoundation\StreamedResponse(function() use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);
            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }, 200,);

        return $response;
    }

}
