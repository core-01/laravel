<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="display: flex; justify-content: center;">
    @php
    $exten = explode('.',$image);
    
    @endphp
    @if(in_array('jpeg', $exten) || in_array('jpg', $exten) || in_array('png', $exten))
	<img src="{{$image}}">
	@endif
	@if(in_array('pdf', $exten))
	<iframe src="{{$image}}" style="width: 100%; height: 100vh; border: none;"></iframe>
	@endif
</body>
</html>