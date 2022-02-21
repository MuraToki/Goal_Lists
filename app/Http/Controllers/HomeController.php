<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * 
     * 目標の一覧
     * @return view
     */
    public function index()
    {
        $todos = Todo::all();

        return view('home', ['todos' => $todos]);
    }

    /**
     * 登録画面を表示する
     * @return view
     */

    public function create() {
        return view('home');
    }

    /**
     * 登録する
     * @return view
     */

    public function store(TodoRequest $request)
    {
        $inputs = $request->all();
        // dd($inputs);

        \DB::beginTransaction();

        try {
            //code...
            Todo::create($inputs);
            \DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            \DB::rollback();
            abort(500);
        }

        \Session::flash('err_msg', '目標を登録しました。頑張れ！');
        return redirect()->route('home');
    }
    
    /**
     * 編集フォームを表示
     * @param int $id
     * @return view
     */
    public function edit($id)
    {
        $todo = Todo::find($id);

        if (is_null($todo)) {
            \Session::flash('err_msg', 'データがないよ');
            return redirect(route('home'));
        }

        return view('todo.edit', ['todo' => $todo]);
    }

     /**
     * 更新
     * @return view
     */

    public function update(TodoRequest $request) {
        //データを受け取る
        $inputs = $request->all();

        // dd($inputs);
        
        \DB::beginTransaction();

        try {
            //code...
            //更新！！
            $todo = Todo::find($inputs['id']);
            $todo->fill([
                'title' => $inputs['title']
            ]);
            $todo->save();
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            abort(500);
        }

        \Session::flash('err_msg', '目標を更新しました。頑張れ！');
        return redirect(route('home'));
    }

    /**
     * 削除機能
     * @param int $id
     * @return view
     */
    public function delete($id)
    {
        if (empty($id)) {
            \Session::flash('err_msg', 'データがないよ');
            return redirect(route('home'));
        }

        try {
            //code...
            //削除
            Todo::destroy($id);
        } catch (\Throwable $th) {
            abort(500);
        }

        \Session::flash('err_msg', '削除ができました。お疲れ様！');
        return redirect(route('home'));

    }
}
