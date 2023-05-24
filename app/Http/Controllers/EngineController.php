<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use App\Models\Engine;

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

        // Successful insert.
        $success = false;

        // Generate CSRF token for protection.
        $csrf = csrf_token();

        // Handle validation errors if any.
        $errors = null;

        $errors_session = $request->session()->get('errors');

        if ($errors_session && ($errors_session = $errors_session->engine)) {
            $errors = [];
            $errors_all = $errors_session->all();

            // Make sure we have errors stored in array.
            if (count($errors_all)) {
                /* To do: Determine field name and use that in title. */
                foreach ($errors_session->all() as $num => $err) {
                    $errors[] = [
                        'title' => 'Error #' . ($num + 1),
                        'message' => $err
                    ];
                }
            } else {
                // If we don't, it indicates a successful entry.
                $success = true;
            }
        }

        return Inertia::render('Engines/New', [
            'meta' => $meta,
            'values' => $vals,
            'csrf' => $csrf,
            'errors' => $errors,
            'success' => $success
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
            'description' => 'string|nullable',
            'is_a2s' => 'boolean',
            'is_discord' => 'boolean'
        ], [
            'name.required' => 'The engine name is required.',
            'name_short.required' => 'The engine short name is required.'
        ])->validateWithBag('engine');

        // Check if validated and if so, insert into database.
        if ($validator) {
            Engine::create([
                'name' => $validator['name'],
                'name_short' => $validator['name_short'],
                'description' => isset($validator['description']) ? $validator['description'] : null,
                'is_a2s' => isset($validator['is_a2s']) ? $validator['is_a2s'] : false,
                'is_discord' => isset($validator['is_discord']) ? $validator['is_discord'] : false
            ]);
        }

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
