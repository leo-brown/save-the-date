<section id="cover">
	<h1>Save The Date</h1>
	<h2>Lydia & Leo</h2>
	<p><?= htmlspecialchars($guest['first_name']) ?>, you’re invited to our wedding day!</p>
</section>

<section id="details">
	<h2>Details</h2>
	<p><strong>Location:</strong> Queen’s Park, Brighton</p>
	<p><strong>Date:</strong> 14 August 2026</p>
	<p><strong>Dress Code:</strong> Garden Party</p>
</section>

<section id="schedule">
	<h2>The Day</h2>
	<p>3:00 PM – Ceremony</p>
	<p>4:30 PM – Cocktails & Photos</p>
	<p>6:00 PM – Dinner & Toasts</p>
	<p>8:00 PM – Dancing & Cake</p>
</section>

<section id="rsvp">
	<h2>RSVP</h2>
	<form method="post">
		<label>Number of Guests:
			<input type="number" name="number_of_guests" value="<?= htmlspecialchars($guest['number_of_guests'] ?? '') ?>">
		</label>

		<label>Dietary Preference:
			<input type="text" name="dietary_preference" value="<?= htmlspecialchars($guest['dietary_preference'] ?? '') ?>">
		</label>

		<button type="submit">Submit RSVP</button>
	</form>
</section>

