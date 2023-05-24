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

        // Retrieve any errors we may have.
        $errors = $this->getErrors($request);

        // If $errors isn't NULL, but we don't have any items in our array, it should indicate a success.
        // Investigate: Maybe flash the session with a 'success' item to indicate success instead of relying on outcome of $errors?
        if ($errors != null && count($errors) < 1)
            $success = true;

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
        $validator = $this->makeValidation($request);

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
    public function edit(string $id, Request $request)
    {
        $meta = gen_meta();

        // Retrieve existing engine.
        $engine = Engine::firstWhere('id', (int) $id);

        if (!$engine) {
            return Inertia::render('Error/ResourceNotFound', [
                'meta' => $meta
            ]);
        }

        // Let's set up our data.
        $vals = [
            'name' => $engine->name,
            'name_short' => $engine->name_short,
            'description' => $engine->description,
            'is_a2s' => $engine->is_a2s,
            'is_discord' => $engine->is_discord
        ];

        // If we have old data, this indicates we had errors, but we want to make sure our new data isn't wiped.
        $oldData = $request->old('name', null);

        if ($oldData) {
            $vals['name'] = $oldData;
        }

        $oldData = $request->old('name_short', null);

        if ($oldData) {
            $vals['name_short'] = $oldData;
        }

        $oldData = $request->old('description', null);

        if ($oldData) {
            $vals['description'] = $oldData;
        }

        $oldData = $request->old('is_a2s', null);

        if ($oldData) {
            $vals['is_a2s'] = $oldData;
        }

        $oldData = $request->old('is_discord', null);

        if ($oldData) {
            $vals['is_discord'] = $oldData;
        }

        // Successful edit.
        $success = false;

        // Generate CSRF token for protection.
        $csrf = csrf_token();

        // Retrieve any errors we may have.
        $errors = $this->getErrors($request);

        // If $errors isn't NULL, but we don't have any items in our array, it should indicate a success.
        if ($errors != null && count($errors) < 1)
            $success = true;

        return Inertia::render('Engines/New', [
            'meta' => $meta,
            'id' => $id,
            'values' => $vals,
            'csrf' => $csrf,
            'errors' => $errors,
            'success' => $success,
            'btn_text' => 'Edit!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Log::debug("Updating engine with ID " . (int)$id);
        $resp = redirect()->back();

        // Validation
        $validator = $this->makeValidation($request);

        // Check if validated and if so, insert into database.
        if ($validator) {
            $engine = Engine::find((int) $id);

            if (!$engine) {
                $resp = $resp->with('error', 'Engine not found.');

                Log::debug("Engine not found!");
            } else {
                // Update.
                $engine->update([
                    'name' => $validator['name'],
                    'name_short' => $validator['name_short'],
                    'description' => $validator['description'],
                    'is_a2s' => $request->has('is_a2s'),
                    'is_discord' => $request->has('is_discord')
                ]);

                $engine->save();

                Log::debug("Updating engine!");
                Log::debug(print_r($engine, true));
            }
        }

        return $resp->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resp = redirect()->back();

        $engine = Engine::find((int) $id);

        if (!$engine) {
            $resp = $resp->with('error', 'Engine not found.');
        } else {
            $engine->delete();
        }

        return $resp;
    }

    private function makeValidation(Request $request) 
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'name_short' => 'required|string|max:64',
            'description' => 'string|nullable'
        ], [
            'name.required' => 'The engine name is required.',
            'name_short.required' => 'The engine short name is required.'
        ])->validateWithBag('engine');
    }

    private function getErrors(Request $request)
    {
        // Handle validation errors if any.
        $errors = null;

        $errors_session = $request->session()->get('errors');

        if ($errors_session && ($errors_session = $errors_session->engine)) {
            $errors = [];
            $errors_all = $errors_session->all();

            // Make sure we have errors stored in array.
            if (count($errors_all)) {
                // To do: Determine field name and use that in title.
                foreach ($errors_session->all() as $num => $err) {
                    $errors[] = [
                        'title' => 'Error #' . ($num + 1),
                        'message' => $err
                    ];
                }
            }
        }

        return $errors;
    }
}
