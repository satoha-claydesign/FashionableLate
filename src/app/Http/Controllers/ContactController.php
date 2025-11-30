<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\StreamedResponse;



class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::with('category')->get();
        $categories = Category::all();
        return view('index', compact('contact', 'categories'));
    }

    public function confirm(ContactRequest $request)
        {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel01', 'tel02', 'tel03', 'address', 'building', 'category_id', 'category_content', 'detail']);
        return view('confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        if($request->input('back') == 'back')
        {
            return redirect('/')->withInput();
        }
        $contact = $request->only(['category_id', 'last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'detail']);
        Contact::create($contact);
        
        return view('thanks', compact('contact'));
    }

    public function adminContact()
    {
        $contacts  = Contact::Paginate(7);
        $categories = Category::all();
        $genders = config('gender_list');
        return view('admin', compact('contacts', 'categories'));
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin')->with('message', 'お問い合わせを削除しました');
    }

    public function search(Request $request)
    {
        $genders = config('genders');
        $keyword = $request->input('keyword');
        $gender = $request->input('gender');
        $category_id = $request->input('category_id');
        $date = $request->input('date');


        $query = Contact::query();


        if (!empty($gender)) {
            $query->where('gender', $gender)->get();
        }

        if (!empty($category_id)) {
            $query->where('category_id', $category_id)->get();
        }

        if (!empty($keyword)) {
            $query->where('last_name', 'like', "$keyword%")
            ->orWhere('first_name', 'like', "$keyword%")
            ->orWhere('email', 'like' , "$keyword%")->get();
        }

        if (!empty($date)) {
            $query->whereDate('created_at', $date)->get();
        }
        $contacts = $query->paginate(7);

        $categories = Category::all();
        return view('admin', ['contacts' => $contacts->appends($request->except('page')), 'categories' => $categories, 'genders' => $genders, 'request'=>$request->except('page')]);
    }

    public function downloadCsv()
    {
        $contacts = Contact::all();
        $csvHeader = [
        'id',
        'category_id',
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
        'created_at',
        'updated_at', ];
        $csvData = $contacts->toArray();

        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);

            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users.csv"',
        ]);

        return $response;
    }

}