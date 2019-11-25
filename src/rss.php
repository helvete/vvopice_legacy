<?php

include "pdo_connect.php";

$queryString = '
	SELECT time, name, text
	FROM forum
	ORDER BY time DESC
	LIMIT 30
';
$query = $pdo->prepare($queryString);
$query->execute(array());

header('Content-Type: application/rss+xml;charset=UTF-8');

$result = $query->fetchAll(PDO::FETCH_ASSOC);
echo <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<atom:link href="http://vv.bahno.net/?rss=1" rel="self" type="application/rss+xml" />
		<title>vvopice vv.bahno.net</title>
		<link>http://vv.bahno.net</link>
		<description>vvopice smlouvaji piva, jen tak pokrikuji a nebo se stouraji v ritnich otvorech.</description>
XML;

foreach ($result as $postData) {
	$time = strtotime($postData['time']);
	$time = date('d.m.Y H:i:s', $time);
	$name = htmlspecialchars($postData['name'], ENT_QUOTES, 'UTF-8');
	$txt = str_replace('&lt;br /&gt;', "\r\n", $postData['text']);
	$text = htmlspecialchars($txt, ENT_QUOTES, 'UTF-8');
	echo <<<XML

		<item>
			<guid isPermaLink="false">$time</guid>
			<title>$name</title>
			<link>http://vv.bahno.net</link>
			<description>$text</description>
			<content:encoded xmlns:content="http://purl.org/rss/1.0/modules/content/">
				<![CDATA[
					$text
				]]>
			</content:encoded>
		</item>
XML;
}

echo <<<XML

	</channel>
</rss>
XML;

exit();
