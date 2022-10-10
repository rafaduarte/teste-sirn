<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    protected $user, $profile;

    public function __construct(User $user, Profile $profile)
    {
        $this->user = $user;
        $this->profile = $profile;

        $this->middleware(['can:usuario']);
    }

    public function profiles($idUser)
    {
        $user = $this->user->find($idUser);

        if (!$user) {
            return redirect()->back();
        }

        $profiles = $user->profiles()->paginate();

        return view('admin.users.profiles.profiles', compact('user', 'profiles'));
    }


    /*public function users($idprofile)
    {
        if (!$profile = $this->profile->find($idprofile)) {
            return redirect()->back();
        }

        $users = $profile->users()->paginate();

        return view('admin.profiles.users.users', compact('profile', 'users'));
    } */


    public function profilesAvailable(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $profiles = $user->profilesAvailable($request->filter);

        return view('admin.users.profiles.available', compact('user', 'profiles', 'filters'));
    }


    public function attachProfilesUser(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser)) {
            return redirect()->back();
        }

        if (!$request->profiles || count($request->profiles) == 0) {
            return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos uma permissão');
        }

        $user->profiles()->attach($request->profiles);

        return redirect()->route('users.profiles', $user->id);
    }

    public function detachProfileUser($idUser, $idprofile)
    {
        $user = $this->user->find($idUser);
        $profile = $this->profile->find($idprofile);

        if (!$user || !$profile) {
            return redirect()->back();
        }

        $user->profiles()->detach($profile);

        return redirect()->route('users.profiles', $user->id);
    }
}
