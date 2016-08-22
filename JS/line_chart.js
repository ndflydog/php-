/**
 * 需要jquery支持
 *折线图
 */

var chart = {
    //设置id
    "canvas": "canvas",

    "getContext": function() {
        if (!document.getElementById(this.canvas)) {
            return false;
        }
        return document.getElementById(this.canvas).getContext('2d');
    }
}