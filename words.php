
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Слова</title>
<script src="js/jquery-2.0.3.js"></script>
</head>

<body bgcolor="#ccc">



<p align="center"><a href="str2.php">Назад</a> <a href="exit.php">ВЫХОД</a></p>
<table align="center" border="1">
<tr>
<td>
<form>
<textarea id="txt" rows="10" cols="45"></textarea>
</form>
</td>

</tr>
<tr>
<td>
<div id="content" style="width: 350px;">

</div>
</td>
</tr>
<tr>
<td>

</td>
</tr>
</table>
<script>

function strf(data){
	var words = data.split(/[^a-zА-яёЁ]/);
	var wordsCount = {};
	words.forEach(function(word){
		if(word in wordsCount){
			wordsCount [word] ++;
		} else {
			wordsCount [word] = 1;
		}
	});
	for(var word in wordsCount){
		if(wordsCount [word] >=2){
			data = data.replace(new RegExp("([^a-zА-яёЁ]|^)("+word+")(?=[^a-zA-ZА-яёЁ]|$)","g"), "$1<strong>$2</strong>");
			console.log(word);
		}
	}
	return data;
}

$(document).ready(function(){
	$('#txt').on('input', function(){
        
		var rtxt = strf(this.value);
		$('#content').html(rtxt);
    });
});

</script>
</body>
</html>
