<section id="cover" class="decorated">
	<h1>Save The Date</h1>
	<h2>Lydia & Leo</h2>
	<p><?= htmlspecialchars($guest['first_name']) ?>, you’re invited to our wedding day!</p>
</section>

<section id="details">
	<h2>Details</h2>
	<p><strong>Location:</strong>Bartholomew Square, Brighton BN1 1JA</p>
	<p><strong>Date:</strong> 13 August 2026</p>
	<p><strong>Dress Code:</strong> Garden Party</p>
</section>

<section id="schedule">
	<h2>The Day</h2>
	<p>2:45 PM – Ceremony (3pm)</p>
	<p>4:30 PM - Drinks on the lawn (Black Lion Pub)</p>
	<p>6:00 PM – Dinner @ Terre a Terre</p>
	<p>9:00 PM – Beers on the beach</p>
</section>

<section id="rsvp" class="decorated">
	<h2>RSVP</h2>
	<form method="post">
		<?php foreach ($groupFields as $field): ?>
			<?php if ($field === 'number_of_guests'): ?>
				<label>Number of Guests:
					<input type="number" name="number_of_guests" value="<?= htmlspecialchars($guest['number_of_guests'] ?? '') ?>">
				</label>
			<?php elseif ($field === 'dietary_preference'): ?>
				<label>Dietary Preference:
					<input type="text" name="dietary_preference" value="<?= htmlspecialchars($guest['dietary_preference'] ?? '') ?>">
				</label>
			<?php else: ?>
				<label><?= ucwords(str_replace('_', ' ', $field)) ?>:
					<input type="text" name="<?= $field ?>" value="<?= htmlspecialchars($guest[$field] ?? '') ?>">
				</label>
			<?php endif; ?>
		<?php endforeach; ?>

		<button type="submit">Submit RSVP</button>
	</form>
</section>
