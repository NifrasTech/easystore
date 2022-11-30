<html>
<head></head>
<body>
<div id="wdr-component"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.webdatarocks.com/latest/webdatarocks.min.css" rel="stylesheet"/>
<script src="https://cdn.webdatarocks.com/latest/webdatarocks.toolbar.min.js"></script>
<script src="https://cdn.webdatarocks.com/latest/webdatarocks.js"></script>

<script>
var datajs;

$(document).ready(function(){
    $.ajax({
        type: "POST",
        url: "{{route('show-products')}}",
        // contentType: "application/json; charset=utf-8",
        dataType: "json",
        data: {_token:"{{csrf_token()}}"},
        success: function(data){
            datajs = data
        },
    });
});



var pivot = new WebDataRocks({
	container: "#wdr-component",
	toolbar: true,
	report: {
		dataSource: {
			data: datajs
		}
	}
});
</script>
</body>
</html>