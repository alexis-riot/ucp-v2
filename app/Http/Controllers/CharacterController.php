<?php

namespace App\Http\Controllers;

use App\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id, $slug)
    {
        $character = Character::findOrFail($id);
        if ($slug !== $character->slug()) {
            abort(404);
        }
        return view('character.index', ['character' => Character::findOrFail($id)]);
    }
}
