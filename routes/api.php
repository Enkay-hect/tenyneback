<?php

use App\Http\Controllers\caseStudiesController;
use App\Http\Controllers\CustomPlanController;
use App\Http\Controllers\faqController;
use App\Http\Controllers\generalContentController;
use App\Http\Controllers\InstructorsController;
use App\Http\Controllers\jobRolesCategoryController;
use App\Http\Controllers\JobsRoleController;
use App\Http\Controllers\planFeaturesController;
use App\Http\Controllers\plansController;
use App\Http\Controllers\ProgramCategoriesController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\TalentPipelineController;
use App\Http\Controllers\TestimonialController;
use App\Models\Programs;
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
Route::post('/addplanfeature/{id}', [plansController::class, 'addPlanFeature'])->name('addPlanFeature');
Route::get('/getplan', [plansController::class, 'getplan'])->name('getplan');
Route::post('/updateplan/{id}', [plansController::class, 'updateplan'])->name('updateplan');
Route::delete('/deleteplan/{id}', [plansController::class, 'deleteplan'])->name('deleteplan');
Route::post('/createPlanDescription', [planFeaturesController::class, 'createPlanDescription'])->name('createPlanDescription');
Route::get('/getPlanFeatureDescription', [planFeaturesController::class, 'getPlanFeatureDescription'])->name('getPlanFeatureDescription');



Route::post('/createcasestudy', [caseStudiesController::class, 'createCaseStudy'])->name('createCaseStudy');
Route::get('/getcasestudy', [caseStudiesController::class, 'getcasestudy'])->name('getcasestudy');
Route::post('/updatecasestudy/{id}', [caseStudiesController::class, 'updatecasestudy'])->name('updatecasestudy');
Route::delete('/deletecasestudy/{id}', [caseStudiesController::class, 'deletecasestudy'])->name('deletecasestudy');



Route::post('/creategeneralcontent', [generalContentController::class, 'createGeneralContent'])->name('createGeneralContent');
Route::get('/getcontent', [generalContentController::class, 'getcontent'])->name('getcontent');
Route::post('/updatecontent/{id}', [generalContentController::class, 'updatecontent'])->name('updatecontent');
Route::delete('/deletecontent/{id}', [generalContentController::class, 'deletecontent'])->name('deletecontent');


Route::post('/createjobcategory', [jobRolesCategoryController::class, 'createJobCategory'])->name('createJobCategory');
Route::post('/updatejobcategory/{id}', [jobRolesCategoryController::class, 'updatejobcategory'])->name('updatejobcategory');
Route::delete('/deletejobcategory/{id}', [jobRolesCategoryController::class, 'deletejobcategory'])->name('deletejobcategory');
Route::get('/getjobcategory', [jobRolesCategoryController::class, 'getjobcategory'])->name('getjobcategory');


Route::post('/createjobrole', [JobsRoleController::class, 'createjobrole'])->name('createjobrole');
Route::get('/getjobrole', [JobsRoleController::class, 'getjobrole'])->name('getjobrole');
Route::post('/updatejobrole/{id}', [JobsRoleController::class, 'updatejobrole'])->name('updatejobrole');
Route::delete('/deletejobrole/{id}', [JobsRoleController::class, 'deletejobrole'])->name('deletejobrole');


Route::post('/createprogramcategory', [ProgramCategoriesController::class, 'createprogramcategory'])->name('createprogramcategory');
Route::post('/createprogram', [ProgramsController::class, 'createprogram'])->name('createprogram');
Route::get('/getprogram', [ProgramCategoriesController::class, 'getprogram'])->name('getprogram');
Route::delete('/deleteprogram/{id}', [ProgramsController::class, 'deleteprogram'])->name('deleteprogram');
Route::get('/getprogramcategory', [ProgramCategoriesController::class, 'getprogramcategory'])->name('getprogramcategory');
Route::post('/updateprogramcategory/{id}', [ProgramCategoriesController::class, 'updateprogramcategory'])->name('updateprogramcategory');
Route::post('/updateprogram/{id}', [ProgramsController::class, 'updateprogram'])->name('updateprogram');
Route::delete('/deleteprogramcategory/{id}', [ProgramCategoriesController::class, 'deleteprogramcategory'])->name('deleteprogramcategory');


Route::post('/createinstructor', [InstructorsController::class, 'createinstructor'])->name('createinstructor');
Route::get('/getinstructor', [InstructorsController::class, 'getinstructor'])->name('getinstructor');
Route::post('/updateinstructor/{id}', [InstructorsController::class, 'updateinstructor'])->name('updateinstructor');
Route::delete('/deleteinstructor/{id}', [InstructorsController::class, 'deleteinstructor'])->name('deleteinstructor');


Route::post('/createtestimonial', [TestimonialController::class,'createtestimonial'])->name('createtestimonial');
Route::get('gettestimonial', [TestimonialController::class,  'gettestimonial'])->name('gettestimonial');
Route::post('updatetestimonial/{id}', [TestimonialController::class,  'updatetestimonial'])->name('updatetestimonial');
Route::delete('/deletetestimonial/{id}', [TestimonialController::class, 'deletetestimonial'])->name('deletetestimonial');


Route::post('/createpipeline', [TalentPipelineController::class,'createpipeline'])->name('createpipeline');
Route::get('/gettalentpipeline', [TalentPipelineController::class, 'gettalentpipeline'])->name('gettalentpipeline');
Route::post('updatetalentpipeline/{id}', [TalentPipelineController::class,  'updatetalentpipeline'])->name('updatetalentpipeline');
Route::delete('/deletetalentpipeline/{id}', [TalentPipelineController::class, 'deletetalentpipeline'])->name('deletetalentpipeline');


Route::post('/createcustomplan', [CustomPlanController::class,'createcustomplan'])->name('createcustomplan');
Route::get('/getcustomplan', [CustomPlanController::class, 'getcustomplan'])->name('getcustomplan');
Route::post('updatecustomplan/{id}', [CustomPlanController::class,  'updatecustomplan'])->name('updatecustomplan');
Route::delete('/deletecustomplan/{id}', [CustomPlanController::class, 'deletecustomplan'])->name('deletecustomplan');


Route::post('/createfaq', [faqController::class, 'createfaq'])->name('createfaq');
Route::post('/getfaq', [faqController::class, 'getfaq'])->name('getfaq');
Route::post('/updatefaq/{id}', [faqController::class, 'updatefaq'])->name('updatefaq');
Route::post('/deletefaq/{id}', [faqController::class, 'deletefaq'])->name('deletefaq');


