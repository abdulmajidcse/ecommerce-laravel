<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SocialContact;

class SocialContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $social_contacts = SocialContact::orderBy('priority', 'asc')->get();
        return view('admin.social_contacts.all_social_contact', ['social_contacts' => $social_contacts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.social_contacts.add_social_contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'social_url' => 'required|url|max:255|unique:social_contacts',
            'icon' => 'required|mimes:png|max:4000',
            'priority' => 'required|numeric|min:1|unique:social_contacts'
        ]);

        $social_contact = new SocialContact();
        $social_contact->social_url = $request->social_url;
        
        //if image valid, go to upload image and store settings
        $icon = $request->file('icon');
        if ($icon) {
            $extension = $request->icon->extension();
            $icon_name = time() . "." . $extension;
            $upload_path = 'images/social-contact-images/';
            $icon_url = $upload_path . $icon_name;

            $social_contact->icon = $icon_url;

            //image upload on folder
            $icon->move($upload_path, $icon_name);
        }
        $social_contact->priority = $request->priority;
        $social_contact->save();

        $notification = [
            'message' => 'Successfully social contact added!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $social_contact = SocialContact::find($id);
        if ($social_contact) {
            return view('admin.social_contacts.edit_social_contact', ['social_contact' => $social_contact]);
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'social_url' => 'required|url|max:255|unique:social_contacts,social_url,'.$id,
            'icon' => 'nullable|mimes:png|max:4000',
            'priority' => 'required|numeric|min:1|unique:social_contacts,priority,'.$id
        ]);

        $social_contact = SocialContact::find($id);
        $social_contact->social_url = $request->social_url;
        
        //if image valid, go to upload image and store settings
        $icon = $request->file('icon');
        if ($icon) {
            if (file_exists($social_contact->icon)) {
                unlink($social_contact->icon);
            }
            $extension = $request->icon->extension();
            $icon_name = time() . "." . $extension;
            $upload_path = 'images/social-contact-images/';
            $icon_url = $upload_path . $icon_name;

            $social_contact->icon = $icon_url;

            //image upload on folder
            $icon->move($upload_path, $icon_name);
        }
        $social_contact->priority = $request->priority;
        $social_contact->save();

        $notification = [
            'message' => 'Successfully social contact saved!',
            'alert-type' => 'success',
        ];
        return redirect('admin/social-contacts')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $social_contact = SocialContact::find($id);
        if ($social_contact) {
            if (file_exists($social_contact->icon)) {
                unlink($social_contact->icon);
            }
            $social_contact->delete();
            $notification = [
                'message' => 'Successfully social contact deleted!',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
        }
        return redirect()->back()->with($notification);
    }
}
