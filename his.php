
<style type="text/css">
.table p{
    margin-bottom: 0;
}
.table-detail {
    margin-bottom: 0;
}
.line-box {
    margin-bottom: 20px;
}
#line {
    width: 100%;
    height: 300px;
}
#j_chart_table tbody tr:not([data-page="1"]) {
    display: none;
}
.pagination li:nth-child(n + 12):not(.last) {
    display: none;
}
.top-title {
  font-size: 18px;
}
</style>
<div class="tab-box">
    <ul class="nav nav-tabs">
        <li class="active"><a href="javascript:;">游戏历史热度</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active">
            <h1 class="top-title" data-gid="<?php echo $maingid; ?>"><?php echo $name.'('.$area.')';?>历史热度</h1>
            <br>
            <div class="line-box">
                <div id="line" class="line">

                </div>
            </div>
            <table id="j_chart_table" class="table table-bordered table-hover j-chart-table">
                <thead>
                    <tr class="active">
                        <th>日期</th>
                        <th>用户数</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div class="pagination-box pull-right">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/lib/echarts.min.js"></script>
<script type="text/javascript">
(function () {
  var defaultOption = {
      legend: {
          x: 'right',
          textStyle: {color: 'autp'},
          data: ['用户数']
      },
      tooltip: {
          show: true,
          trigger: 'axis',
          formatter: ''
      },
      dataZoom: {
          show: true,
          height: 20
      },
      grid: {
          x: 50,
          y: 30,
          x2: 60,
          y2: 60,
          borderWidth: 0
      },
      xAxis: {
          type: 'category',
          boundaryGap: false,
          splitLine: {
              show: false
          },
          // axisTick: {
          //     show: true,
          //     length: 10,
          //     lineStyle: {
          //         color: '#0079bd',
          //         type: 'solid',
          //         width: 2
          //     }
          // },
          // axisLabel: {
          //     show: true,
          //     rotate: 45
          // },
          data: []
      },
      yAxis: [
          {
              type: 'value',
              splitNumber: 2,
              axisLine: {
                show: false
              },
              // symbol: 'roundRect'
              // position: 'left',
              // splitLine: {
              //     show: false
              // },
              // axisLabel: {
              //     show: false,
              //     interval: 'auto',
              //     textStyle: {
              //         color: 'rgb(255,127,80)',
              //         fontFamily: 'verdana',
              //         fontSize: 10
              //     }
              // }
          }
      ],
      series: [
          {
              name: '人数',
              type: 'line',
              // stach: '总量',
              symbol: 'circle',
              symbolSize: 8,
              itemStyle: {
                  normal: {
                      areaStyle: {
                         color: 'rgba(51,122, 183,0.2)'
                      },
                      color: '#337ab7'

                  }
              },
              data: []
          }
      ]
  };

  var chartUserCount = echarts.init($('#line')[0]);

  $body = $(document.body);

  $body.on('renderChart', function (ev) {
    defaultOption.xAxis.data = ev.chartData.datetime;
    defaultOption.series[0].data = ev.chartData.numOfday;
    chartUserCount.setOption(defaultOption);
  });

  $body.on('renderTable', createRows);

  $body.on('renderPagination', createPagination);

  $.get('/client-game-sort/day-his', {id: $('.top-title').data('gid')}).done(function (res) {
    if (res.code) {
      swal(res.info, '', 'error');
      return;
    }

    var params = {
      chartData: res.result
    };

    var evChart = $.Event('renderChart', params);
    var evTable = $.Event('renderTable', params);
    var evPagination = $.Event('renderPagination', {pageSize: res.result.numOfday.length});
    $body.trigger(evChart);
    $body.trigger(evTable);
    $body.trigger(evPagination);
  });


  function createRows(ev) {
      var datetime = ev.chartData.datetime;
      var numOfday = ev.chartData.numOfday;
      var _html = [];
      for(var i = datetime.length - 1; i>= 0; i--) {
          _html.push(
              '<tr data-page="' + Math.ceil((i + 1) / 10) + '">' +
              '<td>' + datetime[i] + '</td>' +
              '<td>' + numOfday[i] + '</td>' +
              '</td>'
          );
      }

      $('#j_chart_table tbody').html(_html.join(''));
  }

  function createPagination(ev) {
      var total = ev.pageSize;
      // if (total <= 10) return;

      var size = 10;                              // 每页默认显示10条
      var cur = 1;                                // 当前显示页码
      var count = Math.ceil(total / size);        // 页数

      var $ul = $('<ul />', {'class': 'pagination'});
      var first = '<li class="first disabled"><a href="javascript:;">&laquo;&laquo;</a></li>';
      var last = '<li class="last"><a href="javascript:;">&raquo;&raquo;</a></li>';

      var pagination = [];
      pagination.push(first);
      var li = '';

      for(var i = 1; i <= count; i++) {
          if (i === 1) {
              li = '<li class="active" data-page="' + i + '"><a href="javascript:;">' + i + '</a></li>';
          } else {
              li = '<li data-page="' + i + '"><a href="javascript:;">' + i + '</a></li>';
          }
          pagination.push(li);
      }

      pagination.push(last);
      $ul.append(pagination.join(''));
      if (total <= 10) {
        $ul.children().last().addClass('disabled');
      }
      $('.pagination-box').html($ul);
  }

  // 点击分页
  $('.pagination-box').on('click', 'li', function () {
      var $ul = $(this).parent();
      if ($(this).hasClass('active') || $(this).hasClass('disabled')) return;

      var page = 0;
      if ($(this).hasClass('first')) {
          page = 1;
      } else if ($(this).hasClass('last')) {
          page = +$('.last', $ul).prev().data('page');
      } else {
          page = +$(this).data('page');
      }

      pageJump.call($ul[0] ,page);
  });


  // 跳到第n页
  function pageJump(n) {
      var $first = $('.first', this);
      var $last = $('.last', this);
      var $page = $('li', this).not('.first, .last');
      var len = $page.length;

      //表格数据显示
      var $rows = $(this).parent().prev().find('tbody tr');
      $rows.filter(':visible').hide();
      $rows.filter('[data-page="' + n + '"]').show();

      $page.filter('.active').removeClass('active');
      $page.eq(n - 1).addClass('active');

      $page.hide();

      // 左箭头、右箭头启用
      if (n === 1) {
          $first.addClass('disabled');
      } else {
          $first.removeClass('disabled');
      }

      if (n === len) {
          $last.addClass('disabled');
      } else {
          $last.removeClass('disabled');
      }

      // 当前页码总在第六个位置上
      // 不需要移动页码
      if (n <= 6) {
          $page.slice(0, 10).css('display', 'inline');

      } else if (n > 6 && n <= len - 4) {  // 超过第六页，并且右侧4个页码不够显示剩余页码，则显示当前页码到中间位置
          $page.slice((n - 6), (n + 4)).css('display', 'inline');

      } else if (n > len - 4) { // 当前页码后4个，已经显示所有页码，不移动页码位置
          $page.slice((len - 10), len).css('display', 'inline');
      }
  }

})();
</script>
