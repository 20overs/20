//https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20cricket.scorecard%20where%20match_id%3D11985&format=json&diagnostics=true&env=store%3A%2F%2F0TxIGQMQbObzvU4Apia0V0&callback=

$(function(){

	$.get("http://static.cricinfo.com/rss/livescores.xml",{},function(data){
			console.log(data);
			alert(data);
	});

});