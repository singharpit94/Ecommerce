 <?php
 $url = "http://www.craigslist.org/about/sites";
$html = file_get_contents( $url );
echo "<pre>";
foreach ( $html->find ( 'a' ) as $element ) {
    $link = $element->href;
    $link = ltrim ( $link, "/" );

    if (!preg_match ( "/http/i", $link )) {
        $link = $url . $link;
    }
    echo $link . PHP_EOL;
    flush ();
}
 ?>