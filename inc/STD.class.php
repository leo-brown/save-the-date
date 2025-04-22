<?php
class STD {
	private $dataPath = __DIR__ . '/../data/';

	function handle() {
		$uri = trim($_SERVER['REQUEST_URI'], '/');
		$method = $_SERVER['REQUEST_METHOD'];

		if (strpos($uri, 'admin') === 0) {
			$this->handleAdmin($_GET['user'] ?? '');
			return;
		}

		$code = explode('?', $uri)[0];
		if (preg_match('/^[a-f0-9]{4}$/', $code)) {
			$this->handleGuest($code, $method);
			return;
		}

		http_response_code(404);
		echo "Not Found";
	}

	private function handleAdmin($userId) {
		$users = $this->loadJson('users');
		if (!in_array($userId, array_column($users, 'id'))) {
			echo "Invalid user.";
			return;
		}

		$guests = $this->loadJson('guests');
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST['delete'])) {
				$guests = array_filter($guests, function($g) {
					return $g['code'] !== $_POST['delete'];
				});
				$this->saveJson('guests', array_values($guests));
				header("Location: /admin?user=$userId");
				exit;
			} elseif (isset($_POST['first_name'])) {
				$guests[] = [
					'code' => substr(bin2hex(random_bytes(2)), 0, 4),
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'email' => $_POST['email'],
					'group' => $_POST['group']
				];
				$this->saveJson('guests', $guests);
				header("Location: /admin?user=$userId");
				exit;
			}
		}

		echo "<h1>Admin Panel</h1>";
		echo "<table border='1' cellpadding='6' cellspacing='0'>";
		echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Group</th><th>Extra</th><th>Code</th><th>Delete</th></tr>";
		foreach ($guests as $g) {
			echo "<tr>";
			echo "<td>" . htmlspecialchars($g['first_name']) . "</td>";
			echo "<td>" . htmlspecialchars($g['last_name']) . "</td>";
			echo "<td>" . htmlspecialchars($g['email']) . "</td>";
			echo "<td>" . htmlspecialchars($g['group']) . "</td>";

			$extras = [];
			foreach ($g as $key => $value) {
				if (!in_array($key, ['code', 'first_name', 'last_name', 'email', 'group'])) {
					$extras[] = htmlspecialchars($key) . ': ' . htmlspecialchars($value);
				}
			}
			echo "<td>" . implode("<br>", $extras) . "</td>";
			echo "<td>" . htmlspecialchars($g['code']) . "</td>";
			echo "<td><form method='post'><button name='delete' value='" . htmlspecialchars($g['code']) . "'>Delete</button></form></td>";
			echo "</tr>";
		}
		echo "</table>";

		echo "<h2>Add Guest</h2>";
		echo "<form method='post'>
			<input name='first_name' placeholder='First Name'>
			<input name='last_name' placeholder='Last Name'>
			<input name='email' placeholder='Email'>
			<select name='group'>
				<option value='wedding'>Wedding</option>
				<option value='reception-only'>Reception Only</option>
			</select>
			<button type='submit'>Add</button>
		</form>";
	}

	private function handleGuest($code, $method) {
		$guests = $this->loadJson('guests');
		$groups = $this->loadJson('groups');
		$guest = null;
		foreach ($guests as &$g) {
			if ($g['code'] === $code) {
				$guest = &$g;
				break;
			}
		}

		if (!$guest) {
			echo "Invalid code.";
			return;
		}

		$groupPage = null;
		foreach ($groups as $group) {
			if ($group['name'] === $guest['group']) {
				$groupPage = $group['page'];
				break;
			}
		}

		if ($method === 'POST') {
			foreach ($_POST as $key => $value) {
				$guest[$key] = $value;
			}
			$this->saveJson('guests', $guests);
			include(__DIR__ . '/../pages/thank-you.php');
			return;
		}

		if ($groupPage && file_exists(__DIR__ . '/../pages/' . $groupPage . '.php')) {
			$guest_code = $code;
			include(__DIR__ . '/../pages/' . $groupPage . '.php');
		} else {
			echo "<h1>Hello {$guest['first_name']}!</h1>";
			echo "<p>You are invited to the {$guest['group']}.</p>";
		}
	}

	private function loadJson($file) {
		$path = $this->dataPath . $file . '.json';
		if (!file_exists($path)) return [];
		return json_decode(file_get_contents($path), true);
	}

	private function saveJson($file, $data) {
		$path = $this->dataPath . $file . '.json';
		file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT));
	}
}
