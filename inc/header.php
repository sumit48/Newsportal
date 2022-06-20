<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="keywords" content="<?php echo isset($_meta, $_meta['keywords']) ? $_meta['keywords'] : SITE_KEYWORDS;?>">
    <meta name="description" content="<?php echo isset($_meta, $_meta['description']) ? $_meta['description'] : SITE_DESCRIPTION;?>">
    
    <meta property="og:title" content="<?php echo isset($_meta, $_meta['title']) ? $_meta['title'] : CMS_SITE_TITLE;?>">
    <meta property="og:description" content="<?php echo isset($_meta, $_meta['description']) ? $_meta['description'] : SITE_DESCRIPTION;?>">
    <meta property="og:url" content="<?php echo getCurrentUrl()?>">
    <meta property="og:image" content="<?php echo isset($_meta, $_meta['image']) ? $_meta['image'] : IMAGES_URL.'/sunaulokhabar.png' ?>">
    <meta property="og:type" content="article">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo CSS_URL?>/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL?>/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL?>/css/all.min.css">

    <title><?php echo isset($_meta, $_meta['title']) ? $_meta['title'] : CMS_SITE_TITLE;?>, News Portal</title>
    
</head>
<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0&appId=766110073876661&autoLogAppEvents=1"></script>
