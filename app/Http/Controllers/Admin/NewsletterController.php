<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function index()
    {
        $emails = Newsletter::latest()->paginate(10);
        return view('backend.newsletter.index', compact('emails'));
    }

    public function destroy($id)
    {
        Newsletter::findOrFail($id)->delete();
        return back()->with('success', 'Email berhasil dihapus!');
    }
}
