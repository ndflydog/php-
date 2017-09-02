<script src='https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js'></script>
<script>
$.ajax({
        url:"http://www.hezi.com/test",
        data:{count:10,start:10},
        dataType:'jsonp',
        success:function(data){
            console.log(data);
        },
        error:function(err){
            console.log(err);
        }
        });
</script>