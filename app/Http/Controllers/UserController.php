<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Company;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Phone;
use App\Models\Image;
use App\Http\Resources\AdminResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\StudentResource;
use App\Http\Resources\UserResource;
use App\Notifications\InvoicePaid;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;

use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class UserController extends Controller
{

    public function index()
    {
        //return new UtilisateurCollection(Utilisateur::all());
        return  UserResource::collection(User::all()/*paginate(3)*/);
    }
    public function listusers(Request $request)
    {
        // return $request->all();
        //return new UtilisateurCollection(Utilisateur::all());
       // return $request->results;
    return  UserResource::collection(User::orderBy($request->sortField/* || 'id'*/,$request->sortOrder!=null ? $request->sortOrder : 'asc')->paginate($request->results));

    }
    public function getUser(Request $request)
    {
        $user = new UserResource($request->user()); //$request->user();
        return $user;
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->public_id == null) {
            if ($request->is_locked)
                $user->update($request->all());
                 if ($request->user) {
                $user->update($request->user);
                if($request->userU)
                switch ($request->user_type) {
                    case 'student':
                       /* return $response = response()->json([
                            'message' => $request-> user_id,
                           'user'  => $request->student,
                        ], 201);*/
                        $student = Student::find($request-> user_id);
                        $student->update($request->userU);
                        break;
                    case 'company':
                        $company = Company::find($request-> user_id);
                        $company->update($request-> userU);
                        break;
                }
            }
             } else {
            if ($request->user) {
                $user->update($request->user);
                if($request->userU)
                switch ($request->user_type) {
                    case 'student':
                        $student = Student::find($request->student->id);
                        $student->update($request-> userU);
                        break;
                    case 'company':
                        $company = Company::find($request->student->id);
                        $company->update($request-> userU);
                        break;
                }
            }
            $data = cloudinary()->uploadApi()->explicit($request->public_id, [
                "type" => "upload",
                "eager" => [
                    ["width" => 128, "height" => 128,],
                    ["width" => 250, "height" => 300,],
                    // ["width" => 600, "height" => 400,],

                ]
            ]);
            $avatar = Image::updateOrCreate(
                ['imageable_id' => $id, 'imageable_type' => 'App\Models\User'],
                [
                    'name_img' => $request->filename, 'url' => $data['url'], 'format' => $data['format'], 'secure_url' => $data['secure_url'], 'size' => $data['bytes'],
                    'width' => $data['width'], 'height' => $data['height'], 'public_id' => $request->public_id, 'variants' => ["small" => $data['eager'][0], "hight" => $data['eager'][1],], //$data['eager'],,//$size,
                    'type_model' => 'avatar'
                ]
            );
        }
        /*if($request->is_locked)
        $user->is_locked=$request->is_locked;
        $user->save();*/
        $response = response()->json([
            'message' => 'The user has been updated succesfully',
           'user'  => new UserResource($user)
        ], 201);

        return $response;
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            $response = response()->json([
                'error' => [
                    'message' => 'This  user cannot be found.'
                ]
            ], 404);
            return $response;
        }

        //$response = new UserResource($user);
        return $response = response()->json([
            'message' => 'The user has been found',
           'user'  => new UserResource($user)
        ], 201);
    }
/*public function  test($id){
    $user = User::find($id);
    $user->notify(new InvoicePaid($id));
    return response()->json(['message' => 'Un email avec un lien de changement de mot de passe t a ete envoye']);
}*/
}
