<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\RealisationsController;
use App\Http\Controllers\ConversationsController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\Cache\OffreController1;
use App\Http\Controllers\Cache\CVBuilderController;
use App\Http\Controllers\PortfolioController;

use App\Http\Controllers\InfosStdsController;
use App\Http\Controllers\SalaireController;//PreferencesPosteController
use App\Http\Controllers\PreferencesPosteController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\LangueController;
use App\Http\Controllers\CuriculumController;

use App\Http\Controllers\IA\JobOfferValidatorController;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\StudentController;

use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\MetierController;
use App\Http\Controllers\ReponsePostulerController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getUser']);

require __DIR__.'/auth.php';
/*Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('user/logout', [UserController::class, 'logout']);*/
//Route::post('api/broadcasting/auth', [UserController::class, 'getUser']);
Route::post('/reves/oui', function (Request $request) {
    return Broadcast::auth($request);
});
Route::post('v1/broadcasting/auth', function (Request $request) {
   
   $pusher = new Pusher\Pusher(
        config('broadcasting.connections.pusher.key'),
        config('broadcasting.connections.pusher.secret'),
        config('broadcasting.connections.pusher.app_id'),
        [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'encrypted' =>false
        ]
    );
    $socketId = $request->input('socket_id');
    $channelName = $request->input('channel_name');

    $user = Auth::user();

    if (!$user) {
        return response()->json(['auth' => false]);
    }

    $presenceData = [
        'user_id' => $user->id,
        'user_info' => [
            'email' => $user->email
        ]
    ];

    $auth = $pusher->socket_auth($channelName, $socketId,json_encode($presenceData));
   // return Broadcast::auth($request);
    return $auth;
    });
Route::group(['prefix' => 'v1',/*'middleware' => 'api'*/], function () {
    Route::post('offre/cache/init/{id}',[ OffreController1::class,'show']);
    Route::post('offre/cache/{id}',[OffreController1::class,'update']);
    Route::post('offre/cache/delete/{id}',[OffreController1::class,'delete']);
    Route::get('offre/cache/getAllOffresCacheUser/{id}', [OffreController1::class,'getAllOffresCacheUser']);
// getAllOffresCacheUser
//// getAllOffresCacheUser

    Route::post('cvbuilder/addWorkExperience', [CVBuilderController::class, 'addWorkExperience']);
    Route::post('cvbuilder/deleteWorkExperience', [CVBuilderController::class, 'deleteWorkExperience']);
    Route::post('cvbuilder/addorUpdateDetailsStudent', [CVBuilderController::class, 'addorUpdateDetailsStudent']);


    Route::get('getActive', [JobOfferValidatorController::class, 'train']);

    Route::get('cvbuilder/getStudentCvBuilder/{studentId}', [CVBuilderController::class, 'getStudentCvBuilder']);
    Route::get('cvbuilder/getExperiencesCvBuilder/{studentId}', [CVBuilderController::class, 'getExperiencesCvBuilder']);
    //addWorkExperience getStudentCvBuilder getExperiencesCvBuilder addorUpdateDetailsStudent

    Route::get('users/', [UserController::class, 'index']);
    Route::get('users/list', [UserController::class, 'listusers']);
    Route::put('users/edit/{id}', [UserController::class, 'update']);
    Route::get('users/show/{id}', [UserController::class, 'show']);
    //Route::post('users/message', [MessageController::class, 'store']);
    //Route::get('users/messages/user/{userId}/userRecId/{userRecId}', [MessageController::class, 'getMessageFrom']);
    
    Route::get('conversations', [ConversationsController::class, 'index']);
    Route::get('conversation/{userRecId}', [ConversationsController::class, 'show']);
    Route::post('conversation/sendMessage', [ConversationsController::class, 'sendMessage']);

    Route::post('reponse/postuler', [ReponsePostulerController::class, 'store']);


    Route::post('test/{id}', [UserController::class, 'test']);

    Route::apiResource('entities',EntityController::class);//->middleware('visitor');
    Route::get('/filieres', [FiliereController::class, 'allFilieres'])->name('filieres.index');
    Route::apiResource('entities.filieres', FiliereController::class)->shallow();
    Route::apiResource('tags', TagsController::class);
    Route::apiResource('metiers',MetierController::class);

    //realisationsByUser
    Route::get('/realisations/getRealisationsByUser/{userId}', [RealisationsController::class, 'getRealisationsByUser'])->name('realisations.getRealisationsByUser');//->middleware('visitor');
    Route::get('/realisations/getRealisationsByTagFirsts/{realisationId}', [RealisationsController::class, 'getRealisationsByTagFirsts'])->name('realisations.getRealisationsByTagFirsts');//->middleware('visitor');
    Route::get('/realisations/getRealisationsForUser/{userId}', [RealisationsController::class, 'getRealisationsForUser'])->name('realisations.getRealisationsForUser');//->middleware('visitor');

    Route::get('/offres/getOffresForUser/{userId}', [OffreController::class, 'getOffresForUser'])->name('realisations.getOffresForUser');

   
   // Route::get('/offres/postulants/{postulerId}', [OffreController::class, 'getPostulantForOffre'])->name('realisations.getPostulantForOffre');
 
  //getOffresPostulerUser
  Route::get('/offres/getPostulantsbyOffre/{offreId}', [OffreController::class, 'getPostulantsbyOffre'])->name('offres.getPostulantsbyOffre');
  Route::get('/offres/getOffresPostulerUser/{userId}', [OffreController::class, 'getOffresPostulerUser'])->name('offres.getOffresPostulerUser');
  Route::put('/offre/action/{id}', [OffreController::class, 'action']);


  
Route::apiResource('users.realisations', RealisationsController::class);

Route::apiResource('companies',CompanyController::class);
Route::apiResource('students',StudentController::class);

    Route::apiResource('users.offres', OffreController::class);

    Route::apiResource('infosSupp', InfosStdsController::class);
    Route::apiResource('salaires', SalaireController::class);
    Route::apiResource('prefsPoste',PreferencesPosteController::class);
    Route::apiResource('experiences',ExperienceController::class);
    Route::apiResource('formations',FormationController::class);
    Route::apiResource('competences',CompetenceController::class);
    Route::apiResource('langues',LangueController::class);
    Route::apiResource('curiculums',CuriculumController::class);
    Route::post('/langues/updateOrCreate', [LangueController::class, 'updateOrCreate']);
    Route::post('/prefsPoste/updateOrCreate', [PreferencesPosteController::class, 'updateOrCreate']);
   
    Route::get('/realisations', [RealisationsController::class, 'allRealisations']);//->middleware('visitor');//->name('realisations.allRealisations');
    Route::get('/realisations/getAllRealisationsValide', [RealisationsController::class, 'getAllRealisationsValide'])->name('realisations.getAllRealisationsValide');//->middleware('visitor');

    Route::get('/realisations/getRealisationsPaginate', [RealisationsController::class, 'getRealisationsPaginate'])->name('realisations.getRealisationsPaginate');//->middleware('visitor');
    Route::get('/offres/getOffresPaginate', [OffreController::class, 'getOffresPaginate'])->name('offres.getOffresPaginate');


    Route::get('/realisations/getAllRealisationsNoValide', [RealisationsController::class, 'getAllRealisationsNoValide'])->name('realisations.getAllRealisationsNoValide');//->middleware('visitor');
    Route::get('/portfolios/getAllPortfolios', [PortfolioController::class,'getAllPortfolios'])->name('portfolios.getAllPortfolios');
    Route::get('/offres/getAllOffresSearch', [OffreController::class, 'getAllOffresSearch'])->name('offres.getAllOffresSearch');
    Route::get('/realisations/getAllRealisationsValideSearch', [RealisationsController::class, 'getAllRealisationsValideSearch'])->name('realisations.getAllRealisationsValideSearch');
    Route::get('/realisations/{id}', [RealisationsController::class, 'show'])/*->middleware('visitor')*/->name('realisation.show');
    Route::delete('/realisation/delete/{id}', [RealisationsController::class, 'delete'])->name('realisation.delete');

   // Route::get('/realisations/getAllOffrValideSearch', [RealisationsController::class, 'getAllRealisationsValideSearch'])->name('realisations.getAllRealisationsValideSearch');
    Route::get('/offres/{id}', [OffreController::class, 'show'])/*->middleware('visitor')*/->name('offre.show');
    Route::delete('/offre/delete/{id}', [OffreController::class, 'delete'])->name('offre.delete');

    Route::get('/portfolio/user/{id}', [PortfolioController::class, 'getPortfoliobyUserId']);
    Route::get('/portfolio/{id}', [PortfolioController::class, 'show']);

    
    Route::post('/realisation/{realisationId}/user/{userId}/like', [RealisationsController::class, 'like']);
    Route::post('/realisation/{realisationId}/user/{userId}/dislike', [RealisationsController::class, 'dislike']);

    Route::post('/offre/postuler', [OffreController::class, 'postuler']);
    Route::post('/portfolio/create/{userId}', [PortfolioController::class, 'store']);



    Route::post('/realisation/{realisationId}/user/{userId}/unlike', [RealisationsController::class, 'unlike']);
    Route::post('/realisation/{realisationId}/user/{userId}/undislike', [RealisationsController::class, 'undislike']);


    Route::post('/comment/{commentId}/user/{userId}/like', [CommentController::class, 'like']);
    Route::post('/comment/{commentId}/user/{userId}/dislike', [CommentController::class, 'dislike']);
    Route::post('/comment/{commentId}/user/{userId}/unlike', [CommentController::class, 'unlike']);
    Route::post('/comment/{commentId}/user/{userId}/undislike', [CommentController::class, 'undislike']);



    //commentsPaginate
    Route::delete('/comment/{commentId}', [CommentController::class, 'destroy']);
//api/v1/realisations/{realisation}/users/{user}/comments

Route::get('/realisations/{realisationId}/comments/{commentId?}', [CommentController::class,'indexComment']);
Route::get('/realisations/{realisationId}/commentsPaginate/{commentId?}', [CommentController::class,'commentsPaginate']);

    Route::post('/my_notification_endpoint/{realisationId}', [RealisationsController::class, 'my_notification_endpoint'])->name('my_notification_endpoint');
    
    Route::apiResource('realisations.users.comments',CommentController::class)->shallow();

    Route::get('/visitors', [VisitorController::class, 'index'])->name('visitors.index');  //getAllUsersConnected
    Route::get('/getAllUsersConnected', [VisitorController::class, 'getAllUsersConnected'])->name('visitors.getAllUsersConnected');
});
