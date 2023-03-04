<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Realisations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Shetabit\Visitor;
//use App\Models\Realisations;
class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //Visitor()->onlineVisitors(User::class); 
        $model=Realisations::find(3);
       //return $user->isOnline();
       // $user=User::find(6);
      // return  $request;
        //$realisation= Realisations::find(2);
       // $user = User::find();
       //Request::visitor()->browser();
      /*User::visit();
      Realisations::createVisitLog();*/
      // return  Request::visitor()->browser(); //->distinct('ip')->count('ip');//Request::visitor()->browser();
        //return User::online()->get();
        $visiteurs = DB::table('shetabit_visits')->where('visitable_type', Realisations::class)->get();//distinct('ip')->count('ip');//->get();
        return visitor()->onlineVisitors(User::class)->count();//->where('user_type','admin')->count();//visitor()->onlineVisitors(User::class); //$model->visitLogs()->count();//User::visitLogs()->distinct('ip')->count('ip');//User::online()->where('user_type','admin')->get();
    }

    public function getAllUsersConnected(){
         $usersconnected=visitor()->onlineVisitors(User::class)->count();
        $adminsconnected=visitor()->onlineVisitors(User::class)->where('user_type','admin')->count();
        $companiesconnected=visitor()->onlineVisitors(User::class)->where('user_type','company')->count();
        $studentsconnected=visitor()->onlineVisitors(User::class)->where('user_type','student')->count();
         $normalsconnected=visitor()->onlineVisitors(User::class)->where('user_type','normal')->count();

       return  response()->json([
            'usersconnected' => $usersconnected,
            'adminsconnected'=>  $adminsconnected,
            'companiesconnected'=>  $companiesconnected,
            'studentsconnected'=>   $studentsconnected,
            'normalsconnected'=>  $normalsconnected,
        ], 201); 
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   /* public function store(Request $request, $realisation_id)
    {
        $realisation = Realisations::findOrFail($realisation_id);
        $files = $request->file('files');
        $json = array(
            'files' => array()
        );

        foreach ($files as $file) {

            $destination = 'public/files';
            $size = $file->getSize();
            $filename = $file->getClientOriginalName();
            $extension = $file->extension();
            $fullName = $filename . '.' . $extension;
            $pathToFile = $destination . '/' . $fullName;
            $upload_success = $realisation->files()->save($destination . '/' . $fullName);

            if ($upload_success) {
                $json['files'][] = array(
                    'name' => $filename,
                    'size' => $size,
                    'url' => $pathToFile,
                    'message' => 'Uploaded successfully'
                );
                return response()->json($json);
            } else {
                $json['files'][] = array(
                    'message' => 'error uploading files',
                );
                return response()->json($json, 202);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
   /* public function show(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
   /* public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
  /*  public function destroy(File $file)
    {
        
    }*/
}
