<?php

namespace Modules\Configuration\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Configuration\Repositories\SubCategoryRepository;
use Illuminate\Support\Facades\Storage;
use Modules\Configuration\Repositories\CategoryRepository;

class SubCategoryController extends Controller
{
    protected $subcategories;
    protected $categories;
    protected $destinationPath;

    public function __construct(SubCategoryRepository $subcategories, CategoryRepository $categories)
    {
        $this->subcategories = $subcategories;
        $this->categories = $categories;
        $this->destinationPath = 'subcategories';
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $subCategoriesData = [];
        
        $subcategories=$this->subcategories->with(['category'])->get();
        
        foreach ($subcategories as $subcategory) {
            $category = $subcategory->category; 
            $subcategoryData = [
                'id' => $subcategory->id,
                "subcategory" => $subcategory->title,
                "category" => $category->title,
                "category_id" => $category->id,
                "description" => $subcategory->description
            ];

                    // Add the current category data to $subcategoryListData array
            $subCategoriesData[] = $subcategoryData;
        }
        $categories=$this->categories->all();

        return view('Configuration::SubCategory.index')
            ->withSubcategories($subcategories)
            ->withCategories($categories)
            ->withSubCategoriesData($subCategoriesData);
    }

 

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {


        $data = $request->all();
        
        

            if ($data['id'] === null) {
            unset($data['id']); // Remove the 'id' field if it's null for insertion
            $subcategory = $this->subcategories->create($data);
            $message = $subcategory ? 'Category added successfully!!' : 'OOPS, Category cannot be added!!';
        } else {
            $subcategory = $this->subcategories->find($data['id']);
            if ($subcategory) {
                $subcategory->update($data);
                $message = 'Sub Category updated successfully!!';
            } else {
                $message = 'OOPS, Sub Category cannot be updated!!';
            }
        }
       session()->flash('message.updated', $message);
       return redirect()->route('subcategories.index');
    }

    
    public function destroy($id)
    {

        // Assuming $id holds the ID of the category to be deleted
        $subcategory = $this->subcategories->find($id);

        if ($subcategory) {
            // Get the file path associated with the category
            $filePath = $subcategory->image_path;

            // Delete the file if it exists
            if ($filePath && Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

            // Delete the category itself
            $deleted = $subcategory->delete();

            if ($deleted) {
                return response()->json(['status' => 200, 'message' => 'Category and associated files successfully deleted.'], 200);
            } else {
                return response()->json(['status' => 500, 'message' => 'Failed to delete category.'], 500);
            }
        } else {
            return response()->json(['status' => 404, 'message' => 'Category not found.'], 404);
        }
    }
}
