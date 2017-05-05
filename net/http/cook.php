<?php

if ($_COOKIE['test'] == 1) {
    echo 'have cookie test';
    unset($_COOKIE['test']);
    setcookie('test', '', time() - 360000, '/');
    unset($_COOKIE['test']);
    header('Location:/http/test.php');
?>
    <script>
    window.onload = function(){
      //alert(getCookie('test'));
      //clearCookie('test');
      //window.location = "/http/test.php";
    }
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/";
    }
    //清除cookie  
    function clearCookie(name) {  
        setCookie(name, "", -1000);  
    }  
    //获取cookie
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
        }
        return "";
    }
    </script>';
<?php
} else {
    setcookie('test', 1, time()+ 3600, '/');
    echo 'set cookie';
}
