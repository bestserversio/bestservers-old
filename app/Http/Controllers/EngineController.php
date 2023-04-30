<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EngineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $meta = gen_meta();

        // See if we have existing values.
        $vals = [
            'name' => $request->old('name', ''),
            'name_short' => $request->old('name_short', ''),
            'description' => $request->old('description', ''),
            'is_a2s' => $request->old('is_a2s', false),
            'is_discord' => $request->old('is_discord', false)
        ];

        // Generate CSRF token for protection.
        $csrf = csrf_token();

        $error = null;

        $errors = $request->session()->get('errors');

        if ($errors) {
            $errors = $errors->engine;

            
            $error = [];
            $error['title'] = "Unable To Create Engine";

            foreach ($errors->all() as $err) {
                $error['message'] = $err;

                break;
            }
        }

        return Inertia::render('Engines/New', [
            'meta' => $meta,
            'values' => $vals,
            'csrf' => $csrf,
            'errors' => $error
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'name_short' => 'required|string|max:64',
            'description' => 'string',
            'is_a2s' => 'required|boolean',
            'is_discord' => 'required|boolean'
        ], [
            'name.required' => 'The engine name is required.',
            'name_short.required' => 'The engine short name is required.',
            'is_a2s.required' => 'The engine is A2S field is required.'
        ])->validateWithBag('engine');

        return redirect()->back()->withErrors($validator);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
