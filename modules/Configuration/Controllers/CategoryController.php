<?php

namespace Modules\Configuration\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Configuration\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    protected $categories;
    protected $destinationPath;

    public function __construct(CategoryRepository $categories){
        $this->categories = $categories;
        $this->destinationPath = 'categories/';
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
       return view('Configuration::Category.index')
            ->withCategories($this->categories->all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Configuration::Category.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $data =$request->except(['attachment']);
        if($request->file('attachment')){
            $data['image_path'] = $request->file('attachment')
                                    ->storeAs($this->destinationPath,time().'.'.$request->file('attachment')
                                    ->getClientOriginalExtension());
        }
        $category = $this->categories->create($data);
        if($category){
            return redirect()->route('category.index')->withSuccessMessage('Category added successfully!!');
        }
        return redirect()->route('category.index')->withErrorMessage('OOPS, Category cannot be added!!');
    }

    /**
     * Display the specified resource.
     */

     /**
     * @OA\Get(
     *     path="/api/fiscalyears/{fiscalyear}",
     *     tags={"Fiscal Year"},
     *     summary="Get a fiscal year by id",
     *     description="This can only be done by the logged in user.",
     *     operationId="showFiscalYear",
     *     @OA\Parameter(
     *         name="fiscalyear",
     *         in="path",
     *         description="Fiscal year id to view",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(response=400,description="Invalid ID supplied"),
     *     @OA\Response(response=404,description="Fiscal year not found"),
     *     @OA\Response(response=200,description="Fiscal year found"),
     *     security={{"bearer_token":{}}}
     * )
     */
    public function show($id)
    {
        $data = $this->fiscalYears->find($id);
       if($data){
        return Response(['status'=>200,'data'=>$data,'message'=>'Fiscal year found successfully.'],200);
       }else{
        return Response(['status'=>404,'message'=>'Fiscal year not found.'],200);
       }   
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

     /**
     * @OA\Put(
     *     path="/api/fiscalyears/{fiscalyear}",
     *     tags={"Fiscal Year"},
     *     summary="Update fiscal year",
     *     description="This can only be done by the logged in user.",
     *     operationId="updateFiscalYear",
     *     @OA\Parameter(
     *         name="fiscalyear",
     *         in="path",
     *         description="Fiscal year id to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(response=200,description="Fiscal year updated"),
     *     @OA\RequestBody(
     *         description="Create fiscal year object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/FiscalYear")
     *     ),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function update(FiscalYearRequest $request, $id)
    {
        $fiscalyear = $this->fiscalYears->update($id,$request->all());
        if($fiscalyear){
            return Response(['status'=>200,'message'=>'Fiscal year updated successfully.'],200);
        }else{
            return Response(['status'=>500,'message'=>'Failed to update fiscal year.'],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

     /**
     * @OA\Delete(
     *     path="/api/fiscalyears/{fiscalyear}",
     *     tags={"Fiscal Year"},
     *     summary="Deletes a fiscal year",
     *     description="This can only be done by the logged in user.",
     *     operationId="deleteFiscalYear",
     *     @OA\Parameter(
     *         name="fiscalyear",
     *         in="path",
     *         description="Fiscal year id to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(response=400,description="Invalid ID supplied"),
     *     @OA\Response(response=404,description="Fiscal year not found"),
     *     @OA\Response(response=200,description="Fiscal year successfully deleted"),
     *     security={{"bearer_token":{}}}
     * )
     */
    public function destroy($id)
    {
        $flag = $this->fiscalYears->destroy($id);
        if($flag){
            return Response(['status'=>200,'message'=>'Fiscal year successfully deleted.'],200);
        }else{
            return Response(['status'=>500,'message'=>'Failed to delete fiscal year.'],200);
        }
    }
}
