
<?php
for ($i = 0; $i < floor($rating); $i++) {
    echo '<i class="icon_star voted"></i>';
}
for ($i = 0; $i < 5 - floor($rating); $i++) {
    echo '<i class="icon_star"></i>';
}
?>