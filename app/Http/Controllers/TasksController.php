<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    // getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        }

        // Welcomeビューでそれらを表示
        return view('tasks.index', $data);
    }
    public function create()
    {
        $task = new task;

        // タスク作成ビューを表示
        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    // postでtasks/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]); 
        
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);
        

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    // getでtasks/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            //user_id取得
        }   
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        
        if(\Auth::user()->id==$task->user_id){
            // タスク詳細ビューでそれを表示
            return view('tasks.show', [
                'task' => $task,
            ]);
        }
        else{
            return redirect('/');
        }
    }
    // getでtasks/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
        }   
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        
        if(\Auth::user()->id==$task->user_id){
            // タスク編集ビューでそれを表示
            return view('tasks.edit', [
                'task' => $task,
            ]);
        }
        else{
        return redirect('/');
        }
    }
    // putまたはpatchでtasks/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]);
        
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        // タスクを更新
        $task->status = $request->status;    // 追加        
        $task->content = $request->content;
        $task->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    // deleteでtasks/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        if (\Auth::id() === $task->user_id) {
        // タスクを削除
            $task->delete();
        }
        else{
            return redirect('/');
        }

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}
