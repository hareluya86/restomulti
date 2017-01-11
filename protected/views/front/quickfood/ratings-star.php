
<?php
for ($i = 0; $i < $rating; $i++) {
    echo '<i class="icon_star voted"></i>';
}
for ($i = 0; $i < 5 - $rating; $i++) {
    echo '<i class="icon_star"></i>';
}
?>