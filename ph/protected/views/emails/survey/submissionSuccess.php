  <?php
  $urlForm=Yii::app()->getRequest()->getBaseUrl(true)."/survey/co/index/id/".$survey["id"];
  $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.header',array("logo"=>@$logo, "url"=>@$urlForm));
  $urlAnswer = Yii::app()->getRequest()->getBaseUrl(true)."/survey/co/answer/id/".$survey["id"]."/user/".$user["id"];
  $urlUser=Yii::app()->getRequest()->getBaseUrl(true)."/#page.type.".Person::COLLECTION.".id.".$user["id"];
  ?>
    <table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;position: relative;display: table;"><tbody><tr style="padding: 0;vertical-align: top;text-align: left;"> <!-- Horizontal Digest Content -->
      <th class="small-12 large-12 columns first" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 8px;">

              <h1 class="text-center" style="color: inherit;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 35px 0px 15px 0px;margin: 0;text-align: center;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 34px;"><?php echo Yii::t("surveys","Congratulations, your project is well submitted on {what}", array("{what}"=>$survey["title"])) ?></h1>
            <table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
            <tr style="padding: 0;vertical-align: top;text-align: left;">
              <th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
                <!--http://localhost:8888/ph/images/betatest.png-->
             <b>
              <h5 style="color: inherit;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 20px;"></h5></b><br>
                 <?php echo Yii::t("surveys", "Hello {who}",array("{who}"=>"<a href='".$urlUser."' target='_blank'>".$user["name"]."</a>")) ?>,<br>
              <br><br>
              <?php echo Yii::t("surveys", "We have succesfully received your application package. Our team will study it during the validation period until the 1rst September 2018<br/><br/>After this period of project's validation, we will send you new instructions to continue your participation to {what}", array("{what}"=>$survey["title"])) ?>
              <br>
              <br>
              <?php echo Yii::t("surveys", "Thank you for your application") ?>.
             
  <?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.footer', array("url"=>@$urlForm, "name"=>@$survey["id"])); ?>