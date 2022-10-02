<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自主制作</title>
    <link rel="stylesheet" href="style.css">
    <!-- font awesome読み込み -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <!-- カレンダー埋め込み -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- chart.jsの読み込み -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <!-- datalabelsプラグインを呼び出す -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
</head>

<body>
    <!-- ヘッダー部分 -->
    <header id="header">
        <div id="header_inner" class="wrapper">
            <div class="logo_area">
                <h1 class="site_title">
                    <img src="./img/posseLogo.png" alt="POSSE">
                </h1>
                <span class="week">4th week</span>
            </div>
            <button id="openModal" class="submit__button">記録・投稿</button>
        </div>
    </header>
    <!-- loading -->
    <div id="my-spinner">
        <div id="circle-border">
            <div id="circle-core"></div>
        </div>
    </div>


    <!-- 月のweek毎のシート？ -->
    <div id="contents">
        <!-- 左側のコンテンツ -->
        <div class="bar_graph_wrapper">
            <div class="date">
                <section>
                    <p class="subtitle">Today</p>
                    <p class="number"><?php echo $today_learning_hour; ?></p>
                    <p class="hour">hour</p>
                </section>
                <section>
                    <p class="subtitle">Month</p>
                    <p class="number"><?php echo $month_learning_hour; ?></p>
                    <p class="hour">hour</p>
                </section>
                <section>
                    <p class="subtitle">Total</p>
                    <p class="number"><?php echo $total_learning_hour; ?></p>
                    <p class="hour">hour</p>
                </section>
            </div>
            <section class="bargraph">
                <div style="position: relative; height:auto; width:100%">
                    <canvas id="myBar2Chart">
                        <!-- jsグラフをphpファイルで読み込む -->
                        <script type="text/javascript">
                            //日ごとの学習時間を示す棒グラフ
                            var ctx = document.getElementById("myBar2Chart").getContext("2d");;

                            var blue_gradient = ctx.createLinearGradient(0, 0, 0, 600);
                            blue_gradient.addColorStop(0, "#3DCEFE");
                            blue_gradient.addColorStop(1, "#0056c0");

                            var myBar2Chart = new Chart(ctx, {
                                //グラフの種類
                                type: 'bar',
                                //データの設定
                                data: {
                                    //データ項目のラベル
                                    labels: ["", "2", "", "4", "", "6", "", "8", "", "10", "", "12", "", "14", "", "16", "", "18", "", "20", "", "22", "", "24", "", "26", "", "28", "", "30", ""],
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
                                        //   課題・・・dataの中に、24番目（25日）に5(h)をいれたい
                                        data: [
                                            <?php foreach ($update_bargraph_data as $value) : ?>
                                                <?php
                                                echo $value . ',';
                                                ?>
                                            <?php endforeach; ?>
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
                                            // scaleLabel: {              //軸ラベル設定
                                            //     display: true,          //表示設定
                                            //     labelString: '勉強時間',  //ラベル
                                            //     fontSize: 10               //フォントサイズ
                                            //  }
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
                        </script>
                    </canvas>
                </div>
            </section>
        </div>
        // <!-- 右側のコンテンツ -->
        <div class="doughnut_chart_wrapper">
            <section class="learning_language_area">
                <div class="learning_language">学習言語</div>
                <div class="languages_graph" style="position: relative; height:46%; width:80%">
                    <canvas id="myChart">
                        <!-- jsグラフをphpファイルで読み込む -->
                        <script type="text/javascript">
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
                                                var dataString = (Math.round(dataset.data[index] / dataSum * 1000) / 10).toString() + "%";
                                                // Make sure alignment settings are correct
                                                ctx.textAlign = 'center';
                                                ctx.textBaseline = 'middle';

                                                var padding = 5;
                                                var position = element.tooltipPosition();
                                                // ctx.fillText(labelString, position.x, position.y - (fontSize / 2) - padding);
                                                ctx.fillText(dataString, position.x, position.y + (fontSize / 2) - padding);
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
                                        // "JavaScript", "CSS", "PHP", "HTML", "Laravel", "SQL", "SHELL", "情報system基礎知識（その他）"
                                        <?php foreach ($update_language_data as $value) : ?>
                                            <?php
                                            echo $value;
                                            ?>
                                        <?php endforeach; ?>
                                    ],
                                    datasets: [{
                                        label: "学習言語",
                                        backgroundColor: [
                                            // "#0b03fc", "#1077a3", "#19b4c2", "#86c2db", "#b6a3d1", "#7250ab", "#4d0fb8", "#2f0b6e"
                                            <?php foreach ($update_language_color_data as $value) : ?>
                                                <?php
                                                echo $value;
                                                ?>
                                            <?php endforeach; ?>
                                        ],
                                        data: [
                                            <?php foreach ($sum_language_hours as $each_sum_language_hour) : ?>
                                                <?php
                                                // 最初のkeyがsum(learning_hour)になってる。。。
                                                echo $each_sum_language_hour[0] . ",";
                                                ?>
                                            <?php endforeach; ?>
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
                        </script>
                    </canvas>
                </div>

                <ul class="each_language">
                    <?php foreach ($learning_languages as $learning_language) : ?>
                        <li><span class="circle<?php print($learning_language['language_color']) ?>"></span><?php print($learning_language['learning_language']) ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>
            <section class="learning_contents_area">
                <div class="learning_contents">学習コンテンツ</div>
                <div class="contents_graph" style="position: relative; height:46%; width:80%">
                    <canvas id="myChart3">
                        <!-- <div id="donutchart" style="width: 100%; height: 300px;"> -->

                        <!-- jsグラフをphpファイルで読み込む -->
                        <script type="text/javascript">
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
                                                var dataString = (Math.round(dataset.data[index] / dataSum * 1000) / 10).toString() + "%";

                                                // Make sure alignment settings are correct
                                                ctx.textAlign = 'center';
                                                ctx.textBaseline = 'middle';

                                                var padding = 5;
                                                var position = element.tooltipPosition();
                                                // ctx.fillText(labelString, position.x, position.y - (fontSize / 2) - padding);
                                                ctx.fillText(dataString, position.x, position.y + (fontSize / 2) - padding);
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
                                        // "ドットインストール", "N予備校", "POSSE課題"
                                        <?php foreach ($update_content_data as $value) : ?>
                                            <?php
                                            echo $value;
                                            ?>
                                        <?php endforeach; ?>
                                    ],
                                    datasets: [{
                                        label: "Sample",
                                        backgroundColor: [
                                            // "#0b03fc", "#1077a3", "#19b4c2"
                                            <?php foreach ($update_content_color_data as $value) : ?>
                                                <?php
                                                echo $value;
                                                ?>
                                            <?php endforeach; ?>
                                        ],
                                        data: [
                                            // 42, 33, 25
                                            <?php foreach ($sum_content_hours as $each_sum_content_hour) : ?>
                                                <?php
                                                echo $each_sum_content_hour[0] . ",";
                                                ?>
                                            <?php endforeach; ?>
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
                        <!-- </div> -->
                    </canvas>
                </div>
                <ul class="each_content">
                    <?php foreach ($learning_contents as $learning_content) : ?>
                        <li><span class="circle<?php print($learning_content['content_color']) ?>"></span><?php print($learning_content['learning_content']) ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>
        </div>
    </div>
    <!-- 月のページ切り替え -->
    <div class="change_page">
        <time datetime="2021-10">
            <a href="#" class="arrow_left"></a>
            2021年10月
            <a href="#" class="arrow_right"></a>
        </time>
    </div>
    <!-- sp版のボタン -->
    <button id="openModal_2" class="submit__button_sp">記録・投稿</button>

    <!-- モーダルエリア、場所の確保 -->
    <section id="modalArea" class="modalArea">
        <!-- モーダル表示時の背景 -->
        <div id="modalBg" class="modalBg"></div>
        <!-- モーダル内に書き込むコンテンツ部分 -->
        <div class="modalWrapper">
            
            <!-- post処理 -->
            <form action="add_data.php" method="post" name="submitForm" class="submit__form">
                <!-- エリア内のflex適用部分 -->
                <div class="modal_area">
                    <!-- 左側のコンテンツ -->
                    <div id="modal_1st">

                        <div>
                            <div class="modal_small_title">学習日</div>
                            <input id="sample" class="s_textbox flatpickr-input" type="text" name="learning_date" readonly="readonly">
                        </div>

                        <div>
                            <div class="modal_small_title">学習コンテンツ（複数選択可）</div>
                            <ul class="check_contents">
                                <li><label id="check_area1"><input type="checkbox" name="learning_content" value="2"><span id="checkbox1" class="fas fa-check-circle check_style"></span>N予備校</label>
                                </li>
                                <li><label id="check_area2"><input type="checkbox" name="learning_content" value="1"><span id="checkbox2" class="fas fa-check-circle check_style"></span>ドットインストール</label></li>
                                <li><label id="check_area3"><input type="checkbox" name="learning_content" value="3"><span id="checkbox3" class="fas fa-check-circle check_style"></span>POSSE課題</label></li>
                            </ul>
                        </div>

                        <div>
                            <div class="modal_small_title">学習言語（複数選択可）</div>
                            <ul class="check_contents">
                                <li><label id="check_area4"><input type="checkbox" name="learning_language" value="4"><span id="checkbox4" class="fas fa-check-circle check_style"></span>HTML</label></li>
                                <li><label id="check_area5"><input type="checkbox" name="learning_language" value="2"><span id="checkbox5" class="fas fa-check-circle check_style"></span>CSS</label></li>
                                <li><label id="check_area6"><input type="checkbox" name="learning_language" value="1"><span id="checkbox6" class="fas fa-check-circle check_style"></span>JavaScript</label></li>
                                <li><label id="check_area7"><input type="checkbox" name="learning_language" value="3"><span id="checkbox7" class="fas fa-check-circle check_style"></span>PHP</label></li>
                                <li><label id="check_area8"><input type="checkbox" name="learning_language" value="5"><span id="checkbox8" class="fas fa-check-circle check_style"></span>Laravel</label></li>
                                <li><label id="check_area9"><input type="checkbox" name="learning_language" value="6"><span id="checkbox9" class="fas fa-check-circle check_style"></span>SQL</label></li>
                                <li><label id="check_area10"><input type="checkbox" name="learning_language" value="7"><span id="checkbox10" class="fas fa-check-circle check_style"></span>SHELL</label></li>
                                <li><label id="check_area11"><input type="checkbox" name="learning_language" value="8"><span id="checkbox11" class="fas fa-check-circle check_style"></span>情報システム基礎知識（その他）</label></li>
                            </ul>
                        </div>

                    </div>
                    <!-- 右側のコンテンツ -->
                    <div id="modal_2nd">
                        <div>
                            <p class="modal_small_title">学習時間</p>
                            <input id="learning_hour" class="s_textbox" type="number" name="learning_hour" step="1" min="0" max="10">
                        </div>

                        <div>
                            <p class="modal_small_title">Twitter用コメント</p>
                            <textarea id="textarea" class="l_textbox" name="comments_twitter"></textarea>
                        </div>

                        <div class="confirm_twitter">
                            <p><label id="check_area12"><input id="twitter_box" type="checkbox"><span id="checkbox12" class="fas fa-check-circle check_style"></span>Twitterにシェアする</label></p>
                        </div>
                    </div>

                    <!-- 投稿完了モーダル modal_area内、noneさせたいのはmodal_1st,right-->
                    <div id="awesome_area">
                        <div>
                            <img src="img/Awesome.png" alt="">
                        </div>
                        <p>記録・投稿</p>
                        <p>完了しました</p>
                    </div>

                    <div id="closeModal" class="closeModal">
                        ×
                    </div>


                </div>

                <!-- <button type="submit" name="submit" id="submit_info" class="submit__button2" target="_blank">記録・投稿</button> -->
                <input type="submit" name="submit" id="submit_info" class="submit__button2" target="_blank" value="記録・投稿">
            </form>
        </div>
    </section>
    <script src="webapp.js"></script>
</body>

</html>