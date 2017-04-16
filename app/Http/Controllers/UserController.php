<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

use App\Repositories\UserRepository;

use Illuminate\Http\Request;

use File;

class UserController extends Controller
{


    protected $userRepository;

    protected $nbrPerPage = 4;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->middleware('admin', ['except' => ['updateImage', 'update']]);
        
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getPaginate($this->nbrPerPage);
        $links = $users->render();

        return view('users.index', compact('users', 'links'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserCreateRequest $request)
    {
        $this->setAdmin($request);
        
        $user = $this->userRepository->store($request->all());

        return redirect('user')->withOk("L'utilisateur " . $user->email . " a été créé.");
    }

    public function show($id)
    {
        $user = $this->userRepository->getById($id);

        return view('users.show',  compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userRepository->getById($id);

        return view('users.edit',  compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $this->setAdmin($request);

        $this->userRepository->update($id, $request->all());
        
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->userRepository->destroy($id);

        return back();
    }

    private function setAdmin($request)
    {
        if(!$request->has('admin'))
        {
            $request->merge(['admin' => 0]);
        }       
    }

    public function updateImage(Request $request, $id)
    {

        if($request->hasFile('image'))
        {
            $image = $request->file('image');

            $img = $this->userRepository->moveImage($image, 'uploads/users');

            $inputs = [
            'image' => $img
            ];

            $user_image = $request->user()->image;

            if($user_image != 'user.png')
            {
                File::delete("uploads/users/" . $user_image);
            }

            $this->userRepository->update($request->user()->id, $inputs);

        }
       

        return redirect()->back();
    }
}
