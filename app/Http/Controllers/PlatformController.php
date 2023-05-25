<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Platform;
use App\Models\Engine;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use Inertia\Inertia;

class PlatformController extends Controller
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
            'engine' =>  $request->old('engine', 0),
            'name' => $request->old('name', ''),
            'name_short' => $request->old('name_short', ''),
            'description' => $request->old('description', ''),
            'url' => $request->old('url', ''),
            'html5_supported' => $request->old('html5_supported', false),
            'html5_external' => $request->old('html5_external', false),
            'html5_url' => $request->old('html5_url', null)
        ];

        // Successful insert.
        $success = false;

        // Generate CSRF token for protection.
        $csrf = csrf_token();

        // Retrieve any errors we may have.
        $errors = $this->getErrors($request);

        // If $errors isn't NULL, but we don't have any items in our array, it should indicate a success.
        // Investigate: Maybe flash the session with a 'success' item to indicate success instead of relying on outcome of $errors?
        if (isset($errors) && empty($errors))
            $success = true;

        $engines = Engine::all();

        return Inertia::render('Platforms/New', [
            'meta' => $meta,
            'values' => $vals,
            'csrf' => $csrf,
            'errors' => $errors,
            'engines' => $engines,
            'success' => $success
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $resp = redirect()->back();

        // Validation
        $validator = $this->makeValidation($request);

        if ($validator) {
            // Retrieve engine.
            $engine = Engine::find((int)$validator['engine']);

            // Make sure engine exists.
            if (!$engine) {
                $resp = $resp->with('error', 'Platform\'s engine does not exist!');
                Log::error('Unable to locate platform\'s engine :: Engine ' . $validator['engine']);

                return $resp->withInput();
            }

            // Create engine.
            $platform = Platform::create([
                'engine_id' => $engine->id,
                'name' => $validator['name'],
                'name_short' => $validator['name_short'],
                'description' => $validator['description'],
                'url' => $validator['url'],
                'html5_supported' => $request->has('html5_supported'),
                'html5_external' => $request->has('html5_external'),
                'html5_url' => $validator['html5_url']
            ]);

            if (!$platform)
                return $resp->with('error', 'Platform not created successfully.');
        }

        return $resp->withErrors($validator);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        $meta = gen_meta();

        // Retrieve existing platform.
        $platform = Platform::find((int) $id);

        if (!$platform) {
            return Inertia::render('Error/ResourceNotFound', [
                'meta' => $meta
            ]);
        }

        // Let's set up our data.
        $vals = [
            'engine' => (isset($platform->engine_id)) ? $platform->engine_id : 0,
            'name' => $platform->name,
            'name_short' => $platform->name_short,
            'description' => $platform->description,
            'url' => $platform->url,
            'html5_supported' => $platform->html5_supported,
            'html5_external' => $platform->html5_external,
            'html5_url' => $platform->html5_url
        ];

        // If we have old data, this indicates we had errors, but we want to make sure our new data isn't wiped.
        $oldData = $request->old('engine', null);

        if ($oldData)
            $vals['engine'] = $oldData;

        $oldData = $request->old('name', null);

        if ($oldData)
            $vals['name'] = $oldData;

        $oldData = $request->old('name_short', null);

        if ($oldData)
            $vals['name_short'] = $oldData;

        $oldData = $request->old('description', null);

        if ($oldData)
            $vals['description'] = $oldData;

        $oldData = $request->old('url', null);

        if ($oldData)
            $vals['url'] = $oldData;

        $oldData = $request->old('html5_supported', null);

        if ($oldData)
            $vals['html5_supported'] = $oldData;

        $oldData = $request->old('html5_external', null);

        if ($oldData)
            $vals['html5_external'] = $oldData;

        $oldData = $request->old('html5_url', null);

        if ($oldData)
            $vals['html5_url'] = $oldData;

        // Successful edit.
        $success = false;

        // Generate CSRF token for protection.
        $csrf = csrf_token();

        // Retrieve any errors we may have.
        $errors = $this->getErrors($request);

        // If $errors isn't NULL, but we don't have any items in our array, it should indicate a success.
        if (isset($errors) && empty($errors))
            $success = true;

        // Retrieve all engines.
        $engines = Engine::all();

        return Inertia::render('Platforms/New', [
            'meta' => $meta,
            'id' => $id,
            'values' => $vals,
            'csrf' => $csrf,
            'errors' => $errors,
            'engines' => $engines,
            'success' => $success,
            'btn_text' => 'Edit!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Start building our response.
        $resp = redirect()->back();

        // Try to retrieve platform.
        $platform = Platform::find((int) $id);

        // Check if the platform exists. If not, return a response indicating an error.
        if (!$platform) {
            $resp = $resp->with('error', 'Platform not found.')->withInput();
            Log::error('Unable to locate platform :: Platform ' . $id . ' not found.');

            return $resp;
        }

        // Create validator.
        $validator = $this->makeValidation($request);

        // Check if validated and if so, insert into database.
        if ($validator) {
            // Retrieve engine.
            $engine = Engine::find((int)$validator['engine']);

            // Make sure engine exists.
            if (!$engine) {
                $resp = $resp->with('error', 'Platform\'s engine does not exist!')->withInput();
                Log::error('Unable to locate platform\'s engine :: Platform  ' . $id . ' Engine ' . $validator['engine']);

                return $resp;
            }

            // Update.
            $platform->update([
                'engine_id' => $engine->id,
                'name' => $validator['name'],
                'name_short' => $validator['name_short'],
                'description' => $validator['description'],
                'url' => $validator['url'],
                'html5_supported' => $request->has('html5_supported'),
                'html5_external' => $request->has('html5_external'),
                'html5_url' => $validator['html5_url']
            ]);

            $platform->save();
        }

        Log::info('Updating platform with ID ' . $id);
        Log::debug('Platform Updated Information => ' . print_r($platform, true));

        return $resp->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resp = redirect()->back();

        $platform = Platform::find((int) $id);

        if (!$platform)
            $resp = $resp->with('error', 'Platform not found.');
        else
            $platform->delete();

        return $resp;
    }

    private function makeValidation(Request $request) 
    {
        return Validator::make($request->all(), [
            'engine' => 'required|integer',
            'name' => 'required|string|max:255',
            'name_short' => 'required|string|max:64',
            'description' => 'string|nullable',
            'url' => 'required|string|max:255',
            'html5_url' => 'string|nullable|max:255'
        ], [
            'name.required' => 'The platform name is required.',
            'name_short.required' => 'The platform short name is required.',
            'url.required' => 'The platform URL is required.'
        ])->validateWithBag('platform');
    }

    private function getErrors(Request $request)
    {
        // Handle validation errors if any.
        $errors = null;

        // Check for single error.
        if ($request->session()->has('error')) {
            $errors = [];
            $errors[] = [
                'title' => 'Error!',
                'message' => $request->session()->get('error')
            ];

            return $errors;
        }

        $errors_session = $request->session()->get('errors');

        if ($errors_session && ($errors_session = $errors_session->platform)) {
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
