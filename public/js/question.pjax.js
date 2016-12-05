  // 解答を送信時に実行する処理
  var init_question = function() {
    $(".ans_btn").click(function(e) {
      var url = $('#question-form').attr("action");
      $('#ly-q-main').animate({opacity:0}, 300, function(){
        $.pjax({
          url: url,
          container: "#ly-q-main",
          fragment: "#ly-q-main",
          type: "POST",
          data: $('#question-form').serializeHash(),
        });
        return false;
      });
    });
    
  };
  
  init_question();
  
  // pjaxの完了時に実行
  $(document).on('pjax:complete', function(e, data) {
    // 最終問題を解答後はresultページへ遷移する
    if (data.responseText == 'false') {
      location.href='/question/result';
    } else {
      init_question();
      countReset();
      $('#ly-q-main').stop().animate({opacity:1}, 300);
    }
    
  });
  // タイムアウト時
  $(document).on('pjax:timeout', function(event) {
    $('#ly-q-main').animate({opacity:1}, 300);
    // Prevent default timeout redirection behavior
    event.preventDefault();
  });