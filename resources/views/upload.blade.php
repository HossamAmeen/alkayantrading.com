<html>

<body>
<form action="{{url('upload')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
<input name="excel" type="file">
    <input type="submit">
</form>
</body>
</html>