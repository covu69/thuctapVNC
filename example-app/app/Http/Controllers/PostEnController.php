<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use PhpParser\Node\Expr\New_;
use Illuminate\Support\Facades\DB;

class PostEnController extends Controller
{
  public function index_en($id)
  {
    // Kiểm tra xem bài viết có tồn tại không
    $use = DB::table('posts')->where('id', $id)->first();

    if (!$use) {
      // Bài viết không tồn tại
      abort(404);
    }

    // Kiểm tra xem bài viết tiếng Anh đã tồn tại không
    $idExists = DB::table('post_en')
      ->join('posts', 'post_en.posts_id', '=', 'posts.id')
      ->where('post_en.posts_id', $id)
      ->exists();

    if ($idExists) {
      // Nếu ID đã tồn tại, thực hiện reload trang hoặc xử lý theo ý muốn của bạn.
      return redirect()->back();
    }

    // Kiểm tra quyền truy cập
    if ($use->user_id != Auth::id()) {
      return back()->with('message', 'Bạn chỉ được thêm bài viết của chính mình');
    } else {
      // Nếu mọi thứ đều hợp lệ, tiếp tục hiển thị trang.
      return view('admin.posts_en.addposten', compact('id'));
    }
  }



  public function add_en(Request $request)
  {
    $validatedData = $request->validate([
      'title' => 'required',
      'content' => 'required|max:500',
      'thumbnail' => 'required|image|mimes:jpeg,png,gif|max:5120',
      'public_at' => 'required|date',
    ]);

    $input = $request->all();

    // Xử lý upload thumbnail
    if ($request->hasFile('thumbnail')) {
      $file = $request->file('thumbnail');
      $ext = $file->getClientOriginalExtension();
      $filename = time() . '.' . $ext;
      $file->move('upload/post/', $filename);
    } else {
      return redirect()->back()->with('error', 'Không có tệp hình ảnh được chọn.');
    }
    DB::table('post_en')->insert([
      'posts_id' => $input['posts_id'],
      'title' => $input['title'],
      'public_at' => $input['public_at'],
      'content' => $input['content'],
      'thumbnail' => $filename,
      'created_at' => now()
    ]);
    return redirect()->back()->with('success', 'Bài viết đã được thêm thành công.');
  }
  public function edit_posten($id)
  {

    $data = DB::table('post_en')
      ->select('*')
      ->where('posts_id', $id)
      ->first();
    if (!$data) {
      return redirect()->back();
    }
    return view('admin.posts_en.editposten', compact('data'));
  }

  public function save_en(Request $request, $id)
  {
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
    $public_at = $request->input('public_at');
    $public_at = $public_at ? date('Y-m-d H:i:s', strtotime($public_at)) : null;
    DB::table('post_en')
      ->where('post_en.posts_id', $id)->update([
        'title' => $request->input('title'),
        'content' => $request->input('content'),
        'thumbnail'=>$filename,
        'public_at' => $public_at,
        'updated_at' => now()
      ]);
    return redirect()->back()->with('success', 'Bạn đã cập nhật thành công!');
  }

  public function show_en(Request $request, int $id)
  {
    $data = DB::table('post_en')
      ->join('posts', 'post_en.posts_id', '=', 'posts.id')
      ->select('post_en.*', 'posts.thumbnail')
      ->where('posts.id', $id)
      ->first();

    if ($data) {
      // Nếu có dữ liệu, trả về view với dữ liệu bài viết
      return view('admin.posts_en.showen', [
        'post' => $data
      ]);
    } else {
      // Nếu không có dữ liệu, trả về một phản hồi không có dữ liệu
      return response()->json(['error' => 'No data found.'], 404);
    }
  }
}
