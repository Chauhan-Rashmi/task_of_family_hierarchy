<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// routes for display parent and child form
Route::get('/parentform',[FamilyController::class, 'view_parent_form']);
Route::get('/childform',[FamilyController::class, 'view_child_form']);

// routes for store parents and childs value in database
Route::post('create-parent',[FamilyController::class,'createparent'])->name('parent.create');
Route::post('create-child',[FamilyController::class,'createchild'])->name('child.create');

// routes for display parents record[parentdisplaydatatable]
Route::get('parents-record',[FamilyController::class,'parents_display_data']);
Route::get('parents-list',[FamilyController::class,'getdata_for_parent_display'])->name('parents.list');

// routes for display child record[childdisplaydatatable]
Route::get('child-record',[FamilyController::class,'childs_display_data']);
Route::get('child-list',[FamilyController::class,'getdata_for_child_display'])->name('childrens.list');

// route for edit parents record
Route::get('edit-parent/{id}', [FamilyController::class, 'edit_parent'])->name('edit.parent'); 
Route::post('/edit-parent',[FamilyController::class,'update_parent'])->name('update.parent');

// route for delete parents record
Route::get('/deleteparent/{id}',[FamilyController::class,'deleteparent'])->name('delete.parent');

// route for edit child record
Route::get('edit-child/{id}', [FamilyController::class, 'edit_child'])->name('edit.child'); 
Route::post('/edit-child',[FamilyController::class,'update_child'])->name('update.child');

// route for delete child record
Route::get('/deletechild/{id}',[FamilyController::class,'deletechild'])->name('delete.child');

// route for get mother name
Route::get('/getmothername/{id}',[FamilyController::class,'get_mother_name'])->name('get.mothername');

// route for add child record
Route::post('addchild',[FamilyController::class,'add_child'])->name('add.child');

// route for add parent record
Route::post('addparent',[FamilyController::class,'add_parent'])->name('add.parent');

// route for render treeview
// Route::get('treeviewlist',[FamilyController::class,'family_list']);
Route::get('treeview-record',[FamilyController::class,'family_list']);
Route::get('treeviewlist',[FamilyController::class,'getdata_for_family_display'])->name('family.list');
Route::get('child-detail/{id}', [FamilyController::class, 'display_child_list'])->name('parentchild.list'); 