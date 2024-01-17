<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Registration;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use PHPUnit\Framework\Attributes\PostCondition;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PostEnController;
use App\Http\Controllers\infoController;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\Exponential;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ClientController::class, 'cl_home'])->name('home')->middleware('Language');

// Route::group(['middleware'=>'auth'], function(){
//     Route::get('/', function () {
//         return view('admin.homepage');
//     });

//     Route::get('/admin', function () {
//         return view('admin.dashboard');
//     });
// });

Route::prefix('admin')->middleware(['auth', 'checkRole','checkPasswordReset','Language'])->group(function () {
    // User
    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::get('useradd', [UserController::class, 'useradd'])->name('useradd');
    Route::post('add', [UserController::class, 'add'])->name('add');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::put('edit/{id}', [UserController::class, 'update'])->name('update');
    Route::get('destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
    Route::get('search', [UserController::class, 'search'])->name('search_user');
    Route::delete('deleteSelectd', [UserController::class, 'deleteSelectd'])->name('deleteSelectd');
    // post
    Route::get('post', [PostController::class, 'index'])->name('post');
    Route::get('post_user', [PostController::class, 'post_user'])->name('post_user');
    Route::get('search_post', [PostController::class, 'search_post'])->name('search_post');
    Route::get('show_tt/{id}', [PostController::class, 'show_tt'])->name('show_tt');
    Route::get('addpost', [PostController::class, 'addpost'])->name('add_post');
    Route::post('save_addpost', [PostController::class, 'save_addpost'])->name('save_addpost');
    Route::get('edit_post/{id}', [PostController::class, 'edit_post'])->name('edit_post');
    Route::put('edit_post/{id}', [PostController::class, 'update_post'])->name('update_post');
    Route::post('ck_upload', [PostController::class, 'ck_upload'])->name('ck_upload');
    Route::get('destroy_post/{id}', [PostController::class, 'destroy_post'])->name('destroy_post');
    Route::delete('deleteSelectd_post', [PostController::class, 'deleteSelectd_post'])->name('deleteSelectd_post');
    Route::get('pheduyet/{id}', [PostController::class, 'pheduyet'])->name('pheduyet');
    Route::get('xoa/{id}', [PostController::class, 'xoa'])->name('xoa');
    // post en
    Route::get('index_en/{id}', [PostEnController::class, 'index_en'])->name('index_en');
    Route::post('add_en', [PostEnController::class, 'add_en'])->name('add_en');
    Route::get('edit_posten/{id}', [PostEnController::class, 'edit_posten'])->name('edit_posten');
    Route::put('save_en/{id}', [PostEnController::class, 'save_en'])->name('save_en');
    Route::get('show_en/{id}', [PostEnController::class, 'show_en'])->name('show_en');
    //end

    //info
    Route::get('index', [infoController::class, 'index'])->name('info');
    Route::get('add_info', [infoController::class, 'add_info'])->name('add_info');
    Route::post('save_info', [infoController::class, 'save_info'])->name('save_info');
    Route::get('show_info/{id}', [infoController::class, 'show_info'])->name('show_info');
    Route::get('edit_info/{id}', [infoController::class, 'edit_info'])->name('edit_info');
    Route::put('update_info/{id}', [infoController::class, 'update_info'])->name('update_info');
    Route::get('destroy_info/{id}', [infoController::class, 'destroy_info'])->name('destroy_info');
    //end
    //excel

    Route::post('exportDataToExcel', [ExportController::class, 'exportDataToExcel'])->name('exportDataToExcel');
    Route::post('export_checkbox', [ExportController::class, 'export_checkbox'])->name('export_checkbox');
    Route::post('/importExcel', [ExportController::class, 'importExcel'])->name('import-excel');

    // contact
    Route::get('contact',[ClientController::class,'contact'])->name('contact');
    Route::get('lh_search', [ClientController::class, 'lh_search'])->name('lh_search');
    Route::get('show_contact/{id}', [ClientController::class, 'show_contact'])->name('show_contact');
    Route::get('xoa_contact/{id}', [ClientController::class, 'xoa_contact'])->name('xoa_contact');
    Route::delete('deleteSelectd_contact', [ClientController::class, 'deleteSelectd_contact'])->name('deleteSelectd_contact');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
// lấy lại mật khẩu 
Route::get('forgetPassword', [LoginController::class, 'forgetPassword'])->name('forgetPassword');
//theo link token
Route::post('guimk', [LoginController::class, 'guimk'])->name('guimk');
Route::get('resetPassword/{token}', [LoginController::class, 'resetPassword'])->name('resetPassword');
Route::post('resetPassword', [LoginController::class, 'reset_Password'])->name('reset_Password');
// end token
//theo mật khẩu rand
Route::post('mk_rand', [LoginController::class, 'mk_rand'])->name('mk_rand');
//end rand
//end lấy lại mật khẩu
Route::get('create', [RegistrationController::class, 'index'])->name('create');
Route::post('check', [LoginController::class, 'check'])->name('check');
Route::post('register', [RegistrationController::class, 'insert'])->name('register');
//
Route::get('dashboard', [LoginController::class, 'dashboard'])->name('dashboard')->middleware('checkPasswordReset','Language');
Route::get('profile', [LoginController::class, 'profile'])->name('profile');
Route::get('showChangePasswordForm',[LoginController::class,'showChangePasswordForm'])->name('showChangePasswordForm');
Route::post('changePassword',[LoginController::class,'changePassword'])->name('changePassword');
Route::get('calendar',[ClientController::class,'calendar'])->name('calendar')->middleware('Language');
Route::get('showPostsByDate/{date}',[ClientController::class,'showPostsByDate'])->middleware('Language');

//nguoi dung
Route::prefix('user')->middleware(['Language'])->group(function () {
    Route::get('changeLanguage/{locale}', [ClientController::class,'changeLanguage'])->name('changeLanguage');
    Route::get('cl_addpost', [ClientController::class, 'cl_addpost'])->name('cl_addpost');
    Route::post('cl_save_addpost', [ClientController::class, 'cl_save_addpost'])->name('cl_save_addpost');
    Route::get('list_post', [ClientController::class, 'list_post'])->name('list_post');
    Route::get('search_post_cl', [ClientController::class, 'search_post_cl'])->name('search_post_cl');
    Route::get('cl_edit_post/{id}', [ClientController::class, 'cl_edit_post'])->name('cl_edit_post');
    Route::put('cl_edit_post/{id}', [ClientController::class, 'cl_uppdate_post'])->name('cl_uppdate_post');
    Route::get('cl_show_tt/{id}', [ClientController::class, 'cl_show_tt'])->name('cl_show_tt');
    Route::get('cl_destroy_post/{id}', [ClientController::class, 'cl_destroy_post'])->name('cl_destroy_post');
    Route::delete('cl_deleteSelectd_post', [ClientController::class, 'cl_deleteSelectd_post'])->name('cl_deleteSelectd_post');
    Route::get('chitiet/{id}', [ClientController::class, 'chitiet'])->name('chitiet');
    Route::get('all_post', [ClientController::class, 'all_post'])->name('all_post');
    Route::get('timkiem', [ClientController::class, 'timkiem'])->name('timkiem');
    Route::get('lienhe', [ClientController::class, 'lienhe'])->name('lienhe');
    Route::post('add_contact', [ClientController::class, 'add_contact'])->name('add_contact');
    Route::get('pages/{id}', [ClientController::class, 'pages'])->name('pages');
});
