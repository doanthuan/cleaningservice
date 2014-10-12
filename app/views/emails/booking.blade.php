<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>We've Received Your Booking</h2>
        <p>Hi {{$job->customer_name}}</p>
        <p>
            Thank you for choosing {{$companyName}} for your home cleaning needs. Your request for service has been sent
            to the {{$companyName}} Customer Happiness Team. After checking availability, we'll be in touch with you shortly
            to finalize your booking.
        </p>

        <p>Please note: This is NOT a confirmation email.</p>

        <p>We have your information listed below as:</p>

        @include('emails.job.job-info')

        @if(!empty($password))
		<p>
			Please use this password to login your account: {{$password}}
		</p>
        @endif
        <p>
        	Please login using your email address and password at: <a href="http://maidsavvy.com/customer/login/">http://maidsavvy.com/customer/login/</a>
        </p>
	</body>
</html>