<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Car;
use App\Models\Status;
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
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2|max:20',
            'surname' => 'required|string|min:2|max:25',
            'patronym' => 'required|string|min:2|max:25',
            'img' => 'nullable|string',
            'email' => 'required|email|',
            'phone' => 'nullable|string|unique:people|max:20',
        ]);

        $data = [
            'name' => $request->name,
            'surname' => $request->surname,
            'patronym' => $request->patronym,
            'img' => $request->img,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_id' => Auth::user()->id,
        ];

        $person = new Person($data);

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
        $this->validate($request, [
            'name' => 'required|string|min:2|max:20',
            'surname' => 'required|string|min:2|max:25',
            'patronym' => 'required|string|min:2|max:25',
            'email' => 'required|email',
            'phone' => 'nullable|string|unique:people|max:20',
        ]);

        $person = Person::find($id);

        if (!$person) {
            return response()->json([
                'success' => false,
                'message' => 'Person not found'
            ], 400);
        }

        $editPerson = [
            'name' => $request->name,
            'surname' => $request->surname,
            'patronym' => $request->patronym,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        $updated = $person->update($editPerson);

        if ($updated)
            return response()->json([
                'success' => true
            ], 200);
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
