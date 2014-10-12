<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Team Schedule</h2>

		<p>
            Upcoming jobs for your team:
		</p>

        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Time</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Your Team Amount</th>
                <th>Service Extras</th>
            </tr>
            @foreach($jobs as $job)
            <tr>
                <td>{{$job->take_time}}</td>
                <td>{{$job->address}}</td>
                <td>{{$job->customer_email}}</td>
                <td>{{$job->customer_phone}}</td>
                <td>${{number_format( ($job->amount + $job->giftcard_amount) * $job->team_revenue / 100, 2)}}</td>
                <td>{{$job->getServiceExtrasText()}}</td>
            </tr>
            @endforeach
        </table>

	</body>
</html>