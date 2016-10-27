<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <span onclick="enDate(this)">2天56时33分</span>
</body>
</html>
<script>
function enDate(that)
    {
         var date = that.innerHTML;
         var preg = /[0-9]+/g;
         var arr = date.match(preg);
         that.innerHTML =  arr[0]+' D '+arr[1]+' H '+ arr[2] +' M ';
    }
    var subject = '2天56时33分';
    var arr = subject.match(/[0-9]+/g);
</script>