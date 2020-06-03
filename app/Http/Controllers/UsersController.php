<?php

namespace App\Http\Controllers;

use App\ActiveStatus;
use App\Http\Requests\SaveUserRequest;
use App\Http\Requests\UsersEditRequest;
use App\photo;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$users = User::all();
        // view('admin.users.index',compact('users'));
        return view('admin.index');
    }

    /*
     * Display all users
     *
     * */
    public function users()
    {
        if (Auth::user()->isActive()) {
            $users = User::all();
            return view('admin.users.index', compact('users'));
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get roles and status from the database
        $status = ActiveStatus::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');
        if (Auth::user()->isActive()) {
            return view('admin.users.create', compact('roles', 'status'));
        }

        return redirect()->back();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    /*put in the request we created as an argument*/
    public function store(SaveUserRequest $request)
    {
        //dd($request->photo);
        //getting the data input
        $input = $request->validated();
        //unset($input['photo']);
        //check if photo file is present in the file
        if ($file = $request->file('photo')) {

            $name = time() . $file->getClientOriginalName();
            $file->move('app/storage/images', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }
        /*if ($file = $request->file('photo')) {
            //appending time to file name
            $name = time() . $file->getClientOriginalName();
            Storage::put($request->photo,$name,'public');
            //moving the image file to the images folder(create it if it don't exist) giving it a name
            //$file->move('storage/images', $name);
            /*TODO CHECK CODE AFTER TESTING*/
            //Storage::putFileAs($file, $name);
            //Storage::putFileAs('images', $file, $name);
            //creating the photo n persisting the name into the db
           // $photo = Photo::create(['file' => $name]);
            //dd($photo);

            //setting the created photo id
            //$input['photo_id'] = $photo->id;
       // }*/

        //encrypting the password
        $input['password'] = bcrypt($request->password);
        //creating the user with file details
        User::create($input);

        //set a flash message
        Session::flash('add_user', 'The user: ' . $input['name'] . ', has been added');
        //persists the data into the database
        //User::create($request->all());

        //redirects to the admin/users/index
        return redirect('/admin/users');
        //return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find the user by the passed in id
        $user = User::findOrFail($id);
        //get the roles
        $roles = Role::pluck('name', 'id');
        //get statuses
        $status = ActiveStatus::pluck('name', 'id');

        return view('admin.users.edit', compact('user', 'roles', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {

        //TODO filter empty password field first and then perfom the encryption
        if (trim($request['password']) == '') {
            $input = $request->except('password');
        } else {

            //grab the input
            $input = $request->all();
            $input['password'] = bcrypt($request->password);

        }

        //find the user
        $user = User::findOrFail($id);

        //check if we have the file
        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();
            $file->move('storage/images', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }

        $user->update($input);
        //set a flash message
        Session::flash('update_user', 'The user: ' . $user->name . ', has been updated');
        return redirect('admin/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete the user
        $user = User::find($id);
        //Storage::unlink('images/'.$user->photo->file);
        //unlink(storage_path().$user->photo->file);

            if(file_exists($user->photo->file)){
                unlink($user->photo->file);
            }

        if($user->delete()){
            //set a flash message
            Session::flash('deleted_user',  ucfirst($user->name) . ', has been deleted');
            return redirect('admin/users/');
        }else{
            //set flash message
            Session::flash('deleted_user', 'The user: ' . $user->name . ', could not be deleted');
            return redirect('admin/users/');

        }



    }
}
