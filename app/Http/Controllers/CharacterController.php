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

    public function overview($id, $slug)
    {
        $character = Character::findOrFail($id);
        if ($slug !== $character->slug()) {
            abort(404);
        }
        return view('character.overview', ['character' => Character::findOrFail($id)]);
    }

    public function settings($id, $slug)
    {
        $character = Character::findOrFail($id);
        if ($slug !== $character->slug()) {
            abort(404);
        }
        return view('character.settings', ['character' => Character::findOrFail($id)]);
    }
}
