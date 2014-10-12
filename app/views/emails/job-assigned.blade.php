<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Job Assigned</h2>
        <p>Hi {{$teamName}} Team</p>
        <p>
            One job has been assigned to your team. The information listed below as:
        </p>

        @include('emails.job.job-info')

        <div>Your Team Amount: ${{number_format(($job->amount + $job->giftcard_amount) * $job->team_revenue / 100, 2)}}</div>

	</body>
</html>
