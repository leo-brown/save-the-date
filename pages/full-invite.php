<!DOCTYPE html>
<html>
<head>
	<title>You're Invited</title>
	<link rel="stylesheet" href="/style.css">
</head>
<body>
	<h1>Hello <?= htmlspecialchars($guest['first_name']) ?>!</h1>
	<p>You are invited to the <?= htmlspecialchars($guest['group']) ?>.</p>

	<form method="post">
		<label>Number of Guests:
			<input type="number" name="number_of_guests" value="<?= htmlspecialchars($guest['number_of_guests'] ?? '') ?>">
		</label><br>

		<label>Dietary Preference:
			<input type="text" name="dietary_preference" value="<?= htmlspecialchars($guest['dietary_preference'] ?? '') ?>">
		</label><br>

		<button type="submit">RSVP</button>
	</form>
</body>
</html>

