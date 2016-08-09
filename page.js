<script src="//cdn.bootcss.com/jquery/3.1.0/jquery.js"></script>
var page = {
    "url"       :   "/site/pages",
    "total"     :   null,
    "current"   :   1,
    "pageSize"  :   30,
    "pages"     :   1,
    //div标签选择器
    "pagination" :   "#pagination",
    "perpage"   :   "#perpage",
    "tbody"     :   "#tbody",
    //获取分页信息
    "getResult" :   function (type = 'get', data = {pageSize:this.pageSize, current:this.current}, dataType = 'json') {
        var that = this;
        $.ajax({
            url         :   this.url,
            type        :   type,
            data        :   data,
            async       :   true,
            cache       :   false,
            dataType    :   dataType, 
            success     :   this.success,
        });
    },
    //定义格式为 {code = 0,1 msg = '成功?失败?' data = [{'total' : 1}, {'result' : array}]}    
    "success"   :   function(data) {
        console.log(data);
        if(data.code == 0) {
            page.total = data.result.total;
            page.pages = Math.ceil(data.result.total / page.pageSize);
            var pagination = page.generatePagination();
            var tbody = page.generateTable(data.result.page, data.result.field);
            var perpage = page.generatePerPage();
            $(page.pagination).html(pagination);
            $(page.tbody).html(tbody);
            $(page.perpage).html(perpage);
        }else if(data.code == 1) {
            console.log(data.msg);
        }
    },
    //生成分页
    'generatePagination' : function () {
        var pagination = '';
        var i = (this.pages > 10) ? ((this.current > 5) ? ((this.current - 5) < (this.pages - 10) ? this.current : (this.pages - 10)) : 1) : 1;
        var length = (this.pages < 10) ? this.pages : (10 - 1 + i < this.pages ? 10 - 1 + i : this.pages);
        for(i; i <= length; i++) {
            pagination += '<li class = "'+(this.current == i ? "active" : "")+'"><a data-value="'+i+'" data-url="'+this.url+'?current='+i+'&pageSize='+this.pageSize+'">'+i+'</a><li>';
        }
        var prevPage = (this.current - 1 > 0) ? (this.current - 1) : 1;
        var nextPage = (this.current + 1 < this.pages) ? (this.current + 1) : this.pages;
        prevPage = '<li class = "'+(prevPage == 1 ? "disabled" : "")+'"><a data-value = "'+prevPage+'" data-url="'+this.url+'?current='+i+'&pageSize='+prevPage+'&pageSize='+this.pageSize+'"><<</a><li>';
        nextPage = '<li class = "'+(nextPage == this.pages ? "disabled" : "")+'"><a data-value = "'+nextPage+'" data-url="'+this.url+'?current='+i+'&pageSize='+nextPage+'&pageSize='+this.pageSize+'">>></a><li>'; 
        return '<ul class="pagination">'+prevPage+pagination+nextPage+'</ul>';
     },
     //每页显示多少#perPage
     "generatePerPage" : function () {
         var perPage = '<select class="form-control">'
            +'<option value="20">20</option>'
            +'<option value="50">50</option>'
            +'<option value="100">100</option>'
            +'</select>';
        return perPage;
     },
     //table显示
     "generateTable"  : function (data, field) {
         var table = '';
         var length = data.length;
         for(var i = 0; i < length; i++) {
             table += '<tr>';
             for(var j = 0; j < field.length; j++) {
                 table +=  '<td>'+data[i][field[j]]+'</td>';
             }
             table += '</tr>';
         }
         return table;
     },
     //select事件函数设置此对象的pageSize
     "perPageClick" : function (select = "#perpage") {
         var that = this;
         $(select).on('change', "select", function (event){
             event.preventDefault();
             var pageSize = $(event.target).val();   
             page.pageSize = pageSize;
             page.getResult();
         });
     },
     //重绘数据.paginaion
     "paginationClick" : function () {
         var that = this;
         $('#pagination').on('click', 'a', function (event) {
             event.preventDefault();
             var value = $(event.target).data('value');
             page.current = value;
             page.getResult();
         });
     }
};
page.getResult();
page.perPageClick();
page.paginationClick();