<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProfile;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $repository;

   public function __construct(Profile $profile)
   {
        $this->repository = $profile; 
        
        $this->middleware(['can:setor']);
   }

   
   public function index()
   {
       $profiles = $this->repository->paginate();

       return view('admin.profiles.index', compact('profiles'));
   }


   public function create()
   {
       return view('admin.profiles.create');
   }


   public function store(StoreUpdateProfile $request)
   {
       $this->repository->create($request->all());

        return redirect()->route('profiles.index');
   }


   public function edit($id)
   {
       if (!$profile = $this->repository->find($id)) {
           return redirect()->back();
       }
       
       return view('admin.profiles.edit', compact('profile'));
   }


   public function update(StoreUpdateProfile $request, $id)
   {
    if (!$profile = $this->repository->find($id)) {
        return redirect()->back();
    }
    $profile->update($request->all());

    return redirect()->route('profiles.index');
   }


   public function show($id)
   {
       $profile = $this->repository->find($id);

       if (!$profile) {
           return redirect()->back();
       }

       return view('admin.profiles.show', compact('profile'));
   }


   public function destroy($id)
   {
    if (!$profile = $this->repository->find($id)) {
        return redirect()->back();
    }
    $profile->delete();

    return redirect()->route('profiles.index');
   }
   public function search(Request $request)
   {
       $filters = $request->except('_token');

       $profiles = $this->repository->search($request->filter);

       return view('admin.profiles.index', [
        'profiles' => $profiles,
        'filters' => $filters,
    ]);
   }
}
