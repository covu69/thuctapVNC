<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use PhpParser\Node\Expr\New_;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{

  // public function index()
  //     {
  //         return Auth::check() ? view('admin.homepage') : view('admin.login');
  //     }

  protected $pages;
    public function __construct()
    {
        $this->pages= DB::table('info')->select('*')->whereNull('deleted_at')->get();
        view()->share([
            'pages'=>$this->pages,
        ]);
    }

  public function cl_home()
  {
    $current_datetime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');

    $posts = DB::table('posts')
      ->select('*')
      ->whereDate('public_at', '<=', $current_datetime)
      ->whereNull('deleted_at')
      ->where('status','1')
      ->orderBy('public_at', 'desc')->get();
    $sl = DB::table('posts')
      ->select('*')
      ->whereDate('public_at', '<=', $current_datetime)
      ->whereNull('deleted_at')
      ->orderBy('public_at', 'desc')->first();
    if (Session::get('locale') == 'vi') {
      $latestPosts = DB::table('posts')
        ->select('*')
        ->whereDate('public_at', '<=', $current_datetime)
        ->whereNull('deleted_at')
        ->orderBy('public_at', 'desc')
        ->limit(4)
        ->get();
    } else {
      $latestPosts = DB::table('posts')
        ->join('post_en', 'posts.id', '=', 'post_en.posts_id')
        ->select('post_en.*', 'posts.id as id','posts.status')
        ->whereNull('post_en.deleted_at')
        ->limit(4)
        ->get();
    }
    return view('client.cl_home', compact('posts', 'latestPosts', 'sl'));
  }

  public function timkiem(Request $request)
  {
      $data = $request->input('search');
      
      $query = DB::table('posts')->whereNull('posts.deleted_at');
  
      if (Session::get('locale') != 'vi') {
          $query->join('post_en', 'posts.id', '=', 'post_en.posts_id')
              ->select('post_en.*', 'posts.id as id')
              ->whereNull('post_en.deleted_at')
              ->where(function ($subquery) use ($data) {
                  $subquery->where('post_en.title', 'like', '%' . $data . '%')
                      ->orWhere('post_en.content', 'like', '%' . $data . '%');
              });
      } else {
          $query->where(function ($subquery) use ($data) {
              $subquery->where('title', 'like', '%' . $data . '%')
                  ->orWhere('content', 'like', '%' . $data . '%');
          });
      }
  
      $posts = $query->paginate(10);
  
      return view('client.posts.timkiem', compact('posts', 'data'))->with('i', ($request->input('page', 1) - 1) * 10);
  }
  
  // quản lý bài viết
  public function list_post(Request $request)
  {
    $userId = auth()->id();
    $itemsPerPage = $request->input('itemsPerPage', 5);
    //danh sachh
    $posts = DB::table('posts')
      ->join('users', 'posts.user_id', '=', 'users.id')
      ->select('posts.*', 'users.role')
      ->where('users.role', 0)
      ->where('users.id', $userId)
      ->paginate($itemsPerPage);
    // $posts = DB::table('posts')->select('*')->where('deleted_at',null)->paginate($itemsPerPage);

    return view('client.posts.cl_listpost', compact('posts', 'itemsPerPage'))->with('i', (request()->input('page', 1) - 1) * 5);
  }
  public function search_post_cl(Request $request)
  {
    $data = $request->input('search');
    $userId = auth()->id();
    $itemsPerPage = $request->input('itemsPerPage', 5);
    $posts = DB::table('posts')
      ->join('users', 'posts.user_id', '=', 'users.id')
      ->select('posts.*', 'users.role')
      ->whereNull('posts.deleted_at')
      ->where('users.role', 0)
      ->where('users.id', $userId)
      ->where(function ($query) use ($data) {
        $query->where('title', 'like', '%' . $data . '%')
          ->orwhere('content', 'like', '%' . $data . '%');
      })
      ->paginate($itemsPerPage);
    return view('client.posts.cl_listpost', compact('posts', 'data', 'itemsPerPage'))->with('i', (request()->input('page', 1) - 1) * 5);
  }
  public function cl_addpost()
  {
    return view('client.posts.cl_addpost');
  }
  public function cl_save_addpost(Request $request)
  {
    $validatedData = $request->validate([
      'title' => 'required',
      'content' => 'required|max:500',
      'thumbnail' => 'required|image|mimes:jpeg,png,gif|max:5120'
    ]);
    $input = $request->all();
    if ($request->hasFile('thumbnail')) {
      $file = $request->file('thumbnail');
      $ext = $file->getClientOriginalExtension();
      $filename = time() . '.' . $ext;
      $file->move('upload/post/', $filename);
    }

    DB::table('posts')->insert([
      'user_id' => $input['user_id'],
      'title' => $input['title'],
      'public_at' => $input['public_at'],
      'content' => $input['content'],
      'thumbnail' => $filename,
      'created_at' => now()
    ]);
    return redirect()->route('list_post');
  }

  public function cl_edit_post(Request $request, $id)
  {
    $a = DB::table('posts')->where('id', $id)->first();
    if ($a == null) {
      return abort(404);
    }
      $data_vi = DB::table('posts')->where('posts.id', $id)->first();

      $data_en = DB::table('post_en')
        ->join('posts', 'post_en.posts_id', '=', 'posts.id')
        ->select('post_en.*', 'posts.id as id', 'posts.status')
        ->where('post_en.posts_id', $id)
        ->whereNull('posts.deleted_at')
        ->first();

    if ($a->user_id != Auth::id()) {
      return back()->with('Bạn chỉ sửa bài viết của chính mình');
    } else {
      return view('client.posts.cl_editpost', ['post_vi' => $data_vi,'post_en'=>$data_en,'id'=>$id]);
    }
  }

 

  public function cl_show_tt(Request $request, $id)
  {

    $user = DB::table('posts')->where('id', $id)->first();
      $data_vi = DB::table('posts')->where('posts.id', $id)->first();
      $data_en = DB::table('post_en')
        ->join('posts', 'post_en.posts_id', '=', 'posts.id')
        ->select('post_en.*', 'posts.id as id', 'posts.status')
        ->where('post_en.posts_id', $id)
        ->whereNull('posts.deleted_at')
        ->first();
    if ($user == null) {
      return abort(404);
    }
    if ($user->user_id == Auth::id()) {
      return view('client.posts.cl_shows', [
        'post_vi' => $data_vi,
        'post_en'=>$data_en
      ]);
    } else {
      return back()->with('Bạn chỉ xem bài viết của chính mình');
    }
  }
  
  public function cl_destroy_post($id)
  {
    $data = DB::table('posts')->where('id', $id)->first();
    if ($data == null) {
      return abort(404);
    }
    if ($data->user_id == Auth::id()) {
      // Sử dụng Query Builder để cập nhật dữ liệu trong cơ sở dữ liệu
      $result = DB::table('users')
        ->where('id', $id)
        ->update([
          'deleted_at' => now(),
        ]);
    } else {
      return back()->with('Bạn chỉ xóa bài viết của chính mình');
    }

    if ($result) {
      return redirect()->route('list_post')->with('success', 'Bài viết đã được xóa thành công.');
    }

    return redirect()->route('list_post')->with('error', 'Không thể tìm thấy bài viết để xóa.');
  }

  public function cl_deleteSelectd_post(Request $request)
  {
    $ids = $request->ids;

    if (is_array($ids)) {
      // Biến $ids là mảng
      DB::table('posts')->whereIn('id', $ids)->update([
        'deleted_at' => now(),
      ]);
      return redirect()->route('list_post');
    } else {
      // Biến $ids không phải là mảng, xử lý lỗi hoặc tình huống đó theo cách tương ứng
      return redirect()->back()->with('error', 'Biến không phải là mảng.');
    }
  }

  public function chitiet(Request $request, $id)
  {
    $locale = Session::get('locale');

    if ($locale == 'vi') {
      $data = DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.*', 'users.name')
        ->where('posts.id', $id)
        ->first();
    } else {
      $data = DB::table('posts')
        ->join('post_en', 'posts.id', '=', 'post_en.posts_id')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('post_en.*', 'posts.status', 'users.name')
        ->where('post_en.posts_id', $id)
        ->first();
    }

    return view('client.posts.chitiet', [
      'ct_post' => $data
    ]);
  }



  public function all_post()
  {
    $current_datetime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
    if (Session::get('locale') == 'vi') {
      $data = DB::table('posts')->select('*')
        ->where('public_at', '<=', $current_datetime)
        ->where('status','1')
        ->whereNull('deleted_at')->paginate('6');
    } else {
      $data = DB::table('posts')
        ->join('post_en', 'posts.id', '=', 'post_en.posts_id')
        ->select('post_en.*', 'posts.id as id', 'posts.status')
        ->whereNull('posts.deleted_at')
        ->paginate(6);
    }
    return view('client.posts.allpost', [
      'posts' => $data
    ]);
  }
  // end

  // contact
  public function add_contact(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email',
      'phone' => 'required|integer',
      'title' => 'required|max:255',
      'content' => 'required|max:500',
      'g-recaptcha-response' => 'required|captcha'
    ]);

    DB::table('table_contact')->insert([
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'phone' => $request->input('phone'),
      'title' => $request->input('title'),
      'content' => $request->input('content'),
      'created_at' => now(),
      'status' => 0
    ]);

    return redirect()->route('home')->with('success', 'Cảm ơn bạn đã tương tác với chúng tôi');
  }
  public function lienhe(){
    return view('client.contact');
  }
  //quan ly
  public function contact(Request $request)
  {
    $itemsPerPage = $request->input('itemsPerPage', 5);
    $ct = DB::table('table_contact')->select('*')->paginate($itemsPerPage);
    return view('admin.contact.listcontact', compact('ct', 'itemsPerPage'))->with('i', (request()->input('page', 1) - 1) * 5);
  }

  public function lh_search(Request $request)
  {
    $data = $request->input('search');
    $itemsPerPage = $request->input('itemsPerPage', 5);
    $ct = DB::table('table_contact')
      ->where(function ($query) use ($data) {
        $query->where('name', 'like', '%' . $data . '%')
          ->orwhere('email', 'like', '%' . $data . '%')
          ->orWhere('title', 'like', '%' . $data . '%');
      })
      ->paginate($itemsPerPage);

    return view('admin.contact.listcontact', compact('ct', 'data', 'itemsPerPage'))->with('i', (request()->input('page', 1) - 1) * 5);
  }

  public function show_contact(Request $request, $id)
  {
    $contact = DB::table('table_contact')->where('id', $id)->first();
    DB::table('table_contact')->where('id', $id)->update(['status' => 1]);
    return view('admin.contact.showcontact', compact('contact'));
  }

  public function xoa_contact($id)
  {
    DB::table('table_contact')
      ->where('id', $id)
      ->delete();

    return redirect()->route('contact');
  }

  public function deleteSelectd_contact(Request $request)
  {
    $ids =  $request->ids;

    DB::table('table_contact')
      ->where('id', $ids)
      ->delete();
    return redirect()->route('contact');
  }
  // end
  // show calendar
  public function calendar()
  {
    $current_datetime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
    if (Session::get('locale') == 'vi') {
    $calendar = DB::table('posts')
      ->select(DB::raw('DATE(public_at) as start'), DB::raw('count(*) as title'))
      ->whereDate('public_at', '<=', $current_datetime)
      ->whereNull('deleted_at')
      ->where('status', 1)
      ->groupBy('start')
      ->pluck('title', 'start')->toArray();
    } else {
      $calendar = DB::table('post_en')
      ->select(DB::raw('DATE(public_at) as start'), DB::raw('count(*) as title'))
      ->whereDate('public_at', '<=', $current_datetime)
      ->whereNull('deleted_at')
      ->groupBy('start')
      ->pluck('title', 'start')->toArray();
    }
    return view('client.calendar.calendar', compact('calendar'));
  }
  public function showPostsByDate($date)
  {
    $current_datetime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
    // Kiểm tra định dạng ngày sử dụng Validator
    $validator = Validator::make(['date' => $date], [
      'date' => 'date_format:Y-m-d',
    ]);
    // Nếu định dạng không đúng, load lại trang
    if ($validator->fails()) {
      return back();
    }
    // Sử dụng hàm whereDate để lấy tất cả các bài viết trong một ngày cụ thể
    if (Session::get('locale') == 'vi') {
    $posts = DB::table('posts')
      ->whereDate('public_at', '<=', $current_datetime)
      ->whereDate('public_at', $date)
      ->where('status', 1)
      ->paginate(5);
    } else {
      $posts = DB::table('post_en')
      ->join('posts','post_en.posts_id','=','posts.id')
      ->select('post_en.*', 'posts.id as id')
      ->whereDate('post_en.public_at', '<=', $current_datetime)
      ->whereDate('post_en.public_at', $date)
      ->paginate(5);
    }
    return view('client.calendar.showpost', compact('date', 'posts'));
  }
  // end calenndar
  // thay đổi ngôn ngữ 
  public function changeLanguage($locale)
  {
    // Kiểm tra xem ngôn ngữ có hợp lệ không
    $validLocales = ['en', 'vi'];
    if (in_array($locale, $validLocales)) {
      // Lưu ngôn ngữ vào session
      Session::put('locale', $locale);
    }
    // dd($locale);
    return redirect()->back();
  }
  //end thay đổi ngôn ngữ

  public function pages($id){
    $page = DB::table('info')->where('id',$id)->first();
    return view('client.pages',compact('page'));
  }
}
