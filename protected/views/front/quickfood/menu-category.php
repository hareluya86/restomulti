
<?php if (is_array($menu) && count($menu) >= 1): ?>
    <ul id="cat_nav">
        <?php foreach ($menu as $val): ?>
            <li>
                <a href="#<?php echo $val['category_id'] ?>"
                   data-id="cat-<?php echo $val['category_id'] ?>">
                    <?php echo qTranslate($val['category_name'], 'category_name', $val) ?>
                    <span>(<?php echo is_array($val['item']) ? count($val['item']) : '0'; ?>)</span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>