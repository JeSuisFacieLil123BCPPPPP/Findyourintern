<?php

namespace App\Http\Controllers\Cache;

use App\Http\Controllers\Controller;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Redis\RedisException;

class OffreController1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllOffresCacheUser(Request $request, int $id)
    {
        $list = Redis::lrange('offres_' . $id, 0, -1);
        //$id_to_find =  $request->index;
        $result = array();
        foreach ($list as $valeur) {
            $offre = Redis::HGET($valeur, 'offre');
            $result[]=json_decode($offre);
            }
       /* if (in_array($id_to_find, $list)) {
            // L'ID de hash a été trouvé dans la liste à l'index $index
            $offre = Redis::HGET($id_to_find, 'offre');
        } else {
            return [
                'data' => null,
                'message' => "C' est vide"
            ];
        }*/
        return [
            'data' => $result,
            'message' => "La liste est complète"
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {

        $list = Redis::lrange('offres_' . $id, 0, -1);
        $id_to_find =  $request->index;
        if (in_array($id_to_find, $list)) {
            // L'ID de hash a été trouvé dans la liste à l'index $index
            $offre = Redis::HGET($id_to_find, 'offre');
        } else {
            return [
                'data' => null,
                'message' => "C' est vide"
            ];
        }
        return [
            'data' => json_decode($offre),
            'message' => "Trouvé "
        ];
    }
    /* if($cachedOffre){
      $offre = $cachedOffre;//json_decode($cachedOffre, FALSE);
      return [
        'data'=>$offre,
        'message'=>"Succès"
    ];
        }
        return [
            'data'=>null,
            'message'=>"C' est vide"
        ];
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        try {
        $list = Redis::lrange('offres_' . $id, 0, -1);
        $id_to_find =  $request->index;
        if (in_array($id_to_find, $list)) {
            // L'ID de hash a été trouvé dans la liste à l'index $index
            $result = Redis::hmset($id_to_find, ['offre' => json_encode($request->offre)]);
        } else {
            Redis::HSET($request->index, 'offre', json_encode($request->offre));
            $result = Redis::LPUSH('offres_' . $id, $request->index);
        }
        return [
            'data' => $request->offre,
            'message' => "Succès de la mise à jour"
        ];
    } catch (RedisException $e) {
        // Annuler la transaction
        return response()->json($e, 500);
       //return $e;
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, int $id)
    {
        $list = Redis::lrange('offres_' . $id, 0, -1);
        $search = array_search($request->index, $list);

        if ($search === false) {
            return [
                'data'=>$search,
                'message' => "Pas trouvé"
            ];
        } else {
            Redis::del($request->index);
            Redis::lrem('offres_' . $id, 0,$request->index);
            echo "L'élément se trouve à l'index " . $search;
        }
        return [
            'data'=>$list ,
            'message' => "Supression avec succès"
        ];
    }
}
