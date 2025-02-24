<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attraction;
use App\Models\Type;
use App\Models\Tag;
class AttractionController extends Controller
{
    public function index() {
        $attractions = Attraction::with(['types', 'tags'])->get();
        return view('admin.attractions.index', compact('attractions'));
    }

    public function create() {
        $types = Type::all();
        $tags = Tag::all();
        return view('admin.attractions.create', compact('types', 'tags'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'types' => 'required|array',
            'tags' => 'nullable|array',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('attractions', 'public') : null;

        $attraction = Attraction::create([
            'name' => $request->name,
            'image' => $imagePath
        ]);

        $attraction->types()->attach($request->types);
        $attraction->tags()->attach($request->tags);

        return redirect()->route('admin.attractions')->with('success', 'Аттракцион добавлен!');
    }


    public function destroy($id) {
        $attraction = Attraction::findOrFail($id);
        $attraction->types()->detach();
        $attraction->tags()->detach();
        $attraction->delete();

        return redirect()->route('admin.attractions')->with('success', 'Аттракцион удалён.');
    }

    public function showAll() {
        $attractions = Attraction::with(['types', 'tags'])->get();
        return view('tickets', compact('attractions'));
    }

}
