<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Platform;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use Inertia\Inertia;

class CategoryController extends Controller
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
            'platform' => $request->old('platform', 0),
            'parent' => $request->old('parent', 0),
            'name' => $request->old('name', ''),
            'name_short' => $request->old('name_short', ''),
            'url' => $request->old('url', ''),
            'map_prefix' => $request->old('map_prefix', ''),
            'description' => $request->old('description', '')
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

        return Inertia::render('Categories/New', [
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
                $resp = $resp->with('error', 'Category\'s platform does not exist!');
                Log::error('Unable to locate category\'s platform :: Platform ' . $validator['platform']);

                return $resp->withInput();
            }

            // Retrieve parent category.
            $parent = null;

            if (isset($validator['parent']))
                $parent = Category::find((int) $validator['parent']);

            // Create our data array.
            $data = [
                'platform_id' => $platform->id,
                'parent_id' => isset($parent) ? $parent->id : null,
                'name' => $validator['name'],
                'name_short' => $validator['name_short'],
                'url' => $validator['url'],
                'map_prefix' => $validator['map_prefix'],
                'description' => $validator['description']
            ];

            // Create category.
            $category = Category::create($data);

            if (!$category)
                return $resp->with('error', 'Category not created successfully.');

            // Check if we have an icon or banner to upload/set.
            if ($request->hasFile('icon')) {
                // Retrieve icon.
                $icon = $request->file('icon');

                // Generate file name.
                $ext = $icon->clientExtension();
                $file_name = $category->id . '.' . $ext;

                // Store publicly.
                $icon->storePubliclyAs('categories/icons', $file_name, 'public');

                // Set icon on category.
                $category->has_icon = true;

                $resave = true;
            }

            if ($request->hasFile('banner')) {
                // Retrieve banner.
                $banner = $request->file('banner');

                // Generate file name.
                $ext = $banner->clientExtension();
                $file_name = $category->id . '.' . $ext;

                // Store publicly.
                $banner->storePubliclyAs('categories/banners', $file_name, 'public');

                // Set icon on platform.
                $category->has_banner = true;

                $resave = true;
            }

            // Save the category if we need to.
            if ($resave)
                $category->save();
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

        // Retrieve existing category.
        $category = Category::find((int) $id);

        if (!$category) {
            return Inertia::render('Error/ResourceNotFound', [
                'meta' => $meta
            ]);
        }

        // Let's set up our data.
        $vals = [
            'platform' => $category->platform_id,
            'parent' => isset($category->parent_id) ? $category->parent_id : 0,
            'name' => $category->name,
            'name_short' => $category->name_short,
            'url' => $category->url,
            'map_prefix' => $category->map_prefix,
            'description' => $category->description
        ];

        // If we have old data, this indicates we had errors, but we want to make sure our new data isn't wiped.
        $oldData = $request->old('platform', null);

        if ($oldData)
            $vals['platform'] = $oldData;

        $oldData = $request->old('parent', null);

        if ($oldData)
            $vals['parent'] = $oldData;

        $oldData = $request->old('name', null);

        if ($oldData)
            $vals['name'] = $oldData;

        $oldData = $request->old('name_short', null);

        if ($oldData)
            $vals['name_short'] = $oldData;

        $oldData = $request->old('url', null);

        if ($oldData)
            $vals['url'] = $oldData;

        $oldData = $request->old('description', null);

        if ($oldData)
            $vals['description'] = $oldData;

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

        return Inertia::render('Categories/New', [
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

        // Try to retrieve category.
        $category = Category::find((int) $id);

        // Check if the category exists. If not, return a response indicating an error.
        if (!$category) {
            $resp = $resp->with('error', 'Category not found.')->withInput();
            Log::error('Unable to locate category :: Category ' . $id . ' not found.');

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
                $resp = $resp->with('error', 'Category\'s platform does not exist!')->withInput();
                Log::error('Unable to locate category\'s platform :: Category  ' . $id . ' Platform ' . $validator['platform']);

                return $resp;
            }

            // Retrieve parent category.
            $parent = null;

            if ($validator['parent'])
                $parent = Category::find((int) $validator['parent']);

            // Create our data array.
            $data = [
                'platform_id' => $platform->id,
                'parent_id' => isset($parent) ? $parent->id : 0,
                'name' => $validator['name'],
                'name_short' => $validator['name_short'],
                'url' => $validator['url'],
                'map_prefix' => $validator['map_prefix'],
                'description' => $validator['description']
            ];

            // Since we're updating our category, we can handle our icon and banner data now.
            if ($request->has('i-remove'))
                $data['has_icon'] = false;
            else if ($request->hasFile('icon')) {
                // Retrieve icon.
                $icon = $request->file('icon');

                // Generate file name.
                $ext = $icon->clientExtension();
                $file_name = $category->id . '.' . $ext;

                // Store publicly.
                $icon->storePubliclyAs('categories/icons', $file_name, 'public');

                // Set category icon.
                $data['has_icon'] = true;
            }

            if ($request->has('b-remove'))
                $data['has_banner'] = false;
            else if ($request->hasFile('banner')) {
                // Retrieve banner.
                $banner = $request->file('banner');

                // Generate file name.
                $ext = $banner->clientExtension();
                $file_name = $category->id . '.' . $ext;

                // Store publicly.
                $banner->storePubliclyAs('categories/banners', $file_name, 'public');

                // Set category banner.
                $data['has_banner'] = true;
            }

            // Update.
            $category->update($data);

            $category->save();
        }

        Log::info('Updating category with ID ' . $id);
        Log::debug('Category updated,  information => ' . print_r($category, true));

        return $resp->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resp = redirect()->back();

        $category = Category::find((int) $id);

        if (!$category)
            $resp = $resp->with('error', 'Category not found.');
        else
            $category->delete();

        return $resp;
    }

    private function makeValidation(Request $request) 
    {
        return Validator::make($request->all(), [
            'platform' => 'required|integer',
            'parent' => 'integer|nullable',
            'name' => 'required|string|max:255',
            'name_short' => 'required|string|max:64',
            'url' => 'string|max:255|nullable',
            'map_prefix' => 'string|max:32|nullable',
            'description' => 'string|nullable'
        ], [
            'platform.required' => 'The category\'s platform is required!',
            'name.required' => 'The category name is required.',
            'name_short.required' => 'The category short name is required.'
        ])->validateWithBag('category');
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

        if ($errors_session && ($errors_session = $errors_session->category)) {
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
