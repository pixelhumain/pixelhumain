<title><?php echo ($this->pageTitle) ? CHtml::encode($this->pageTitle) : "set a pageTitle"; ?></title>
<meta charset="utf-8" />
<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<meta content="<?php echo ($this->keywords) ? CHtml::encode($this->keywords):""; ?>" name="keywords" />
<meta content="<?php echo ($this->description) ? CHtml::encode($this->description):""; ?>" name="description" />
<meta content="Human Pixel Community" name="author" />

<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-25531131-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-25531131-1');
</script>
