@extends('layouts.master')
@include('parts.header')

@section('content')
    {{-- <!-- loading --> --}}
    <div id="my-spinner">
        <div id="circle-border">
            <div id="circle-core"></div>
        </div>
    </div>
    {{-- <!-- 月のweek毎のシート --> --}}
    <div id="contents">
        {{-- <!-- 左側のコンテンツ --> --}}
        <div class="bar_graph_wrapper">
            <div class="date">
                <section>
                    <p class="subtitle">Today</p>
                    <p class="number">{{ $today_study_hour }}</p>
                    <p class="hour">hour</p>
                </section>
                <section>
                    <p class="subtitle">Month</p>
                    <p class="number">{{ $month_study_hour }}</p>
                    <p class="hour">hour</p>
                </section>
                <section>
                    <p class="subtitle">Total</p>
                    <p class="number">{{ $total_study_hour }}</p>
                    <p class="hour">hour</p>
                </section>
            </div>
            <section class="bargraph">
                <div style="position: relative; height:auto; width:100%">
                    <canvas id="myBar2Chart">
                    </canvas>
                </div>
            </section>
        </div>
        {{-- <!-- 右側のコンテンツ --> --}}
        <div class="doughnut_chart_wrapper">
            <section class="learning_language_area">
                <div class="learning_language">学習言語</div>
                <div class="languages_graph" style="position: relative; height:46%; width:80%">
                    <canvas id="myChart">

                    </canvas>
                </div>

                <ul class="each_language">
                    @foreach ($learning_languages as $learning_language)
                        <li><span style="background-color: {{ $learning_language->color }}"
                                class="circle"></span>{{ $learning_language->name }}</li>
                    @endforeach
                </ul>
            </section>
            <section class="learning_contents_area">
                <div class="learning_contents">学習コンテンツ</div>
                <div class="contents_graph" style="position: relative; height:46%; width:80%">
                    <canvas id="myChart3">

                    </canvas>
                </div>
                <ul class="each_content">
                    @foreach ($learning_contents as $learning_content)
                        <li><span style="background-color: {{ $learning_content->color }}"
                                class="circle"></span>{{ $learning_content->name }}</li>
                    @endforeach
                </ul>
            </section>
        </div>
    </div>
    {{-- <!-- 月のページ切り替え --> --}}
    <div class="change_page">
        <time datetime="2021-10">
            <a href="#" class="arrow_left"></a>
            {{ $this_month }}
            <a href="#" class="arrow_right"></a>
        </time>
    </div>
    {{-- <!-- sp版のボタン --> --}}
    <button id="openModal_2" class="submit__button_sp">記録・投稿</button>

    {{-- <!-- モーダルエリア、場所の確保 --> --}}
    <section id="modalArea" class="modalArea">
        <!-- モーダル表示時の背景 -->
        <div id="modalBg" class="modalBg"></div>
        {{-- <!-- モーダル内に書き込むコンテンツ部分 --> --}}
        <div class="modalWrapper">

            {{-- <!-- post処理 --> --}}
            <form action="/webapp/store" method="post" name="submitForm" class="submit__form">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                {{-- <!-- エリア内のflex適用部分 --> --}}
                <div class="modal_area">
                    {{-- <!-- 左側のコンテンツ --> --}}
                    <div id="modal_1st">

                        <div>
                            <div class="modal_small_title">学習日</div>
                            <input id="sample" class="s_textbox flatpickr-input" type="text" name="date"
                                readonly="readonly" required>
                        </div>

                        <div>
                            <div class="modal_small_title">学習コンテンツ（複数選択可）</div>
                            <ul class="check_contents">
                                @foreach ($modal_learning_contents as $modal_learning_content)
                                    <li>
                                        <label class="checkareas"><input class="validation" type="checkbox" name="learning_content[]"
                                                value="{{ $modal_learning_content->id }}"><span
                                                class="fas fa-check-circle check_style checkboxes"><span
                                                    class="name_color">{{ $modal_learning_content->name }}</span></span></label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div>
                            <div class="modal_small_title">学習言語（複数選択可）</div>
                            <ul class="check_contents">
                                @foreach ($modal_learning_languages as $modal_learning_language)
                                    <li>
                                        <label class="checkareas"><input type="checkbox" name="learning_language[]"
                                                value="{{ $modal_learning_language->id }}"><span
                                                class="fas fa-check-circle check_style checkboxes"><span
                                                    class="name_color">{{ $modal_learning_language->name }}</span></span></label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                    {{-- <!-- 右側のコンテンツ --> --}}
                    <div id="modal_2nd">
                        <div>
                            <p class="modal_small_title">学習時間</p>
                            <input id="learning_hour" class="s_textbox" type="number" name="study_hour" step="1"
                                min="0" max="10" required>
                        </div>

                        <div>
                            <p class="modal_small_title">Twitter用コメント</p>
                            <textarea id="textarea" class="l_textbox" name="comments_twitter"></textarea>
                        </div>

                        <div class="confirm_twitter">
                            <p class="mb-0 "><label class="checkareas"><input id="twitter_box"
                                        type="checkbox"><span
                                        class="fas fa-check-circle check_style checkboxes"></span>Twitterにシェアする</label></p>
                        </div>
                    </div>

                    {{-- <!-- 投稿完了モーダル modal_area内、noneさせたいのはmodal_1st,right--> --}}
                    <div id="awesome_area">
                        <div>
                            <img src="{{ asset('images/Awesome.png') }}" alt="">
                        </div>
                        <p>記録・投稿</p>
                        <p>完了しました</p>
                    </div>

                    <div id="closeModal" class="closeModal">
                        ×
                    </div>


                </div>

                <input type="submit" name="submit" id="submit_info" class="submit__button2 submit_info" target="_blank"
                    value="記録・投稿">
            </form>
        </div>
    </section>

    <script>
        // 棒グラフ
        //日ごとの学習時間を示す棒グラフ
        var ctx = document.getElementById("myBar2Chart").getContext("2d");

        var blue_gradient = ctx.createLinearGradient(0, 0, 0, 600);
        blue_gradient.addColorStop(0, "#3DCEFE");
        blue_gradient.addColorStop(1, "#0056c0");

        var myBar2Chart = new Chart(ctx, {
            //グラフの種類
            type: 'bar',
            //データの設定
            data: {
                //データ項目のラベル
                labels: ["", "2", "", "4", "", "6", "", "8", "", "10", "", "12", "", "14", "", "16", "", "18", "",
                    "20", "", "22", "", "24", "", "26", "", "28", "", "30", ""
                ],
                //データセット
                datasets: [{
                    //凡例
                    label: "学習時間",
                    //背景色
                    // backgroundColor: "rgba(179,181,198,0.2)",
                    backgroundColor: blue_gradient,
                    //枠線の色
                    borderColor: blue_gradient,
                    //枠線の太さ
                    borderWidth: 1,
                    //背景色（ホバーしたときに）
                    hoverBackgroundColor: "rgba(0, 191, 255, 0.4)",
                    //枠線の色（ホバーしたときに）
                    hoverBorderColor: "rgba(0, 191, 255, 0.4)",
                    borderRadius: 10,
                    borderSkipped: false,
                    //グラフのデータ
                    data: [
                        @foreach ($update_bargraph_data as $value)
                            "{{ $value }}",
                        @endforeach
                    ]
                }]
            },

            //オプションの設定
            options: {
                legend: {
                    display: false
                },
                //軸の設定
                scales: {
                    xAxes: [{
                        gridLines: {
                            //x軸の網線
                            display: false
                        },
                    }],
                    //縦軸の設定
                    yAxes: [{
                        //目盛りの設定
                        ticks: {
                            //開始値を0にする
                            beginAtZero: true,
                            min: 0, // 最小値
                            max: 8, // 最大値
                            stepSize: 2, // 軸間隔
                            fontColor: "rgb(65, 105, 225)", // 目盛りの色
                            fontSize: 10, // フォントサイズ
                            callback: function(value, index, values) {
                                return value + 'h'
                            }
                        },
                        gridLines: {
                            display: false,
                        },
                    }]
                },
                //ホバーの設定
                hover: {
                    //ホバー時の動作（single, label, dataset）
                    mode: 'single'
                },
                layout: { // 全体のレイアウト
                    padding: { // 余白
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 0
                    }
                }

            }
        });
        // 言語の円グラフ
        var dataLabelPlugin = {
            afterDatasetsDraw: function(chart, easing) {
                // To only draw at the end of animation, check for easing === 1
                var ctx = chart.ctx;

                chart.data.datasets.forEach(function(dataset, i) {
                    var dataSum = 0;
                    dataset.data.forEach(function(element) {
                        dataSum += element;
                    });

                    var meta = chart.getDatasetMeta(i);
                    if (!meta.hidden) {
                        meta.data.forEach(function(element, index) {
                            // Draw the text in black, with the specified font
                            ctx.fillStyle = 'rgb(255, 255, 255)';

                            var fontSize = 10;
                            var fontStyle = 'normal';
                            var fontFamily = 'Helvetica Neue';
                            ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                            // Just naively convert to string for now
                            var labelString = chart.data.labels[index];
                            var dataString = (Math.round(dataset.data[index] / dataSum * 1000) / 10)
                                .toString() + "%";
                            // Make sure alignment settings are correct
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';

                            var padding = 5;
                            var position = element.tooltipPosition();
                            // ctx.fillText(labelString, position.x, position.y - (fontSize / 2) - padding);
                            ctx.fillText(dataString, position.x, position.y + (fontSize / 2) -
                                padding);
                        });
                    }
                });
            }
        };

        // Chart
        var myChart = "myChart";
        var chart = new Chart(myChart, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach ($pie_chart_languages as $pie_chart_language)
                        "{{ $pie_chart_language->name }}",
                    @endforeach

                ],
                datasets: [{
                    label: "学習言語",
                    backgroundColor: [
                        @foreach ($pie_chart_languages as $pie_chart_language)
                            "{{ $pie_chart_language->color }}",
                        @endforeach

                    ],
                    data: [
                        @foreach ($pie_chart_languages as $pie_chart_language)
                            "{{ $pie_chart_language->study_hour }}",
                        @endforeach
                    ],
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: "bottom",
                    display: false
                },
                maintainAspectRatio: false,
            },
            plugins: [dataLabelPlugin]
        });
        // コンテンツの円グラフ
        var dataLabelPlugin = {
            afterDatasetsDraw: function(chart, easing) {
                // To only draw at the end of animation, check for easing === 1
                var ctx = chart.ctx;

                chart.data.datasets.forEach(function(dataset, i) {
                    var dataSum = 0;
                    dataset.data.forEach(function(element) {
                        dataSum += element;
                    });

                    var meta = chart.getDatasetMeta(i);
                    if (!meta.hidden) {
                        meta.data.forEach(function(element, index) {
                            // Draw the text in black, with the specified font
                            ctx.fillStyle = 'rgb(255, 255, 255)';

                            var fontSize = 12;
                            var fontStyle = 'normal';
                            var fontFamily = 'Helvetica Neue';
                            ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                            // Just naively convert to string for now
                            var labelString = chart.data.labels[index];
                            var dataString = (Math.round(dataset.data[index] / dataSum * 1000) / 10)
                                .toString() + "%";

                            // Make sure alignment settings are correct
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';

                            var padding = 5;
                            var position = element.tooltipPosition();
                            // ctx.fillText(labelString, position.x, position.y - (fontSize / 2) - padding);
                            ctx.fillText(dataString, position.x, position.y + (fontSize / 2) -
                                padding);
                        });
                    }
                });
            }
        };

        // Chart
        var myChart = "myChart3";
        var chart = new Chart(myChart, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach ($pie_chart_contents as $pie_chart_content)
                        "{{ $pie_chart_content->name }}",
                    @endforeach

                ],
                datasets: [{
                    label: "Sample",
                    backgroundColor: [
                        @foreach ($pie_chart_contents as $pie_chart_content)
                            "{{ $pie_chart_content->color }}",
                        @endforeach

                    ],
                    data: [
                        @foreach ($pie_chart_contents as $pie_chart_content)
                            "{{ $pie_chart_content->study_hour }}",
                        @endforeach

                    ],


                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: "bottom",
                    display: false
                },
                maintainAspectRatio: false,
            },
            plugins: [dataLabelPlugin],
        });
    </script>
@endsection
