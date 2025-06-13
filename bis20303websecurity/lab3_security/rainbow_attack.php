<?php
$target_hash = "5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8"; // SHA1 of "password"
$wordlist = file("common-passwords.txt", FILE_IGNORE_NEW_LINES);

echo "<h3>Rainbow Attack Checker</h3>";

$found = false;

foreach ($wordlist as $word) {
    if (sha1($word) === $target_hash) {
        echo "Match found: <strong>$word</strong><br>";
        $found = true;
        break;
    }
}

if (!$found) {
    echo "Not match found in wordlist.";
}
?>