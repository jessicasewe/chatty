<?php

namespace App\Http\Controllers;

use App\Models\chatty;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class ChattyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('chatty.index', [
            'chatty' => Chatty::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'message' => 'required|string|max:255'
        ]);

        $request->user()->chatty()->create($validate);

        return redirect(route('chatty.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(chatty $chatty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(chatty $chatty): View
    {
        Gate::authorize('update', $chatty);

        return view('chatty.edit', [
            'chatty' =>$chatty,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, chatty $chatty): RedirectResponse
    {
        Gate::authorize('update', $chatty);

        $validate = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $chatty->update($validate);

        return redirect(route('chatty.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(chatty $chatty): RedirectResponse
    {
        Gate::authorize('delete', $chatty);

        $chatty->delete();

        return redirect(route('chatty.index'));
    }
}
