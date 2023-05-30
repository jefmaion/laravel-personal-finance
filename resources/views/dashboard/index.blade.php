@extends('template.main')

@section('title')
<i class="fa fa-list" aria-hidden="true"></i> Inicio
@endsection

@section('content')
<div class="row">

    <div class="col-md-4">
        <div class="statistic-block flex-fill block">
            <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title ">
                    <div class="icon "><i class="icon-contract"></i></div><strong>Receitas</strong>
                </div>
                <div class="number text-success">R$ 12312</div>
            </div>

        </div>
    </div>

    <div class="col-md-4 ">
        <div class="statistic-block flex-fill block">
            <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                    <div class="icon"><i class="icon-user-1"></i></div><strong>Despesas</strong>
                </div>
                <div class="number text-danger">R$ 123123</div>
            </div>
        </div>
    </div>

    <div class="col-md-4 d-flex">
        <div class="statistic-block flex-fill block">
            <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                    <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>Saldo</strong>
                </div>
                <div class="number text-sucess">R$ 31232</div>
            </div>

        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-8">
        <div class="line-chart block chart">
            <div class="bar-chart chart">
                <h5>Receitas x Despesas</h5>
                <div id="main" style="width: 100%;height:400px;"></div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="line-chart block chart">
            <div class="bar-chart chart">
                <h5>Receitas x Despesas</h5>
                <div id="pie" style="width: 100%;height:400px;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.2/dist/echarts.min.js"></script>
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('main'));
    var myPie = echarts.init(document.getElementById('pie'));

    // Specify the configuration items and data for the chart
    var option = {

      tooltip: {},
      grid: {
    left: '1%',
    right: '1%',
    bottom: '1%',
    containLabel: true
  },
     
      xAxis: {!! $chart['xAxis'] !!},
      yAxis : [
        {
            type : 'value',
            splitLine: {
                lineStyle: {
                    color: '#212529'
                }
            }
        }
    ],
      series: {!! $chart['series'] !!}
    };

    // Display the chart using the configuration items and data just specified.
    myChart.setOption(option);
    
option2 = {
    title: {
    text: 'Referer of a Website',
    subtext: 'Fake Data',
    left: 'center'
  },
  tooltip: {
    trigger: 'item'
  },
  legend: {
    orient: 'vertical',
    left: 'left'
  },
  series: [
    {
      name: 'Access From',
      type: 'pie',
      radius: '50%',
      data: {!! $pie !!},
      emphasis: {
        itemStyle: {
          shadowBlur: 10,
          shadowOffsetX: 0,
          shadowColor: 'rgba(0, 0, 0, 0.5)'
        }
      }
    }
  ]
};

myPie.setOption(option2);

</script>
@endsection