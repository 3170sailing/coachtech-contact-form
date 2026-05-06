<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        $contacts = Contact::with('category')
            ->KeywordSearch($request->keyword)
            ->CategorySearch($request->category_id)
            ->GenderSearch($request->gender)
            ->DateSearch($request->date)
            ->paginate(7)
            ->appends($request->query());

        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();

        return redirect('/admin');
    }

    public function export(Request $request)
    {
        $contacts = Contact::with('category')
            ->KeywordSearch($request->keyword)
            ->CategorySearch($request->category_id)
            ->GenderSearch($request->gender)
            ->DateSearch($request->date)
            ->get();

        $csvHeader = [
            'お名前',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            '建物名',
            'お問い合わせの種類',
            'お問い合わせ内容',
        ];

        $csvData = [];

        foreach ($contacts as $contact) {
            $gender = '';
            if ($contact->gender == 1) {
                $gender = '男性';
            } elseif ($contact->gender == 2) {
                $gender = '女性';
            } else {
                $gender = 'その他';
            }

            $csvData[] = [
                $contact->last_name . ' ' . $contact->first_name,
                $gender,
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                optional($contact->category)->content,
                $contact->detail,
            ];
        }

        $callback = function () use ($csvHeader, $csvData) {
            $file = fopen('php://output', 'w');

            stream_filter_prepend($file, 'convert.iconv.utf-8/cp932//TRANSLIT');

            fputcsv($file, $csvHeader);

            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=contacts.csv',
        ]);
    }
}