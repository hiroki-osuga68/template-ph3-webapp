// カレンダーのテキスト表示
var sample = document.getElementById('sample');
var fp = flatpickr(sample);

//modalの開閉
(function () {
    const modalArea = document.getElementById('modalArea');
    const openModal = document.getElementById('openModal');
    const openModal_2 = document.getElementById('openModal_2');
    const closeModal = document.getElementById('closeModal');
    const modalBg = document.getElementById('modalBg');
    const toggle = [openModal,openModal_2,closeModal,modalBg];
    
    for(let i=0, len=toggle.length ; i<len ; i++){
      toggle[i].addEventListener('click',function(){                
        modalArea.classList.toggle('is-show');        
      },false);
    }
  }());

// 投稿ボタンのid読み込み
const submit_info = document.getElementById('submit_info');

// loadingを消す
function disappearSpinner(){
  spinner.style.display = "none";
}
// 投稿完了の表示をさせる関数の宣言
function showFinish() {
  const modal_1st = document.getElementById('modal_1st');
  const modal_2nd = document.getElementById('modal_2nd');
  const awesome_area = document.getElementById('awesome_area');
  modal_1st.style.display = "none";
  modal_2nd.style.display = "none";
  awesome_area.style.display = "block";
  submit_info.style.display = "none";
};
// 投稿ボタンを押した際、最初にloadingし、2秒後に投稿完了の表示をさせる
let spinner = document.getElementById('my-spinner');
submit_info.onclick = function(){
  // loadingを表示させる
  let circle_border = document.getElementById('circle-border');
  let circle_core = document.getElementById('circle-core');
  spinner.className = 'spinner-box';
  circle_border.className = 'circle-border';
  circle_core.className = 'circle-core';
  // .loaded を追加してローディング表示を消す
  setTimeout(disappearSpinner, 1990);
  setTimeout(showFinish, 2000);
};

// チェック判定はラベル全体に有効→チェックボックスが押されたら背景も変える
const checkboxes = document.querySelectorAll(".checkboxes");
const checkareas = document.querySelectorAll(".checkareas");
checkboxes.forEach((checkbox) => {
  checkbox.addEventListener("click", function () {
    checkbox.classList.toggle("check_style_click");
    // チェックされたボックスの親要素labelを取得し、背景色を変更
    checkbox.parentElement.classList.toggle("check_area_click");
  });
});

// チェック項目が1つも選択されていない場合に、バリデーション
// let checked_sum; //チェックが入っている個数
// $('.submit_info').on("click",function(){
//    checked_sum = $('.validation:checked').length; //チェックが入っているチェックボックスの取得
//    if( checked_sum > 0 ){
//         $('.validation').prop("required",false); //required属性の解除
//    }else{
//         $('.validation').prop("required",true); //required属性の付与
//    }
// });

// シェア用
//ツイートエリアの作成

let learningHour = document.getElementById('learning_hour');

const button = document.getElementById('submit_info');
let $url = 'https://twitter.com/intent/tweet?'
button.setAttribute('href', $url);

let twitterBox = document.getElementById('twitter_box');

button.addEventListener('click', ()=>{
  if(twitterBox.checked === true){
  document.getElementById('textarea').value
  $url += `text=${document.getElementById('textarea').value}`
  console.log($url);
  // 送信した際に、学習日を記録
  console.log('学習日：',sample.value);
  // 送信した際に、学習時間を記録
  console.log('学習時間：', learningHour.value);
  // location.href = $url;
  window.open($url,'_blank');

}
})
