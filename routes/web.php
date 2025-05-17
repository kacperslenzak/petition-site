<?php

use App\Http\Controllers\Auth\DiscordController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VoteController::class, 'renderHomepage']);

Route::get('auth/discord', [DiscordController::class, 'redirectToDiscord'])->name('auth.discord');
Route::get('auth/discord/callback', [DiscordController::class, 'handleDiscordCallback']);

Route::post('/vote-for', [VoteController::class, 'voteFor'])->name('vote.for');
Route::post('/vote-against', [VoteController::class, 'voteAgainst'])->name('vote.against');
