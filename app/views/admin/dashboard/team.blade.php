@extends('admin.layouts.admin')

@section('content')

<div class="pad-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h4 class="clearfix pull-left">
                Team Earning Amount
            </h4>
            <div class="btn-group pull-right range" id="btn-group-1">
                <button class="btn btn-sm btn-default" onclick="loadChartSalesData('{{url('admin/dashboard/load-chart-sales-team-data/day')}}', this)">Today</button>
                <button class="btn btn-sm btn-default" onclick="loadChartSalesData('{{url('admin/dashboard/load-chart-sales-team-data/month')}}', this)">This Month</button>
                <button class="btn btn-sm btn-default" onclick="loadChartSalesData('{{url('admin/dashboard/load-chart-sales-team-data/year')}}', this)">This Year</button>
            </div>
        </div>
    </div>
    <div class="row chart">
        <div class="col-md-12">
            <div class="chart-container">
                <div id="sales-chart" class="chart-placeholder"></div>
            </div>
        </div>
    </div>
</div>



@stop

@section('footer')
@parent
<script src="{{url('js/jquery.flot.min.js')}}"></script>
<script type="text/javascript">

    var options = {
        series: {
            lines: { show: true,
                lineWidth: 1,
                fill: true,
                fillColor: { colors: [ { opacity: 0.1 }, { opacity: 0.13 } ] }
            },
            points: { show: true,
                lineWidth: 2,
                radius: 3
            },
            shadowSize: 0,
            stack: true
        },
        xaxis: {
            tickDecimals: 0
        },
        grid: {
            hoverable: true,
            clickable: true,
            borderWidth: 0
        },
        legend: {
            // show: false
            labelBoxBorderColor: "#fff"
        },
        colors: [ "#30a0eb", "#a7b5c5", 'red']
    };

    var dataSales = [];

    function loadChartSalesData(dataurl, element)
    {
        $(element).siblings().removeClass('active');
        $(element).addClass('active');

        dataSales = [];

        $.ajax({
            url: dataurl,
            type: "GET",
            dataType: "json",
            success: onDataReceived
        });

        function onDataReceived(series) {

            dataSales.push(series[0]);

            $.plot("#sales-chart", dataSales, options);
        }
    }


    $(function() {
        $.plot("#sales-chart", dataSales, options);

        $("#sales-chart").bind("plothover", onPlotHover);

        $("<div id='tooltip'></div>").css({
            position: "absolute",
            display: "none",
            border: "1px solid #fdd",
            padding: "2px",
            "background-color": "#fee",
            opacity: 0.80
        }).appendTo("body");



        $('#btn-group-1 .btn').eq(1).click();
    });

    function onPlotHover(event, pos, item){
        if (item) {
            var y = item.datapoint[1].toFixed(0);
            $("#tooltip").html(y)
                .css({top: item.pageY-35, left: item.pageX-5})
                .fadeIn(200);
        } else {
            $("#tooltip").hide();
        }
    }

</script>

@stop