<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::all();
        return $user;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (is_array($request->pokemon) && !empty($request->pokemon) && count($request->pokemon) == 6) {
            $user = new User();
            $user->name = $request->name;
            $user->save();

            foreach($request->pokemon as $id){
                $pokemon = new Pokemon();
                $pokemon->user_id = $user->id;
                $pokemon->number_pokede = $id;
                $pokemon->save();

            }

            return [
                'user' => $user->id,
                'pokemon' => $request->pokemon,

            ];

        }
        return [
            'status' => false,
            'msg' => 'Verifique datos, pokemon no validos'

        ];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function users_pokemon(Request $request)
    {
        //

        $pokemon = DB::table('pokemon')
        ->get();

        $user_count = User::get()->count();


        $user = DB::table('user')
                ->offset(!empty($request->offset) ? $request->offset : 0)
                ->limit(!empty($request->limit) ? $request->limit : 20)
        ->get();

        foreach ($user as $j => $valueUser) {

            $pokemon_data = [];
            foreach ($pokemon as $i => $valuePokemon) {
                # code...
                if ($valueUser->id == $valuePokemon->user_id){
                    $pokemon_data[] = $valuePokemon->number_pokede;
                    $user[$j]->all_pokemon = $pokemon_data;
                    foreach ($pokemon_data as $c => $value) {
                        $column = 'pokemon' . $c +1;
                        $user[$j]->$column = $value;
                    }
                }
            }

        }

        return [
            'data' => $user,
            'total' => $user_count
        ];

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $user = User::findOrFail($request->id);

        $user->name = $request->name;

        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
