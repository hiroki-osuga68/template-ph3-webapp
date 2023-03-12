<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// モデルの読み込み
use App\Model\LearningContent;

class AdmincontentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // 不正アクセスの防止
        // ユーザーがログインしている場合、::HOMEにリダイレクトさせる。このロジックは、ルートが/logoutである場合は実行されない
        // /homeじゃなくて管理者権限がない旨を示すのは未完了
        $this->middleware('guest')->except('logout');
    }
    
    public function index()
    {
        $learning_contents = LearningContent::withTrashed()->get();
        // viewの第2引数に変数を指定し、bladeで利用可能にする
        return view('admin/admin_content', compact('learning_contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $request->all();
        unset($form['_token']);
        LearningContent::create($form);
        return redirect()->route('admin_content.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //レコードを検索
        $learning_content = LearningContent::find($id);
        //検索結果をビューに渡す
        return view('/admin/edit_content', compact('learning_content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //レコードを検索
        $learning_content = LearningContent::find($id);
        //値を代入
        $learning_content->name = $request->name;
        $learning_content->color = $request->color;
        //保存（更新）
        $learning_content->save();
        //リダイレクト
        return redirect()->route('admin_content.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //削除対象レコードを検索
        $learning_content = LearningContent::find($id);
        //削除
        $learning_content->delete();
        //リダイレクト
        return redirect()->route('admin_content.index');
    }

    public function restore($id)
    {
        //復元対象レコードを検索
        $learning_content = LearningContent::onlyTrashed()->find($id);
        // dd($learning_content);
        //復元
        $learning_content->restore();
        //リダイレクト
        return redirect()->route('admin_content.index');
    }
}
