<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kurs;
use App\Models\classes;
use App\Models\items;

class KursAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $kurs = kurs::orderBy('id', 'DESC')->get();
        return view('admin.kurs.kursA', [
            'kurs' => $kurs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = items::orderBy('id', 'DESC')->get();
        $class = classes::orderBy('id', 'DESC')->get();
        return view('admin.kurs.kursACreate', [
            'items'=>$items,
            'class'=>$class,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedDate = $request->validate([
            'item_id' => 'required|exists:items,id',
            'classes_id' => 'required|exists:classes,id',
            'topic' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $kurs = new Kurs();
        $kurs->item_id = $validatedDate['item_id'];
        $kurs->classes_id = $validatedDate['classes_id'];
        $kurs->topic = $validatedDate['topic'];
        $kurs->description = $validatedDate['description'];

        $kurs->save();
        return redirect()->back()->withSuccess("Курс был успешно добавлен");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kurs $kurs)
    {
        $items = items::all();
        $class = classes::all();

        return view('admin.kurs.kursAEdit', compact('kurs', 'items', 'class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kurs $kurs)
    {
        $validatedDate = $request->validate([
            'item_id'=>'required|exists:items,id',
            'classes_id'=>'required|exists:classes,id',
            'topic' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $kurs->fill($validatedDate)->save();

        return redirect()->back()->withSuccess('Курс был успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kurs $kurs)
    {
         $kurs->delete();
        return redirect()->back()->withSuccess('Курс был успешно удален!');
    }
}
