<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class infoController extends Controller
{
    public function index(Request $request)
    {
        $itemsPerPage = $request->input('itemsPerPage', 5);
        $info = DB::table('info')->select('*')->whereNull('deleted_at')->paginate($itemsPerPage);
        return view('admin.info.listinfo', compact('info', 'itemsPerPage'));
    }

    public function add_info()
    {
        return view('admin.info.addinfo');
    }

    public function save_info(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'type' => 'required|unique:info',
            'content' => 'required',
        ]);
        $input = $request->all();

        DB::table('info')->insert([
            'title' => $input['title'],
            'type' => $input['type'],
            'content' => $input['content'],
        ]);

        return redirect()->route('info');
    }

    public function show_info($id)
    {
        $in = DB::table('info')->where('id', $id)->first();
        return view('admin.info.show', compact('in'));
    }

    public function edit_info($id)
    {
        $in = DB::table('info')->where('id', $id)->first();
        return view('admin.info.edit', compact('in'));
    }

    public function update_info(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'type' => 'required|unique:info,type,' . $id,
            'content' => 'required',
        ]);
        $a = DB::table('info')->where('id', $id)->update([
            'title' => $request['title'],
            'type' => $request['type'],
            'content' => $request['content'],
            'updated_at' => now()
        ]);
        if ($a) {
            return redirect()->route('info')->with('succes', 'Cập nhật thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật không thành công');
        }
    }

    public function destroy_info($id){
        $a = DB::table('info')->where('id',$id)->update([
            'deleted_at'=>now()
        ]);

        if($a){
            return redirect()->route('info');
        }else{
            return redirect()->back();
        }
    }
}
