<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Platform;
use App\Models\Server;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use Inertia\Inertia;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $meta = gen_meta();

        // See if we have existing values.
        $vals = [
            'platform' => $request->old('platform', 0),
            'category' => $request->old('category', 0),
            'name' => $request->old('name', ''),
            'description' => $request->old('description', ''),
            'url' => $request->old('url', ''),
            'rules' => $request->old('rules', ''),
            'ipv4' => $request->old('ipv4', ''),
            'ipv6' => $request->old('ipv6', ''),
            'port' => $request->old('port', ''),
            'host_name' => $request->old('host_name', ''),
            'location' => $request->old('location', ''),
            'social_website' => $request->old('social_website', ''),
            'social_twitter' => $request->old('social_twitter', ''),
            'social_youtube' => $request->old('social_youtube', ''),
            'social_facebook' => $request->old('social_facebook', ''),
            'social_tiktok' => $request->old('social_tiktok'),
            'social_instagram' => $request->old('social_instagram'),
            'social_github' => $request->old('social_github'),
            'social_steam' => $request->old('social_steam')
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

        // Platforms & Categories.
        $platforms = Platform::all();
        $categories = Category::all();

        return Inertia::render('Servers/New', [
            'meta' => $meta,
            'values' => $vals,
            'csrf' => $csrf,
            'errors' => $errors,
            'success' => $success,
            'platforms' => $platforms,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $meta = gen_meta();
        
        // Platforms & Categories
        $platforms = [];
        $categories = [];

        return Inertia::render('Servers/New', [
            'meta' => $meta,
            'platforms' => $platforms,
            'categories' => $categories
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
            // Retrieve platform.
            $platform = Platform::find((int)$validator['platform']);

            // Make sure platform exists.
            if (!$platform) {
                $resp = $resp->with('error', 'Server\'s platform does not exist!');
                Log::error('Unable to locate server\'s platform :: Platform ' . $validator['platform']);

                return $resp->withInput();
            }

            // Retrieve parent category.
            $category = null;

            if (isset($validator['category']))
                $category = Category::find((int) $validator['category']);

            // To Do: Do more validation/parsing.

            // Create our data array.
            $data = [
                'platform_id' => $platform->id,
                'category_id' => isset($category) ? $category->id : null,
                'name' => $validator['name'],
                'description' => $validator['description'],
                'url' => $validator['url'],
                'rules' => $validator['rules'],
                'ipv4' => $validator['ipv4'],
                'ipv6' => $validator['ipv6'],
                'port' => $validator['port'],
                'host_name' => $validator['host_name'],
                'location_lat' => null,
                'location_lon' => null,
                'social_website' => $validator['social_website'],
                'social_twitter' => $validator['social_twitter'],
                'social_youtube' => $validator['social_youtube'],
                'social_facebook' => $validator['social_facebook'],
                'social_tiktok' => $validator['social_tiktok'],
                'social_instagram' => $validator['social_instagram'],
                'social_github' => $validator['social_github'],
                'social_steam' => $validator['social_steam']
            ];

            // Create server.
            $server = Server::create($data);

            if (!$server)
                return $resp->with('error', 'Server not created successfully.');

            $resave = false;

            // Check if we have an avatar or banner to upload/set.
            if ($request->hasFile('avatar')) {
                // Retrieve avatar.
                $avatar = $request->file('avatar');

                // Generate file name.
                $ext = $avatar->clientExtension();
                $file_name = $server->id . '.' . $ext;

                // Store publicly.
                $avatar->storePubliclyAs('servers/avatars', $file_name, 'public');

                // Set avatar on server.
                $server->has_avatar = true;

                $resave = true;
            }

            if ($request->hasFile('banner')) {
                // Retrieve banner.
                $banner = $request->file('banner');

                // Generate file name.
                $ext = $banner->clientExtension();
                $file_name = $server->id . '.' . $ext;

                // Store publicly.
                $banner->storePubliclyAs('servers/banners', $file_name, 'public');

                // Set banner on server.
                $server->has_banner = true;

                $resave = true;
            }

            // Save the server if we need to.
            if ($resave)
                $server->save();
        }

        return $resp->withErrors($validator);
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

        // Retrieve existing server.
        $server = Server::find((int) $id);

        if (!$server) {
            return Inertia::render('Error/ResourceNotFound', [
                'meta' => $meta
            ]);
        }

        // Let's set up our data.
        $vals = [
            'platform' => $server->platform_id,
            'category' => isset($server->category_id) ? $server->category_id : 0,
            'name' => $server->name,
            'description' => $server->description,
            'url' => $server->url,
            'rules' => $server->rules,
            'ipv4' => $server->ipv4,
            'ipv6' => $server->ipv6,
            'port' => $server->port,
            'host_name' => $server->host_name,
            'social_website' => $server->social_website,
            'social_twitter' => $server->social_twitter,
            'social_youtube' => $server->social_youtube,
            'social_facebook' => $server->social_facebook,
            'social_tiktok' => $server->social_tiktok,
            'social_instagram' => $server->social_instagram,
            'social_github' => $server->social_github,
            'social_steam' => $server->social_steam
        ];

        // If we have old data, this indicates we had errors, but we want to make sure our new data isn't wiped.
        $oldData = $request->old('platform', null);

        if ($oldData)
            $vals['platform'] = $oldData;

        $oldData = $request->old('category', null);

        if ($oldData)
            $vals['category'] = $oldData;

        $oldData = $request->old('name', null);

        if ($oldData)
            $vals['name'] = $oldData;

        $oldData = $request->old('description', null);

        if ($oldData)
            $vals['description'] = $oldData;

        $oldData = $request->old('url', null);

        if ($oldData)
            $vals['url'] = $oldData;

        $oldData = $request->old('rules', null);

        if ($oldData)
            $vals['rules'] = $oldData;

        $oldData = $request->old('ipv4', null);

        if ($oldData)
            $vals['ipv4'] = $oldData;

        $oldData = $request->old('ipv6', null);

        if ($oldData)
            $vals['ipv6'] = $oldData;
        
        $oldData = $request->old('port', null);

        if ($oldData)
            $vals['port'] = $oldData;
        
        $oldData = $request->old('host_name', null);

        if ($oldData)
            $vals['host_name'] = $oldData;
        
        $oldData = $request->old('location', null);

        if ($oldData)
            $vals['location'] = $oldData;

        $oldData = $request->old('social_website', null);

        if ($oldData)
            $vals['social_website'] = $oldData;

        $oldData = $request->old('social_twitter', null);

        if ($oldData)
            $vals['social_twitter'] = $oldData;

        $oldData = $request->old('social_youtube', null);

        if ($oldData)
            $vals['social_youtube'] = $oldData;

        $oldData = $request->old('social_facebook', null);

        if ($oldData)
            $vals['social_facebook'] = $oldData;

        $oldData = $request->old('social_tiktok', null);

        if ($oldData)
            $vals['social_tiktok'] = $oldData;

        $oldData = $request->old('social_instagram', null);

        if ($oldData)
            $vals['social_instagram'] = $oldData;

        $oldData = $request->old('social_github', null);

        if ($oldData)
            $vals['social_github'] = $oldData;

        $oldData = $request->old('social_steam', null);

        if ($oldData)
            $vals['social_steam'] = $oldData;

        // Successful edit.
        $success = false;

        // Generate CSRF token for protection.
        $csrf = csrf_token();

        // Retrieve any errors we may have.
        $errors = $this->getErrors($request);

        // If $errors isn't NULL, but we don't have any items in our array, it should indicate a success.
        if (isset($errors) && empty($errors))
            $success = true;

        // Retrieve all platforms.
        $platforms = Platform::all();

        // Retrieve all categories.
        $categories = Category::all();

        return Inertia::render('Servers/New', [
            'meta' => $meta,
            'id' => $id,
            'values' => $vals,
            'csrf' => $csrf,
            'errors' => $errors,
            'platforms' => $platforms,
            'categories' => $categories,
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

        // Try to retrieve server.
        $server = Server::find((int) $id);

        // Check if the server exists. If not, return a response indicating an error.
        if (!$server) {
            $resp = $resp->with('error', 'Server not found.')->withInput();
            Log::error('Unable to locate server :: Server ' . $id . ' not found.');

            return $resp;
        }

        // Create validator.
        $validator = $this->makeValidation($request);

        // Check if validated and if so, insert into database.
        if ($validator) {
            // Retrieve platform.
            $platform = Platform::find((int)$validator['platform']);

            // Make sure platform exists.
            if (!$platform) {
                $resp = $resp->with('error', 'Server\'s platform does not exist!')->withInput();
                Log::error('Unable to locate server\'s platform :: Server  ' . $id . ' Platform ' . $validator['platform']);

                return $resp;
            }

            // Retrieve category.
            $category = null;

            if ($validator['category'])
                $category = Category::find((int) $validator['category']);

            // Create our data array.
            $data = [
                'platform_id' => $platform->id,
                'category_id' => isset($category) ? $category->id : 0,
                'name' => $validator['name'],
                'description' => $validator['description'],
                'url' => $validator['url'],
                'rules' => $validator['rules'],
                'ipv4' => $validator['ipv4'],
                'ipv6' => $validator['ipv6'],
                'port' => $validator['port'],
                'host_name' => $validator['host_name'],
                'location_lat' => null,
                'location_lon' => null,
                'social_website' => $validator['social_website'],
                'social_twitter' => $validator['social_twitter'],
                'social_youtube' => $validator['social_youtube'],
                'social_facebook' => $validator['social_facebook'],
                'social_tiktok' => $validator['social_tiktok'],
                'social_instagram' => $validator['social_instagram'],
                'social_github' => $validator['social_github'],
                'social_steam' => $validator['social_steam']
            ];

            // Since we're updating our server, we can handle our avatar and banner data now.
            if ($request->has('a-remove'))
                $data['has_avatar'] = false;
            else if ($request->hasFile('avatar')) {
                // Retrieve avatar.
                $avatar = $request->file('avatar');

                // Generate file name.
                $ext = $avatar->clientExtension();
                $file_name = $server->id . '.' . $ext;

                // Store publicly.
                $avatar->storePubliclyAs('servers/avatars', $file_name, 'public');

                // Set server avatar.
                $data['has_avatar'] = true;
            }

            if ($request->has('b-remove'))
                $data['has_banner'] = false;
            else if ($request->hasFile('banner')) {
                // Retrieve banner.
                $banner = $request->file('banner');

                // Generate file name.
                $ext = $banner->clientExtension();
                $file_name = $server->id . '.' . $ext;

                // Store publicly.
                $banner->storePubliclyAs('servers/banners', $file_name, 'public');

                // Set server banner.
                $data['has_banner'] = true;
            }

            // Update.
            $server->update($data);

            $server->save();
        }

        Log::info('Updating server with ID ' . $id);
        Log::debug('Server updated,  information => ' . print_r($server, true));

        return $resp->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resp = redirect()->back();

        $server = Server::find((int) $id);

        if (!$server)
            $resp = $resp->with('error', 'Server not found.');
        else
            $server->delete();

        return $resp;
    }

    private function makeValidation(Request $request) 
    {
        return Validator::make($request->all(), [
            'platform' => 'required|integer',
            'category' => 'integer|nullable',
            'banner' => 'file|nullable',
            'avatar' => 'file|nullable',
            'name' => 'required|string|max:255',
            'description' => 'string|nullable',
            'url' => 'string|max:255|nullable',
            'rules' => 'string|nullable',
            'ipv4' => 'ipv4|nullable',
            'ipv6' => 'ipv6|nullable',
            'port' => 'digits_between:1,65535|nullable',
            'host_name' => 'string|nullable',
            'location' => 'string|nullable',
            'social_website' => 'string|nullable',
            'social_twitter' => 'string|nullable',
            'social_youtube' => 'string|nullable',
            'social_facebook' => 'string|nullable',
            'social_tiktok' => 'string|nullable',
            'social_instagram' => 'string|nullable',
            'social_github' => 'string|nullable',
            'social_steam' => 'string|nullable'
        ], [
            'platform.required' => 'The server\'s platform is required!',
            'name.required' => 'The server name is required.'
        ])->validateWithBag('server');
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

        if ($errors_session && ($errors_session = $errors_session->server)) {
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
