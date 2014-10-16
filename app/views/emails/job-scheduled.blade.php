<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
    <h2>Notification for job scheduled</h2>
    <p>Hi {{$job->customer_name}},</p>
    <p>
        We are just checking in to let you know that your MaidSavvy cleaning service is scheduled for tomorrow.
    </p>

    <p>We have your information listed below as:</p>

    @include('emails.job.job-info')
	
    <p>If there are any changes that need to be made, please let us know!</p>
	</body>
</html>
