<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Hi, {{ $data['username'] }}</h2>
		<h3>Welcome to {{ Settings::find(1)->sitename }}</h3>

		<div>
			Your sign up details are below:
		</div><br>
		<div>E-mail : {{ $data['email'] }}</div>
		<div>Username : {{ $data['username'] }}</div><br><br>
		<hr>
		<span>Regards,</span><br><br>
		<span>{{ Settings::find(1)->sitename }} Team</span>
	</body>
</html>