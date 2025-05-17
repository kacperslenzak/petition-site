<?php

namespace App\Http\Controllers;

use App\Models\PetitionSignatures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{

    public function voteFor(Request $request)
    {
        $existingVote = PetitionSignatures::where('discord_id', Auth::User()->discord_id)->first();

        if($existingVote) {
            return redirect()->back();
        }

        PetitionSignatures::create([
            'discord_id' => Auth::user()->discord_id,
            'vote' => 1
        ]);

        return redirect()->back();
    }

    public function voteAgainst(Request $request)
    {
        $existingVote = PetitionSignatures::where('discord_id', Auth::User()->discord_id)->first();

        if($existingVote) {
            return redirect()->back();
        }

        PetitionSignatures::create([
            'discord_id' => Auth::user()->discord_id,
            'vote' => 0
        ]);

        return redirect()->back();
    }

    public function renderHomepage()
    {
        $votesFor = PetitionSignatures::where('vote', 1)->count();
        $votesAgainst = PetitionSignatures::where('vote', 0)->count();

        return view('welcome', compact('votesFor', 'votesAgainst'));
    }

}
