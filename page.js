var page = {
    "url"       :   url,
    "total"     :   total,
    "current"   :   current,
    "pageSize"  :   30,
    "pages"     :   pages,
    //获取分页信息
    "getResult" :   function (type = 'get', data = null, dataType = 'json') {
        $.ajax({
            url         :   this.url,
            type        :   this.type,
            date        :   data,
            async       :   true,
            cache       :   false,
            dataType    :   dataType, 
            success     :   this.success,
        });
    },
    //定义格式为 {code = 0,1 msg = '成功?失败?' data = [{'total' : 1}, {'result' : array}]}    
    "success"   :   function(data) {
        if(data.code == 0) {
            this.total = data.total;
            this.pages = math.ceil(data.total / this.total);
            this.generatePagintaion(data.result);
        }else if(data.code == 1) {
            console.log(data.msg);
        }
    },
    'generatePaginaion' : function (data) {
        var paginaion = '';
        var length = (this.pages <= 10) ? this.pages : 10;
        for(var i = 1; i < length; i++) {
            paginaion += '<li><a class = "'+(this.current == i ? "active" : "")+'" data-url="'+this.url+'?current="'+i+'&pageSize='+this.pageSize+'>'+i+'</a><li>';
        }
        var prevPage = (this.current - 1 > 0) ? (this.current - 1) : 1;
        var nextPage = (this.current + 1 < this.pages) ? (this.current + 1) : this.pages;
        var prevPage = '<li><a class = "'+(this.current == 1 ? "disabled" : "")+'" data-url="'+this.url+'?current="'+i+'&pageSize='+prevPage+'><<</a><li>';
        var nextPage = '<li><a class = "'+(this.current == this.pages ? "disabled" : "")+'" data-url="'+this.url+'?current="'+i+'&pageSize='+nextPage+'>>></a><li>'; 
        return '<ul class="paginaion">'+prevPage+paginaion+nextPage+'</ul>';
     }
}