<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Search for a contact by phone number
    public function search(Request $request)
    {
        $contact = Contact::where('phone_number', $request->phone_number)->first();
        
        if ($contact) {
            return response()->json(['name' => $contact->name]);
        } else {
            return response()->json(['message' => 'No contact found.']);
        }
    }

    // Store a new contact or return if it's a duplicate
    public function store(Request $request)
    {
        $contact = Contact::where('phone_number', $request->phone_number)->first();

        if ($contact) {
            return response()->json(['message' => 'Duplicate entry found.']);
        } else {
            $newContact = Contact::create([
                'phone_number' => $request->phone_number,
                'name' => $request->name
            ]);

            return response()->json(['message' => 'New contact added.', 'id' => $newContact->id]);
        }
    }
}
