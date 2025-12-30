<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DogController extends Controller
{
    public function index()
    {
        $dogs = Dog::where('user_id', Auth::id())->get();

        return view('dogs.index', compact('dogs'));
    }

    public function create()
    {
        return view('dogs.create');
    }

    public function store(Request $request)
    {
        Dog::create([
            'user_id'   => $request->user()->id,
            'name'      => $request->name,
            'color'     => $request->color,
            'size'      => $request->size,
            'is_public' => $request->boolean('is_public'),
        ]);

        return redirect()->route('dogs.index');
    }

    public function show(Dog $dog)
    {
        //
    }

    public function edit(Dog $dog)
    {
        //
    }

    public function update(Request $request, Dog $dog)
    {
        //
    }

    public function destroy(Dog $dog)
    {
        //
    }
}
