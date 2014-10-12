@extends('admin.layouts.admin')

@section('content')

<div class="pad-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h4 class="clearfix pull-left">
                Sales Statistic
            </h4>
            <div class="btn-group pull-right range" id="btn-group-1">
                <button class="btn btn-sm btn-default" onclick="loadChartSalesData('{{url('admin/dashboard/load-chart-sales-data/day')}}', this)">Today</button>
                <button class="btn btn-sm btn-default" onclick="loadChartSalesData('{{url('admin/dashboard/load-chart-sales-data/month')}}', this)">This Month</button>
                <button class="btn btn-sm btn-default" onclick="loadChartSalesData('{{url('admin/dashboard/load-chart-sales-data/year')}}', this)">This Year</button>
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

<div class="pad-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h4 class="clearfix pull-left">
                Jobs Statistic
            </h4>
            <div class="btn-group pull-right range" id="btn-group-2">
                <button class="btn btn-sm btn-default" onclick="loadChartJobsData('{{url('admin/dashboard/load-chart-jobs-data/day')}}', this)">Today</button>
                <button class="btn btn-sm btn-default" onclick="loadChartJobsData('{{url('admin/dashboard/load-chart-jobs-data/month')}}', this)">This Month</button>
                <button class="btn btn-sm btn-default" onclick="loadChartJobsData('{{url('admin/dashboard/load-chart-jobs-data/year')}}', this)">This Year</button>
            </div>
        </div>
    </div>
    <div class="row chart">
        <div class="col-md-12">
            <div class="chart-container">
                <div id="jobs-chart" class="chart-placeholder"></div>
            </div>
        </div>
    </div>
</div>

<div class="pad-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h4 class="clearfix pull-left">
                Team Paid Amount
            </h4>
            <div class="btn-group pull-right range" id="btn-group-5">
                <button class="btn btn-sm btn-default" onclick="loadChartTeamPaidData('{{url('admin/dashboard/load-chart-sales-teams-data/day')}}', this)">Today</button>
                <button class="btn btn-sm btn-default" onclick="loadChartTeamPaidData('{{url('admin/dashboard/load-chart-sales-teams-data/month')}}', this)">This Month</button>
                <button class="btn btn-sm btn-default" onclick="loadChartTeamPaidData('{{url('admin/dashboard/load-chart-sales-teams-data/year')}}', this)">This Year</button>
            </div>
        </div>
    </div>
    <div class="row chart">
        <div class="col-md-12">
            <div class="chart-container">
                <div id="paid-team-chart" class="chart-placeholder"></div>
            </div>
        </div>
    </div>
</div>

<div class="pad-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h4 class="clearfix pull-left">
                Total Ratings
            </h4>
            <div class="btn-group pull-right range" id="btn-group-3">
                <button class="btn btn-sm btn-default" onclick="loadChartRatingData('{{url('admin/dashboard/load-chart-rating-data/day')}}', this)">Today</button>
                <button class="btn btn-sm btn-default" onclick="loadChartRatingData('{{url('admin/dashboard/load-chart-rating-data/month')}}', this)">This Month</button>
                <button class="btn btn-sm btn-default" onclick="loadChartRatingData('{{url('admin/dashboard/load-chart-rating-data/year')}}', this)">This Year</button>
            </div>
        </div>
    </div>
    <div class="row chart">
        <div class="col-md-12">
            <div class="chart-container">
                <div id="rating-chart" class="chart-placeholder"></div>
            </div>
        </div>
    </div>
</div>

<div class="pad-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h4 class="clearfix pull-left">
                Total Coupons Used
            </h4>
            <div class="btn-group pull-right range" id="btn-group-4">
                <button class="btn btn-sm btn-default" onclick="loadChartCouponData('{{url('admin/dashboard/load-chart-coupon-data/day')}}', this)">Today</button>
                <button class="btn btn-sm btn-default" onclick="loadChartCouponData('{{url('admin/dashboard/load-chart-coupon-data/month')}}', this)">This Month</button>
                <button class="btn btn-sm btn-default" onclick="loadChartCouponData('{{url('admin/dashboard/load-chart-coupon-data/year')}}', this)">This Year</button>
            </div>
        </div>
    </div>
    <div class="row chart">
        <div class="col-md-12">
            <div class="chart-container">
                <div id="coupon-chart" class="chart-placeholder"></div>
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
        colors: [ "#30a0eb", "#a7b5c5", 'red', 'yellow', '#CD6889','#BA55D3', '#00008B', '#4A708B', '#2F4F4F', '#00FF7F'
        , '#008B45', '#32CD32', '#6E8B3D', '#FFF68F', '#8B7500', '#EEDFCC', '#8B4500', '#292421', '#FF4500', '#EE5C42']
    };

    var dataSales = [];
    var dataJobs = [];
    var dataRating = [];
    var dataCoupon = [];
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
            dataSales.push(series[1]);
            dataSales.push(series[2]);

            $.plot("#sales-chart", dataSales, options);
        }
    }
    function loadChartJobsData(dataurl, element)
    {
        $(element).siblings().removeClass('active');
        $(element).addClass('active');

        dataJobs = [];

        $.ajax({
            url: dataurl,
            type: "GET",
            dataType: "json",
            success: onDataReceived
        });

        function onDataReceived(series) {

            dataJobs.push(series[0]);
            dataJobs.push(series[1]);
            dataJobs.push(series[2]);

            $.plot("#jobs-chart", dataJobs, options);
        }
    }

    function loadChartRatingData(dataurl, element)
    {
        $(element).siblings().removeClass('active');
        $(element).addClass('active');

        dataRating = [];

        $.ajax({
            url: dataurl,
            type: "GET",
            dataType: "json",
            success: onDataReceived
        });

        function onDataReceived(series) {

            dataRating.push(series[0]);

            $.plot("#rating-chart", dataRating, options);
        }
    }

    function loadChartCouponData(dataurl, element)
    {
        $(element).siblings().removeClass('active');
        $(element).addClass('active');

        dataCoupon = [];

        $.ajax({
            url: dataurl,
            type: "GET",
            dataType: "json",
            success: onDataReceived
        });

        function onDataReceived(series) {

            dataCoupon.push(series[0]);

            $.plot("#coupon-chart", dataCoupon, options);
        }
    }

    var dataTeamPaid = [];
    var numOfTeam = {{\App\Models\Team::count()}};
    function loadChartTeamPaidData(dataurl, element)
    {
        $(element).siblings().removeClass('active');
        $(element).addClass('active');

        dataTeamPaid = [];

        $.ajax({
            url: dataurl,
            type: "GET",
            dataType: "json",
            success: onDataReceived
        });

        function onDataReceived(series) {

            for( var i = 0; i < numOfTeam ; i++){
                dataTeamPaid.push(series[i]);
            }

            $.plot("#paid-team-chart", dataTeamPaid, options);
        }
    }

    $(function() {
        $.plot("#sales-chart", dataSales, options);
        $.plot("#jobs-chart", dataJobs, options);
        $.plot("#rating-chart", dataRating, options);
        $.plot("#coupon-chart", dataCoupon, options);
        $.plot("#paid-team-chart", dataTeamPaid, options);

        $("#sales-chart").bind("plothover", onPlotHover);
        $("#jobs-chart").bind("plothover", onPlotHover);
        $("#rating-chart").bind("plothover", onPlotHover);
        $("#coupon-chart").bind("plothover", onPlotHover);
        $("#paid-team-chart").bind("plothover", onPlotHover);

        $("<div id='tooltip'></div>").css({
            position: "absolute",
            display: "none",
            border: "1px solid #fdd",
            padding: "2px",
            "background-color": "#fee",
            opacity: 0.80
        }).appendTo("body");



        $('#btn-group-1 .btn').eq(1).click();
        $('#btn-group-2 .btn').eq(1).click();
        $('#btn-group-3 .btn').eq(1).click();
        $('#btn-group-4 .btn').eq(1).click();
        $('#btn-group-5 .btn').eq(1).click();
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