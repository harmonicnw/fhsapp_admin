<?php
header('Content-Type: application/json');
header("access-control-allow-origin: *");
echo $_GET['callback']. '(';
?>
[{"id":"127","first_name":"Griffin","last_name":"Drake","room_number":"23","bio":"he's pretty slick","other_roles":"slick club adviser","other_info":"never available","website_link":"slickers.com","facebook":"facebook.com\/slickers","twitter":"twitter.com\/slickers","wordpress_blog":"slickers.wordpress.org","image_link":"http:\/\/upload.wikimedia.org\/wikipedia\/commons\/3\/33\/Nicolas_Cage_2011_CC.jpg"},{"id":"138","first_name":"Gruffin","last_name":"Drank","room_number":"12","bio":"extra john","other_roles":"john's extra amounts","other_info":"none","website_link":"john.net","facebook":"facebook.com\/john","twitter":"twitter.com\/johntheextra","wordpress_blog":"john.wordpress.org","image_link":"http:\/\/upload.wikimedia.org\/wikipedia\/commons\/3\/33\/Nicolas_Cage_2011_CC.jpg"}]
<?php
echo ')';
?>
