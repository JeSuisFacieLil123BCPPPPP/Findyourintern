<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Company;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Phone;
use App\Models\Image;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
       /* $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response()->noContent();*/
        if ($request->user_type == null)
            $request->user_type = 'normal';
        $validatedData = $request->validate([
            'pseudo' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        $user = User::create([
            'pseudo' => $validatedData['pseudo'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'user_type' => $request->user_type
        ]);
        /*  $user = User::create([
            'pseudo' => $request->pseudo,
            'email' =>  $request->email,
            'password' => Hash::make( $request->password),
            'user_type' => $request->user_type || 'normal',
        ]);*/
        switch ($request->user_type) {
            case 'admin':
                $this->admin($request, $user);
                break;
            case 'company':
                $this->company($request, $user);
                break;
            case 'student':
                $this->student($request, $user);
                break;
        }
        Auth::login($user,true);
        //$this->login($request);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function admin(Request $request, User $user)
    {
        /*$validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
        ]);*/
        $admin = new Admin([
            'firstname' => $request->firstname,
            'lastname' =>  $request->lastname,
            'pays' =>  $request->pays,
        ]);
        $user->admin()->save($admin);
    }
    public function company(Request $request, User $user)
    {
        //Company(id,company_name,pays,description,user_id)
        /* $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'description' => 'required|string',
        ]);*/
         /*nom de l'entreprise,adresse,ville, pays,site internet de
            l'entreprise,logo de l'entreprise,secteur d'activité,description de
            l'entreprise*/
        $company = new Company([
            'company_name' => $request->company_name,
            'pays' => $request->pays,
            'description' =>  $request->description,
            'ville' =>  $request->ville,
            'site' =>  $request->site,
            'logo' =>  $request->logo,
            'adresse' =>  $request->adresse,
        ]);
        $user->company()->save($company);
    }

    public function student(Request $request, User $user)
    {
        //Student(id,firstname,lastname,pays,school_name,user_id)
        /* $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'school_name' => 'required|string|max:255',
        ]);*/
        $student = new Student([
            'firstname' => $request->firstname,
            'lastname' =>  $request->lastname,
            'pays' =>  $request->pays,
            'filiere_id' =>  $request->filiere_id,
            'entity_id' =>  $request->entity_id,
            'matricule' =>  $request->matricule,
        ]);
        $user->student()->save($student);
    }

}
