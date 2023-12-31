<?php

namespace Modules\Configuration\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Configuration\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    protected $categories;
    protected $destinationPath;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
        $this->destinationPath = 'categories';
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $categoryListData = [];

        $categories = $this->categories->with(['subcategory'])->get();;

        foreach ($categories as $category) {
            $subcategories = $category->subcategory()->pluck('title')->toArray();           
            $categoryData = [
                'id' => $category->id,
                "categoryImg" => 'storage/' . $category->image_path,
                "categoryTitle" => $category->title,
                "subCategory" => $subcategories,
                "description" => $category->description
            ];

            // Add the current category data to $categoryListData array
            $categoryListData[] = $categoryData;
        }


        return view('Configuration::Category.index')
            ->withCategories($categories)
            ->withCategoryListData($categoryListData);
    }

 

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {


        $data = $request->except(['attachment']);

        if ($request->file('attachment')) {
            $data['image_path'] = $request->file('attachment')
                ->storeAs($this->destinationPath, time() . '.' . $request->file('attachment')
                    ->getClientOriginalExtension());
        }

        if ($data['id'] === null) {
            unset($data['id']); // Remove the 'id' field if it's null for insertion
            $category = $this->categories->create($data);
            $message = $category ? 'Category added successfully!!' : 'OOPS, Category cannot be added!!';
        } else {
            $category = $this->categories->find($data['id']);
            if ($category) {
                $category->update($data);
                $message = 'Category updated successfully!!';
            } else {
                $message = 'OOPS, Category cannot be updated!!';
            }
        }
        session()->flash('message.updated', $message);
        return redirect()->route('category.index');
    }

    
    public function destroy($id)
    {

        // Assuming $id holds the ID of the category to be deleted
        $category = $this->categories->find($id);

        if ($category) {
            // Get the file path associated with the category
            $filePath = $category->image_path;

            // Delete the file if it exists
            if ($filePath && Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

            // Delete the category itself
            $flag = $this->categories->destroy($id);

            if ($flag) {
                return response()->json(['status' => 200, 'message' => 'Category and associated files successfully deleted.'], 200);
            } else {
                session()->flash('message.updated', "Failed to delete category");
                return redirect()->route('category.index');
            }
        } else {
            return response()->json(['status' => 404, 'message' => 'Category not found.'], 404);
        }
    }
}
