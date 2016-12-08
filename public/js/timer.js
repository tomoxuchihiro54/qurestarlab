var count = 0; //カウントの初期値
timerID = setInterval('countup()',1000); //1秒毎にcountup()を呼び出し

function countup() {
	count++;
	document.question.counter.value = count;
}

function countReset() {
  count = 0;
}

