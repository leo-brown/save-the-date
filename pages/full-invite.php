<section id="cover" class="cover-section decorated">
	<div class="cover-content cover-split">
		<div class="cover-top">
			<h1>Save The Date</h1>
			<h2>Lydia &amp; Leo</h2>
		</div>
		<div class="cover-bottom">
			<p><?= htmlspecialchars($guest['first_name']) ?>, you’re invited to our wedding day!</p>
		</div>
	</div>
</section>

<section id="details">
	<h2>Details</h2>
	<p><strong>Where</strong><br />Bartholomew Square, Brighton BN1 1JA</p>
	<p><strong>When</strong><br />13 August 2026</p>
	<p><strong>Dress Code</strong><br /> Garden Party</p>
</section>

<section id="schedule">
	<h2>The Day</h2>
	<p><b>2:45 PM</b> <br /> Ceremony (3pm)</p>
	<p><b>4:30 PM</b> <br /> Drinks on the lawn (Black Lion Pub)</p>
	<p><b>6:00 PM</b> <br /> Dinner @ Terre a Terre</p>
	<p><b>9:00 PM</b> <br /> Beers on the beach</p>
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
