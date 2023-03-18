<?php

namespace App\Http\Controllers;
// ファサード
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// モデル
use App\Model\LearningContent;
use App\Model\LearningLanguage;
use App\Model\ContentRecord;
use App\Model\LanguageRecord;
use App\Model\StudyHoursPost;
// クラス
use Carbon\Carbon;

class WebappController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ユーザーの取得
        $user = Auth::user();
        $user_id = $user->id;

        // 年月日の取得
        $today = Carbon::now()->format('Y-m-d');
        $date_start = Carbon::now()->startOfMonth();
        $date_end = Carbon::now()->endOfMonth();
        $this_month = Carbon::now()->format('Y年m月');
        // 棒グラフの末日指定
        $last_day = Carbon::now()->endOfMonth()->format('d');
        // 年の第何週か
        $dt = new Carbon();
        $week_of_year = $dt->weekOfYear;

        // → テーブル定義でstudy_hourテーブルを別途作って、postで先にstudy_hourのテーブルにデータ入れてから、言語・コンテンツのhourにデータを渡し、選択した言語・コンテンツの数だけ割り算する方向に切り替え
        // 合計
        $total_hour = StudyHoursPost::where('user_id', $user_id)->sum('total_hour');
        // 今日
        $today_hour  = StudyHoursPost::where('user_id', $user_id)->where('study_date', $today)->sum('total_hour');
        // 月
        $month_hour = StudyHoursPost::where('user_id', $user_id)->whereBetween('study_date', [$date_start, $date_end])
        ->sum('total_hour');
        // 棒グラフ
        $month_record = StudyHoursPost::where('user_id', $user_id)->whereBetween('study_date', [$date_start, $date_end])
        ->selectRaw('SUM(total_hour) AS total_hour, study_date')
        ->groupBy('study_date')
        ->get();
        // 棒グラフの学習日に対応する学習データを挿入する処理
        // 31日分の空データを用意、後で指定場所を削除して新たなデータを追加する
        $update_bargraph_data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        foreach ($month_record as $each_month_record) {
            $each_date = $each_month_record['study_date'];
            $each_date_day = date('d', strtotime($each_date));
            array_splice($update_bargraph_data, $each_date_day - 1, 1, $each_month_record['total_hour']);
        }

        // モーダル用の学習コンテンツデータ
        $modal_learning_contents = LearningContent::all();
        $modal_learning_languages = LearningLanguage::all();

        // 言語の円グラフ
        $learning_languages = LearningLanguage::withTrashed()->get();
        // joinじゃなくてModelでhasMany定義でwithメソッド使ったほうが良いかもしれないけどエラーでるので後回し
        $pie_chart_languages = LanguageRecord::where('user_id', $user_id)->join('learning_languages', 'language_records.learning_language_id', '=', 'learning_languages.id')
            ->selectRaw('SUM(study_hour) AS study_hour, learning_language_id, name, color')
            ->orderBy('learning_language_id')
            ->groupBy('learning_language_id')
            ->get();
        // コンテンツの円グラフ
        $learning_contents = LearningContent::withTrashed()->get();
        $pie_chart_contents = ContentRecord::where('user_id', $user_id)->join('learning_contents', 'content_records.learning_content_id', '=', 'learning_contents.id')
            ->selectRaw('SUM(study_hour) AS study_hour, learning_content_id, name, color')
            ->orderBy('learning_content_id')
            ->groupBy('learning_content_id')
            ->get();

        return view('index', compact('today_hour', 'month_hour', 'total_hour','modal_learning_languages', 'learning_languages', 'pie_chart_languages', 'modal_learning_contents', 'learning_contents', 'pie_chart_contents', 'this_month', 'update_bargraph_data', 'week_of_year', 'user'));
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
        $data = $request->all();
        unset($data['_token']);
        //sampleコードを参考に追加
        $study_hours_post = StudyHoursPost::create([
            'user_id' => $data['user_id'],
            'total_hour' => $data['study_hour'],
            'study_date' => $data['date']
        ]);

        // ver8以前はbulk insert用の関数が用意されていないので自分で作成

        // createメソッド使用バージョン・・for文でクエリ複数発行しているので理想ではない
        for ($i = 1; $i <= count($data['learning_language']); $i++) {
            $language_record = new LanguageRecord();
            // 言語を複数選択した際に、その分学習時間が合計されてしまうことを防ぎたい
            // $data['study_hour']を選択された数で割り算して平均出す・・データ型をintegerからdoubleに変更した
            $language_record->create([
                'date' => $data['date'],
                'study_hour' => $study_hours_post->total_hour/count($data['learning_language']),
                'user_id' => $data['user_id'],
                'learning_language_id' => $data['learning_language'][$i - 1]
            ]);
        }
        for ($i = 1; $i <= count($data['learning_content']); $i++) {
            // ContentRecordのmodelクラスのインスタンスを生成
            $content_record = new ContentRecord();
            $content_record->create([
                'date' => $data['date'],
                'study_hour' => $study_hours_post->total_hour/count($data['learning_content']),
                'user_id' => $data['user_id'],
                'learning_content_id' => $data['learning_content'][$i - 1]
            ]);
        }
        return redirect()->route('webapp');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
