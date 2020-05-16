<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();

        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::pluck('name','id');
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /*put in the request we created as an argument*/
    public function store(UsersRequest $request)
    {
        //getting the data input
        $input = $request->all();
        //check if photo file is present in the file
        if($file = $request->file('photo_id')){
            //appending time to file name
            $name = time().$file->getClientOriginalName();

            //moving the image file to the images folder(create it if it dont exist) giving it a name
            $file->move('images', $name);

            //creating the photo n persising the name into the db
            $photo = Photo::create(['file'=>$name]);

            //setting the created photo id
            $input['photo_id'] = $photo->id;
        }

        //encrypting the password
        $input['password'] = bcrypt($request->password);
        //creating the user with file details
        User::create($input);

        //persists the data into the database
        //User::create($request->all());

        //redirects to the admin/users/index
        return redirect('/admin/users');
        //return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
