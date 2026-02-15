<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::latest()->paginate(10);
        return view('hospitals.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('hospitals.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|string|unique:rooms,room_number',
            'type' => 'required|in:single,double,ICU',
            'status' => 'required|in:available,occupied',
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index')->with('success','Room created successfully.');
    }

    public function show(Room $room)
    {
        return view('hospitals.rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('hospitals.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_number' => 'required|string|unique:rooms,room_number,' . $room->id,
            'type' => 'required|in:single,double,ICU',
            'status' => 'required|in:available,occupied',
        ]);

        $room->update($request->all());

        return redirect()->route('rooms.index')->with('success','Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success','Room deleted successfully.');
    }
}
