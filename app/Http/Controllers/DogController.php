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
        $this->authorize('viewAny', Dog::class);

        $dogs = Dog::where('user_id', auth()->id())->get();
        $colors = Dog::colors();
        $sizes = Dog::sizes();

        return view('dogs.index', compact('dogs', 'colors', 'sizes'));
    }

    public function create()
    {
        $dog = new Dog();
        $colors = Dog::colors();
        $sizes = Dog::sizes();

        return view('dogs.create', compact('dog', 'colors', 'sizes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'color' => ['required', Rule::in(array_keys(Dog::colors()))],
            'size'  => ['required', Rule::in(array_keys(Dog::sizes()))],
            'is_public' => ['nullable'],
        ]);

        Dog::create([
            'user_id'   => $request->user()->id,
            'name'      => $validated['name'],
            'color'     => $validated['color'],
            'size'      => $validated['size'],
            'is_public' => $request->boolean('is_public'),
        ]);

        return redirect()->route('dogs.index')->with('success', '登録しました🐶✨');
    }

    public function show(Dog $dog)
    {
        $this->authorize('view', $dog);

        return view('dogs.show', compact('dog'));
    }

    public function edit(Dog $dog)
    {
        $this->authorize('update', $dog);
        $colors = Dog::colors();
        $sizes = Dog::sizes();

        return view('dogs.edit', compact('dog', 'colors', 'sizes'));
    }

    public function update(Request $request, Dog $dog)
    {
        $this->authorize('update', $dog);

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'color' => ['required', Rule::in(array_keys(Dog::colors()))],
            'size'  => ['required', Rule::in(array_keys(Dog::sizes()))],
            'is_public' => ['nullable'],
        ]);

        $validated['is_public'] = $request->boolean('is_public');

        $dog->update($validated);

        return redirect()->route('dogs.index')->with('success', '更新しました🐶✨');
    }

    public function destroy(Dog $dog)
    {
        $this->authorize('delete', $dog);

        $dog->delete();

        return redirect()->route('dogs.index')->with('success', '削除しました🐶');
    }

    public function public()
    {
        $dogs = Dog::where('is_public', true)
            ->latest()
            ->get();
        $colors = Dog::colors();
        $sizes = Dog::sizes();

        return view('dogs.public', compact('dogs', 'colors', 'sizes'));
    }

    public function togglePublic(Dog $dog)
    {
        $this->authorize('togglePublic', $dog);

        $dog->update([
            'is_public' => ! $dog->is_public,
        ]);

        return back()->with('success', '公開状態を変更しました🐶');
    }
}
