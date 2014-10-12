<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
    <h2>Notification for job scheduled</h2>
    <p>Hi {{$job->customer_name}}</p>
    <p>
        Your MaidSavvy cleaning service is scheduled for tomorrow.
    </p>

    <p>We have your information listed below as:</p>

    @include('emails.job.job-info')

	</body>
</html>
