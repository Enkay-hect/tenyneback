<?php

use App\Http\Controllers\caseStudiesController;
use App\Http\Controllers\generalContentController;
use App\Http\Controllers\InstructorsController;
use App\Http\Controllers\jobRolesCategoryController;
use App\Http\Controllers\jobRoleController;
use App\Http\Controllers\JobsRoleController;
use App\Http\Controllers\plansController;
use App\Http\Controllers\ProgramCategoriesController;
use App\Http\Controllers\ProgramsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/createplan', [plansController::class, 'createPlan'])->name('createPlan');
Route::post('/addplanfeature', [plansController::class, 'addPlanFeature'])->name('addPlanFeature');
Route::get('/getplan', [plansController::class, 'getplan'])->name('getplan');


Route::post('/createcasestudy', [caseStudiesController::class, 'createCaseStudy'])->name('createCaseStudy');
Route::get('/getcasestudy', [caseStudiesController::class, 'getcasestudy'])->name('getcasestudy');


Route::post('/creategeneralcontent', [generalContentController::class, 'createGeneralContent'])->name('createGeneralContent');
Route::get('/getcontent', [generalContentController::class, 'getcontent'])->name('getcontent');


Route::post('/createjobcategory', [jobRolesCategoryController::class, 'createJobCategory'])->name('createJobCategory');
Route::post('/createjobrole', [JobsRoleController::class, 'createjobrole'])->name('createjobrole');
Route::get('/getjobrole', [JobsRoleController::class, 'getjobrole'])->name('getjobrole');
Route::delete('/deletejobrole/{id}', [JobsRoleController::class, 'deletejobrole'])->name('deletejobrole');


Route::post('/createprogramcategory', [ProgramCategoriesController::class, 'createprogramcategory'])->name('createprogramcategory');


Route::post('/createprogram', [ProgramsController::class, 'createprogram'])->name('createprogram');
Route::get('/getprogram', [ProgramCategoriesController::class, 'getprogram'])->name('getprogram');


Route::post('/createinstructor', [InstructorsController::class, 'createinstructor'])->name('createinstructor');





