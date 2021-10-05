<?php

namespace App\Http\Controllers;

use App\Models\ClientUser;
use Illuminate\Http\Request;

class ClientUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return clientUser::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'Client_User_FirstName',
        'Client_User_LastName',
        'Client_User_email',
        'Password',
        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);


        $path = $request->file('image')->store('/public/files');

    $banner = new ClientUser([
        'Client_User_FirstName' => $request->get('Client_User_FirstName'),
        'Client_User_LastName' => $request->get('Client_User_LastName'),
        'Client_User_email' => $request->get('Client_User_email'),
        'Password' => $request->get('Password'),
        'image' => $path
    ]);

    $banner->save();
    ClientUser::create($request->all());


























        // $input = $request->all();

        // if ($image = $request->file('image')) {
        //     $destinationPath = 'image/';
        //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $profileImage);
        //     $input['image'] = "$profileImage";
        // }

      //  ClientUser::create($input);



































        // $fileModel = new ClientUser;

        // if($request->file('image')) {

         // $fileName = time().'_'.$request->file->getClientOriginalName();
        //     $filePath = $request->file('file')->storeAs('images', $fileName, 'public');

        //     $fileModel->name = time().'_'.$request->file->getClientOriginalName();
        //     $fileModel->file_path = '/storage/' . $filePath;
        //     $fileModel->save();

        //     return back()
        //     ->with('success','File has been uploaded.')
        //     ->with('file', $fileName);
        // }














        // $path = $request->file('image')->store('/public/images');
        // $post = new Post;
        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->image = $path;
        // $post->save();

        // return redirect()->route('posts.index')
        //                 ->with('success','Post has been created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ClientUser::find($id);
        $clientUser = ClientUser::findOrFail($id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $Client= clientUser::find($id);
        $Client-> update($request->all());
        return $Client;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ClientUser::destroy($id);
    }
}
