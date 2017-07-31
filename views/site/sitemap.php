<?php
echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
?>

<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
       http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <?php foreach ($categories as $item) { ?>
    <url>
        <loc><?= \yii\helpers\Url::to(['category/view', 'id' => $item->id], true) ?></loc>
        <priority>1.00</priority>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>Daily</changefreq>
    </url>
    <?php } ?>

    <?php foreach ($products as $item) { ?>
        <url>
            <loc><?= \yii\helpers\Url::to(['product/view', 'id' => $item->id], true) ?></loc>
            <priority>0.8</priority>
            <lastmod><?= date('Y-m-d') ?></lastmod>
            <changefreq>Daily</changefreq>
        </url>
    <?php } ?>

    <?php foreach ($help as $item) { ?>
        <url>
            <loc><?= \yii\helpers\Url::to(['cms/default/page', 'id' => $item->id, 'surname' => $item->surname], true) ?></loc>
            <priority>0.8</priority>
            <lastmod><?= date('Y-m-d') ?></lastmod>
            <changefreq>Daily</changefreq>
        </url>
    <?php } ?>

    <?php foreach ($blogs as $item) { ?>
        <url>
            <loc><?= \yii\helpers\Url::to(['blog/default/view', 'id' => $item->id], true) ?></loc>
            <priority>0.8</priority>
            <lastmod><?= date('Y-m-d') ?></lastmod>
            <changefreq>Daily</changefreq>
        </url>
    <?php } ?>
    
    <?php foreach ($blogsCatalogs as $item) { ?>
        <url>
            <loc><?= \yii\helpers\Url::to(['blog/default/catalog', 'id' => $item->id], true) ?></loc>
            <priority>0.8</priority>
            <lastmod><?= date('Y-m-d') ?></lastmod>
            <changefreq>Daily</changefreq>
        </url>
    <?php } ?>
    
    <?php foreach ($couriers as $item) { ?>
        <url>
            <loc><?= \yii\helpers\Url::to(['courier/default/view', 'id' => $item->id], true) ?></loc>
            <priority>0.8</priority>
            <lastmod><?= date('Y-m-d') ?></lastmod>
            <changefreq>Daily</changefreq>
        </url>
    <?php } ?>        

</urlset>
