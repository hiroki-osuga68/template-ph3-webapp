<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// モデルの読み込み
use App\Model\LearningLanguage;

class AdminlanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        // 不正アクセスの防止
        // /homeじゃなくて管理者権限がない旨を示すのは未完了
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        $learning_languages = LearningLanguage::all();
        // viewの第2引数に変数を指定し、bladeで利用可能にする
        return view('admin/admin_language', compact('learning_languages'));
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
        LearningLanguage::create($form);
        return redirect()->route('admin_language.index');
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
        $learning_language = LearningLanguage::find($id);
        //検索結果をビューに渡す
        return view('/admin/edit_language', compact('learning_language'));
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
        $learning_language = LearningLanguage::find($id);
        //値を代入
        $learning_language->name = $request->name;
        $learning_language->color = $request->color;
        //保存（更新）
        $learning_language->save();
        //リダイレクト
        return redirect()->route('admin_language.index');
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
        $learning_language = LearningLanguage::find($id);
        //削除
        $learning_language->delete();
        //リダイレクト
        return redirect()->route('admin_language.index');
    }
}
