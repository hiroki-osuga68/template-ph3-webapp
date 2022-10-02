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
  // spinner.classList.toggle('loaded');
  // console.log(submit_info);
  setTimeout(disappearSpinner, 1990);
  setTimeout(showFinish, 2000);
};


// クリックした際にチェックボックスの色、各項目の背景色を変える
// font awesomeでチェックボックス使っちゃたから余計な苦労してる説アリ
function coloringCheckbox(i){
  let checkbox = document.getElementById(`checkbox${i+1}`);
  let check_area = document.getElementById(`check_area${i+1}`);
  
  checkbox.onclick = function(){
    checkbox.classList.toggle('check_style_click');
    check_area.classList.toggle('check_area_click');
  };
};
for(i=0; i<=11; i++){
  coloringCheckbox(i);
};

// 何にチェックしたかをコンソールで表示
const formElements = document.forms.submitForm;

formElements.addEventListener('submit', e =>{
  e.preventDefault();
  Array.prototype.forEach.call(formElements.learning_content, function (checkbox) {
    if(checkbox.checked === true){
      console.log('学習内容id：', checkbox.value);
      // console.log(checkbox);
      // formElements.learningに含まれる要素すべてがforEachにより１つのcheckboxという引数に格納された
    }
  });
  Array.prototype.forEach.call(formElements.learning_language, function (checkbox) {
    if(checkbox.checked === true){
      console.log('学習言語id：', checkbox.value);
      // console.log(checkbox);
      // formElements.learningに含まれる要素すべてがforEachにより１つのcheckboxという引数に格納された
    }
  });
})

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
