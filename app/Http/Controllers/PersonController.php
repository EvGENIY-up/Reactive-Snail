<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::all();

        return response()->json([
            'success' => true,
            'data' => $people
        ]);
    }

    public function show($id)
    {
        $person = Person::find($id);

        if (!$person) {
            return response()->json([
                'success' => false,
                'message' => 'Person not found '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $person->toArray()
        ], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2|max:20',
            'surname' => 'required|string|min:2|max:25',
            'patronym' => 'required|string|min:2|max:25',
            'email' => 'required|email|max:20',
            'phone' => 'nullable|string|unique:people|max:20',
        ]);

        $person = new Person();
        $person->name = $request->name;
        $person->surname = $request->surname;
        $person->patronym = $request->patronym;
        $person->email = $request->email;
        $person->phone = $request->phone;
        $person->title = $request->title;
        $person->user_id = Auth::user()->id;

        if ($person->save())
            return response()->json([
                'success' => true,
                'data' => $person->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Person not added'
            ], 500);
    }

    public function update(Request $request, $id)
    {
        $person = Person::find($id);

        if (!$person) {
            return response()->json([
                'success' => false,
                'message' => 'Person not found'
            ], 400);
        }

        $updated = $person->update($request->all());

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Person can not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $person = Person::find($id);

        if (!$person) {
            return response()->json([
                'success' => false,
                'message' => 'Person not found'
            ], 400);
        }

        if ($person->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Person can not be deleted'
            ], 500);
        }
    }
}
