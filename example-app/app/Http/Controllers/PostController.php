<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Http\Requests\postsRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use PhpParser\Node\Expr\New_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
  public function index(Request $request)
  {
    $userId = auth::id();
    $itemsPerPage = $request->input('itemsPerPage', 5);

    $posts = DB::table('posts')
      ->where('posts.user_id', $userId) // Lọc bài viết của người dùng hiện tại
      ->whereNull('posts.deleted_at')
      ->paginate($itemsPerPage);
    // dd($posts);

    $en = DB::table('post_en')
      ->join('posts', 'post_en.posts_id', '=', 'posts.id')
      ->get();

    return view('admin.post.listpost', compact('posts', 'itemsPerPage', 'en'))->with('i', (request()->input('page', 1) - 1) * 5);
  }
  // quản lý bài viết người dùng
  public  function post_user(Request $request)
  {
    $itemsPerPage = $request->input('itemsPerPage', 5);
    //danh sachh
    $posts = DB::table('posts')
      ->join('users', 'posts.user_id', '=', 'users.id')
      ->select('posts.*', 'users.role')
      ->where('users.role', 0)
      ->whereNull('posts.deleted_at')
      ->orderBy('created_at', 'desc')
      ->paginate($itemsPerPage);
    // $posts = DB::table('posts')->select('*')->where('deleted_at',null)->paginate($itemsPerPage);
    return view('admin.post.userlistpost', compact('posts', 'itemsPerPage'))->with('i', (request()->input('page', 1) - 1) * 5);
  }

  public function pheduyet(Request $request, int $id)
  {
    DB::table('posts')->where('id', $id)->update([
      'status' => 1
    ]);

    return redirect()->route('post_user');
  }

  public function xoa(Request $request, int $id)
  {
    DB::table('posts')->where('id', $id)->update([
      'deleted_at' => now()
    ]);

    return redirect()->route('post_user');
  }

  // end


  public function search_post(Request $request)
  {
    $data = $request->input('search');
    $itemsPerPage = $request->input('itemsPerPage', 5);
    $posts = DB::table('posts')->WhereNull('deleted_at')
      // ->where('name','like','%'. $data .'%')
      // ->orwhere('email','like','%'.$data.'%')
      ->where(function ($query) use ($data) {
        $query->where('title', 'like', '%' . $data . '%')
          ->orwhere('content', 'like', '%' . $data . '%');
      })
      //  ->toSql();
      // dd($users);
      ->paginate($itemsPerPage);
    if ($posts) {
      return view('admin.post.listpost', compact('posts', 'data', 'itemsPerPage'))->with('i', (request()->input('page', 1) - 1) * 5);
    } else {
      return abort('404');
    }
  }

  public function show_tt(Request $request, $id)
  {
    $uer = DB::table('posts')->where('id', $id)->first();

    if (!$uer) {
      abort(404); // Or any other appropriate action
    }
      $data_vi = DB::table('posts')->where('posts.id', $id)->first();
      $data_en = DB::table('post_en')
        ->join('posts', 'post_en.posts_id', '=', 'posts.id')
        ->select('post_en.*', 'posts.id as id')
        ->where('post_en.posts_id', $id)
        ->whereNull('posts.deleted_at')
        ->first();
    if ($uer->user_id != Auth::id()) {
      return back()->with('Bạn chỉ sửa bài viết của chính mình');
    } else {
      return view('admin.post.showpost', [
        'post_vi' => $data_vi,
        'post_en'=>$data_en
      ]);
    }
  }






  public function addpost()
  {
    // dd(config('app'));
    return view('admin.post.addpost');
  }

  public function save_addpost(Request $request)
  {
    $validatedData = $request->validate([
      'title' => 'required',
      'content' => 'required|max:500',
      'thumbnail' => 'required|image|mimes:jpeg,png,gif|max:5120',
      'public_at' => 'required|date',
    ]);

    $input = $request->all();
    $myCheckboxValue = $request->input('banner', 0);

    // Xử lý upload thumbnail
    if ($request->hasFile('thumbnail')) {
      $file = $request->file('thumbnail');
      $ext = $file->getClientOriginalExtension();
      $filename = time() . '.' . $ext;
      $file->move('upload/post/', $filename);
    } else {
      return redirect()->back()->with('error', 'Không có tệp hình ảnh được chọn.');
    }
    DB::table('posts')->insert([
      'user_id' => $input['user_id'],
      'title' => $input['title'],
      'public_at' => $input['public_at'],
      'content' => $input['content'],
      'thumbnail' => $filename,
      'banner' => $myCheckboxValue,
      'status' => '1',
      'created_at' => now()
    ]);
    return redirect()->route('post')->with('success', 'Bài viết đã được thêm thành công.');
  }


  public function edit_post(Request $request, $id)
  {

    $a = DB::table('posts')->where('id', $id)->first();
    if ($a == null) {
      return abort(404);
    }
    $data_vi = DB::table('posts')->where('posts.id', $id)->first();
    $data_en = DB::table('post_en')
      ->join('posts', 'post_en.posts_id', '=', 'posts.id')
      ->select('post_en.*', 'posts.id as id','post_en.thumbnail')
      ->where('post_en.posts_id', $id)
      ->whereNull('posts.deleted_at') 
      ->first();
    if ($a->user_id != Auth::id()) {
      return back()->with('Bạn chỉ sửa bài viết của chính mình');
    } else {
      return view('admin.post.editpost', ['post_vi' => $data_vi, 'post_en' => $data_en,'id'=>$id]);
    }
  }
  public function update_post(Request $request, $id)
  {
    // Kiểm tra xem có file thumbnail được tải lên không
    if ($request->hasFile('thumbnail')) {
      $validatedData = $request->validate([
        'title' => 'required',
        'content' => 'required|max:500',
        'thumbnail' => 'required|image|mimes:jpeg,png,gif|max:5120'
      ]);

      $file = $request->file('thumbnail');
      $ext = $file->getClientOriginalExtension();
      $filename = time() . '.' . $ext;
      $file->move('upload/post/', $filename);
    } else {
      // Nếu không có file mới, giữ nguyên tên file cũ
      $filename = DB::table('posts')->where('id', $id)->value('thumbnail');
    }
    // Kiểm tra xem có bản ghi với ID cung cấp không
    $post = DB::table('posts')->where('id', $id)->first();
    if ($post) {
      // Định dạng ngày tháng cho 'public_at'
      
      $public_at = $request->input('public_at');
      $public_at = $public_at ? date('Y-m-d H:i:s', strtotime($public_at)) : null;

      // Cập nhật bản ghi
      DB::table('posts')->where('id', $id)->update([
        'title' => $request->input('title'),
        'thumbnail' => $filename,
        'content' => $request->input('content'),
        'banner' => $request->input('banner') == 'on' ? 1 : 0,
        'public_at' => $public_at,
        'updated_at' => now()
      ]);
    }
    return redirect()->back()->with('success', 'Bạn đã cập nhật thành công!');
  }

  public function destroy_post($id)
  {
    // Sử dụng Query Builder để cập nhật dữ liệu trong cơ sở dữ liệu
    $result = DB::table('posts')
      ->join('post_en', 'posts.id', '=', 'post_en.posts_id')
      ->where('posts.id', $id)
      ->update([
        'posts.deleted_at' => now(),
        'post_en.deleted_at' => now()
      ]);

    if ($result) {
      return redirect()->route('post')->with('success', 'Tài khoản đã được xóa thành công.');
    }

    return redirect()->route('post')->with('error', 'Không thể tìm thấy tài khoản để xóa.');
  }

  public function deleteSelectd_post(Request $request)
  {
    $ids = $request->ids;

    if (is_array($ids)) {
      // Biến $ids là mảng
      DB::table('posts')->whereIn('id', $ids)->update([
        'deleted_at' => now(),
      ]);
      return redirect()->route('post');
    } else {
      // Biến $ids không phải là mảng, xử lý lỗi hoặc tình huống đó theo cách tương ứng
      return redirect()->back()->with('error', 'Biến không phải là mảng.');
    }
  }






  public function ck_upload(Request $request)
  {

    dd($request->all());


    if ($request->hasFile('upload')) {
      $originName = $request->flie('upload')->getClientOriginalName();
      $filename = pathinfo($originName, PATHINFO_FILENAME);
      $extension = $request->file('upload')->getClientOriginalExtension();
      $filename = $filename . '_' . time() . '.' . $extension;
      $request->file('upload')->move('upload/post/', $filename);
      $url = asset('upload/post/' . $filename);
      return response()->json(['filename' => $filename, 'upload' => 1, 'url' => $url]);
    }
  }
}
