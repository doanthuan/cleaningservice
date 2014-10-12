<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>MaidSavvy Password Reset Request</h2>
		<p>Hi,<br>
			Thank you for using MaidSavvy.com for you cleaning needs.
		</p>
		<div>
			<p>To reset your password, complete click the link and enter your new password: {{ URL::to('password/reset', array($token)) }}.</p>
			<p>To ensure customer safety, this link will expire in {{ Config::get('auth.reminder.expire', 60) }} minutes.</p>
		</div>
	</body>
</html>
