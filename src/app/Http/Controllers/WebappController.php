<?php

namespace App\Http\Controllers;
// ファサード
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// モデル
use App\Model\LearningContent;
use App\Model\LearningLanguage;
use App\Model\ContentRecord;
use App\Model\LanguageRecord;
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

        // 合計
        $total_language_hour = LanguageRecord::where('user_id', $user_id)->sum('study_hour');
        $total_content_hour = ContentRecord::where('user_id', $user_id)->sum('study_hour');
        // ※（単純な足し算じゃ実用的じゃないから言語・コンテンツが一緒に選択されたら足し算されないような仕組みのがbetterか）
        $total_study_hour = $total_content_hour + $total_language_hour;
        // 今日
        $today_language_hour = LanguageRecord::where('user_id', $user_id)->where('date', $today)->sum('study_hour');
        $today_content_hour = ContentRecord::where('user_id', $user_id)->where('date', $today)->sum('study_hour');
        $today_study_hour = $today_language_hour + $today_content_hour;
        // 月
        $month_language_hour = LanguageRecord::where('user_id', $user_id)->whereBetween('date', [$date_start, $date_end])
            ->sum('study_hour');
        $month_content_hour = ContentRecord::where('user_id', $user_id)->whereBetween('date', [$date_start, $date_end])
            ->sum('study_hour');
        $month_study_hour = $month_language_hour + $month_content_hour;
        // 棒グラフ
        // 1．言語レコード
        $month_language_record = LanguageRecord::where('user_id', $user_id)->whereBetween('date', [$date_start, $date_end])
            ->selectRaw('SUM(study_hour) AS study_hour, date')
            ->groupBy('date')
            ->get();
        // 2．コンテンツレコード
        $month_content_record = ContentRecord::where('user_id', $user_id)->whereBetween('date', [$date_start, $date_end])
            ->selectRaw('SUM(study_hour) AS study_hour, date')
            ->groupBy('date')
            ->get();

        // 棒グラフの学習日に対応する学習データを挿入する処理
        // 31日分の空データを用意、後で指定場所を削除して新たなデータを追加する
        $update_bargraph_data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        foreach ($month_language_record as $each_month_language_record) {
            $each_date = $each_month_language_record['date'];
            $each_date_day = date('d', strtotime($each_date));
            array_splice($update_bargraph_data, $each_date_day - 1, 1, $each_month_language_record['study_hour']);
        }

        // 言語の円グラフ
        $learning_languages = LearningLanguage::all();
        // joinじゃなくてModelでhasMany定義でwithメソッド使ったほうが良いかもしれないけどエラーでるので後回し
        $pie_chart_languages = LanguageRecord::where('user_id', $user_id)->join('learning_languages', 'language_records.learning_language_id', '=', 'learning_languages.id')
            ->selectRaw('SUM(study_hour) AS study_hour, learning_language_id, name, color')
            ->orderBy('learning_language_id')
            ->groupBy('learning_language_id')
            ->get();

        // コンテンツの円グラフ
        $learning_contents = LearningContent::all();
        $pie_chart_contents = ContentRecord::where('user_id', $user_id)->join('learning_contents', 'content_records.learning_content_id', '=', 'learning_contents.id')
            ->selectRaw('SUM(study_hour) AS study_hour, learning_content_id, name, color')
            ->orderBy('learning_content_id')
            ->groupBy('learning_content_id')
            ->get();

        return view('index', compact('today_study_hour', 'month_study_hour', 'total_study_hour', 'learning_languages', 'pie_chart_languages', 'learning_contents', 'pie_chart_contents', 'this_month', 'update_bargraph_data'));
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
        //
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
