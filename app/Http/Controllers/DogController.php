<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DogController extends Controller
{
    public function index()
    {
        $dogs = Dog::where('user_id', Auth::id())->get();

        return view('dogs.index', compact('dogs'));
    }

    public function create()
    {
        $sizes = Dog::sizes();
        return view('dogs.create', compact('sizes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:255'],
            'size'  => ['required', Rule::in(array_keys(Dog::sizes()))],
            `is_public` => ['nullable'],
        ]);

        Dog::create([
            'user_id'   => $request->user()->id,
            'name'      => $validated['name'],
            'color'     => $validated['color'],
            'size'      => $validated['size'],
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
