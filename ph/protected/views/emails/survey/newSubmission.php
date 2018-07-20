  <?php
  $urlForm=Yii::app()->getRequest()->getBaseUrl(true)."/survey/co/index/id/".$survey["id"];
  $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.header',array("logo"=>@$logo, "url"=>@$urlForm));
  $urlAnswer = Yii::app()->getRequest()->getBaseUrl(true)."/survey/co/answer/id/".$survey["id"]."/user/".$user["id"];
  $urlUser=Yii::app()->getRequest()->getBaseUrl(true)."/#page.type.".Person::COLLECTION.".id.".$user["id"];
  ?>
    <table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;position: relative;display: table;"><tbody><tr style="padding: 0;vertical-align: top;text-align: left;"> <!-- Horizontal Digest Content -->
      <th class="small-12 large-12 columns first" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 8px;">

              <h1 class="text-center" style="color: inherit;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 35px 0px 15px 0px;margin: 0;text-align: center;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 34px;"><?php echo Yii::t("surveys","A new project has been submitted on {what}", array("{what}"=>$survey["title"])) ?></h1>
            <table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
            <tr style="padding: 0;vertical-align: top;text-align: left;">
              <th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
                <!--http://localhost:8888/ph/images/betatest.png-->
             <b>
              <h5 style="color: inherit;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 20px;"></h5></b><br>
                 <?php echo Yii::t("surveys", "{who} submits a new project",array("{who}"=>"<a href='".$urlUser."' target='_blank'>".$user["name"]."</a>")) ?><br>
              <br><br>
              <?php echo Yii::t("surveys", "As admin of this survey, the next step is to validate this submission.<br>You will find all answers for this appliancation on the following link") ?>
              <br>
              <br>
              <a href="<?php echo $urlAnswer ?>" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;"><?php echo Yii::t("surveys", "See the application package") ?></a>
              <br>
              <br>
              <?php echo Yii::t("mail","If the link doesn&apos;t work, you can copy it in your browser&apos;s address"); ?> :
              <br><div style="word-break: break-all;"><?php echo $urlAnswer ?></div>
             
  <?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.footer', array("url"=>@$urlForm)); ?>
