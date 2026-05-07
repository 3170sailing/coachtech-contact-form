<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('contact.index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
{
    $contact = $request->only([
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel1',
        'tel2',
        'tel3',
        'address',
        'building',
        'detail',
    ]);

    $contact['tel'] = $contact['tel1'] . $contact['tel2'] . $contact['tel3'];

    $category = Category::find($contact['category_id']);

    return view('contact.confirm', compact('contact', 'category'));
}

    public function store(ContactRequest $request)
    {
        Contact::create($request->only([
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail',
        ]));

        return redirect('/thanks');
    }

    public function correction(Request $request)
    {
        return redirect('/')->withInput();
    }

    public function thanks()
    {
        return view('contact.thanks');
    }
}