<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="/dashboard/assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="/dashboard/DCIM/site/logo_square.png">

<title>
  <?PHP
  if (isset($page_title)) {
    echo $page_title;
  } else if (defined("page_title")) {
    echo constant("page_title") . " | " . constant("site_title");
  }
  ?>
</title>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 