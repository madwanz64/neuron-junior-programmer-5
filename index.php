<?php
$data = <<<'EOD'
X, -9\\\10\100\-5\\\0\\\\, A
Y, \\13\\1\, B
Z, \\\5\\\-3\\2\\\800, C
EOD;

header('Content-Type: text/plain');

$lines = explode("\r\n", $data);

$results = [];
foreach ($lines as $line) {
	[$start, $numbers, $end] = explode(', ', $line);
	$numbers = preg_replace(["/^\\\\+|\\\\+$/", "/\\\\+/"], ["", "\\"], $numbers);
	$numbers = explode("\\", $numbers);
	sort($numbers);
	
	foreach ($numbers as $j => $number) {
		$results[] = [$start, $number, $end, $j+1];
	}
}

array_multisort(array_column($results, 1), SORT_ASC, $results);

foreach ($results as $result) {
	echo implode(", ", $result) . "\n";
}