<?php

// Configuration
$username = 'rianasantatra'; // replace using your github user account
$apiUrl = "https://api.github.com/users/$username/events/public";

// Initialisation de cURL
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'PHP Script');
$response = curl_exec($ch);
curl_close($ch);

// fetch response
$events = json_decode($response, true);

if (is_array($events)) {
    echo "<h2>Recent activity of user $username :</h2>";
    echo "<ul>";
    foreach ($events as $event) {
        $type = $event['type'];
        $repo = $event['repo']['name'];
        $date = date('Y-m-d H:i:s', strtotime($event['created_at']));
        echo "<li><strong>$type</strong> sur <em>$repo</em> à $date</li>";
    }
    echo "</ul>";
} else {
    echo "Empty data.";
}

