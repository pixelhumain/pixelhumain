<div id="filters-nav" class="col-xs-12">
  <ul id="filters-nav-list" class="no-padding no-margin">
      <li class="dropdown dropdown-tags">
          <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left" data-label-xs="tags" type="button" id="dropdownTags" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
        title="<?php echo Yii::t("common","Tags") ?>" alt="<?php echo Yii::t("common","Tags") ?>"><?php echo Yii::t("common","Tags") ?> <i class="fa fa-angle-down"></i></a>
          <div class="dropdown-menu arrow_box hidden-xs" aria-labelledby="dropdownTags">
              <div class="col-xs-12 no-padding margin-bottom-5">
                  <div class="form-group filterstags col-md-8 col-sm-8 col-xs-10 no-margin no-padding">
                      <input id="tagsFilterInput" type="" data-type="select2" name="tags" placeholder="#Tags" value="" style="width:100%;">       
                  </div>
                  <button class="btn btn-default letter-green col-md-2 col-sm-2 col-xs-1 btn-tags-start-search no-margin padding-10"><i class="fa fa-arrow-circle-right"></i> <span class="hidden-xs"><?php echo Yii::t("common", "Validate") ?></span></button>
                  <button class="btn btn-default letter-blue col-md-2 col-sm-2 btn-tags-refresh no-margin padding-10"><i class="fa fa-refresh"></i> <span class="hidden-xs"><?php echo Yii::t("common", "Refresh") ?></span></button>
              </div>
               <?php $filliaireCategories = CO2::getContextList("filliaireCategories"); 
              foreach ($filliaireCategories as $key => $cat) { 
                  if(is_array($cat)) { ?>
                    <div class="col-md-2 col-sm-2 col-xs-3 no-padding">
                      <button class="btn btn-default col-md-12 col-sm-12 col-xs-12 padding-10 bold text-dark elipsis margin-bottom-5 btn-select-filliaire" 
                              data-fkey="<?php echo $key; ?>"
                              style="border-radius:0px; border-color: transparent; text-transform: uppercase;" 
                              data-keycat="<?php echo $cat["name"]; ?>">
                        <i class="fa <?php echo $cat["icon"]; ?> fa-2x"></i><br>
                        <?php echo Yii::t("category", $cat["name"]); ?>
                      </button>
                    </div>
              <?php } 
              } ?>
          </div>
      </li>
      <li class="dropdown dropdown-types">
          <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left"  type="button" id="dropdownThematics" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-label-xs="types" data-toggle="tooltip" data-placement="bottom" 
        title="<?php echo Yii::t("common","Choose a type") ?>" alt="<?php echo Yii::t("common","type") ?>"><?php echo Yii::t("common","Type") ?> <i class="fa fa-angle-down"></i></a>
          <div class="dropdown-menu arrow_box hidden-xs" style="overflow-y: auto;" aria-labelledby="dropdownTypes">
          </div>
      </li>
      <li class="dropdown dropdown-sources">
          <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left"  data-label-xs="sources" type="button" id="dropdownSources" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
        title="<?php echo Yii::t("common","Select a source of data") ?>" alt="<?php echo Yii::t("common","Select a source of data") ?>"><?php echo Yii::t("common","Source data") ?> <i class="fa fa-angle-down"></i></a>
          <div class="dropdown-menu arrow_box hidden-xs" aria-labelledby="dropdownSources">
          </div>
      </li>
      <li class="dropdown dropdown-section">
          <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left"  data-label-xs="section" type="button" id="dropdownSection" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
        title="<?php echo Yii::t("common","Choose a section") ?>" alt="<?php echo Yii::t("common","Choose a section") ?>"><?php echo Yii::t("common","Section") ?> <i class="fa fa-angle-down"></i></a>
          <div class="dropdown-menu arrow_box hidden-xs" aria-labelledby="dropdownSections">
          </div>
      </li>
      <li class="dropdown dropdown-category">
          <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left" data-label-xs="category" type="button" id="dropdownCategory" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
        title="<?php echo Yii::t("common","Choose a category") ?>" alt="<?php echo Yii::t("common","Choose a category") ?>"><?php echo Yii::t("common","Category") ?> <i class="fa fa-angle-down"></i></a>
          <div class="dropdown-menu arrow_box hidden-xs" aria-labelledby="dropdownCategory" style="overflow-y: auto;">
          </div>
      </li>
      <li class="dropdown dropdown-price">
          <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left" data-label-xs="price" type="button" id="dropdownPrice" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
        title="<?php echo Yii::t("common","Range prices") ?>" alt="<?php echo Yii::t("common","Range prices") ?>"><?php echo Yii::t("common","Price") ?> <i class="fa fa-angle-down"></i></a>
          <div class="dropdown-menu arrow_box hidden-xs" aria-labelledby="dropdownPrice">
               <div class="form-group col-md-4 col-sm-4 col-xs-6 divPriceMin">
                  <label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="sectionBtn">
                    <i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Min price") ?>
                  </label>
                  <input type="text" id="priceMin" name="priceMin" class="form-control" 
                         placeholder="<?php echo Yii::t("common","Min price") ?>"/>
              </div>

                <div class="form-group col-md-4 col-sm-4 col-xs-6 divPriceMax">
                  <label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="sectionBtn">
                      <i class="fa fa-angle-down"></i>
                      <?php echo Yii::t("common","Max price") ?>
                  </label>
                  <input type="text" id="priceMax" name="priceMax" class="form-control col-md-5" placeholder="<?php echo Yii::t("common","Max price") ?>"/>
                </div>
                <div class="form-group col-md-4 col-sm-4 col-xs-12 divMoney">
                  <label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="sectionBtn">
                    <i class="fa fa-money"></i> <span class="hidden-xs hidden-sm"><?php echo Yii::t("common","Money"); ?></span>
                  </label>
                  <select class="form-control" name="devise" id="devise" style="">
                  <?php 
                    //$params = CO2::getThemeParams();
                    $devises = @$params["devises"]; ?>
                    <?php if(@$devises){ 
                      foreach($devises as $key => $devise){ ?>
                      <option class="bold" value="<?php echo $key; ?>"><?php echo Yii::t("common",$devise); ?></option>
                    <?php } } ?>
                  </select>
                </div>
              <div class="form-group col-md-12 col-sm-12 col-xs-12 margin-top-10 text-center">
              <button class="btn btn-link bg-white text-azure margin-top-15 btn-price-filter font-montserrat" data-key="reset" data-type="classifieds">
                  <i class="fa fa-refresh"></i> <span class=""><?php echo Yii::t("common","Refresh") ?></span>
                </button>
                <button class="btn btn-link bg-azure margin-top-15 btn-price-filter font-montserrat" data-type="classifieds">
                  <i class="fa fa-search"></i> <span class=""><?php echo Yii::t("common","Search") ?></span>
                </button>
              </div>
          </div>
      </li>
     
  </ul>
  <div class="visible-xs dropdown-xs-view">
      <div class="dropdown dropdown-tags">
          <div class="dropdown-menu arrow_box" aria-labelledby="dropdownTags">
              <div class="col-xs-12 no-padding margin-bottom-5">
                  <div class="form-group filterstags col-md-8 col-sm-8 col-xs-10 no-margin no-padding">
                      <input id="tagsFilterInput" type="" data-type="select2" name="tags" placeholder="#Tags" value="" style="width:100%;">       
                  </div>
                  <button class="btn btn-default letter-green col-md-2 col-sm-2 col-xs-1 btn-tags-start-search no-margin padding-10"><i class="fa fa-arrow-circle-right"></i> <span class="hidden-xs"><?php echo Yii::t("common", "Validate") ?></span></button>
                  <button class="btn btn-default letter-blue col-md-2 col-sm-2 btn-tags-refresh no-margin padding-10"><i class="fa fa-refresh"></i> <span class="hidden-xs"><?php echo Yii::t("common", "Refresh") ?></span></button>
              </div>
               <?php $filliaireCategories = CO2::getContextList("filliaireCategories"); 
              foreach ($filliaireCategories as $key => $cat) { 
                  if(is_array($cat)) { ?>
                    <div class="col-md-2 col-sm-2 col-xs-3 no-padding">
                      <button class="btn btn-default col-md-12 col-sm-12 col-xs-12 padding-10 bold text-dark elipsis margin-bottom-5 btn-select-filliaire" 
                              data-fkey="<?php echo $key; ?>"
                              style="border-radius:0px; border-color: transparent; text-transform: uppercase;" 
                              data-keycat="<?php echo $cat["name"]; ?>">
                        <i class="fa <?php echo $cat["icon"]; ?> fa-2x"></i><br>
                        <?php echo Yii::t("category", $cat["name"]); ?>
                      </button>
                    </div>
              <?php } 
              } ?>
          </div>
      </div>
      <div class="dropdown dropdown-types">
          <div class="dropdown-menu arrow_box" aria-labelledby="dropdownTypes">
          </div>
      </div>
      <div class="dropdown dropdown-sources">
          <div class="dropdown-menu arrow_box" aria-labelledby="dropdownSources">
          </div>
      </div>
      <div class="dropdown dropdown-section">
          <div class="dropdown-menu arrow_box" aria-labelledby="dropdownSections">
          </div>
      </div>
      <div class="dropdown dropdown-category">
          <div class="dropdown-menu arrow_box" aria-labelledby="dropdownCategory">
          </div>
      </div>
      <div class="dropdown dropdown-price">
          <div class="dropdown-menu arrow_box" aria-labelledby="dropdownPrice">
               <div class="form-group col-md-4 col-sm-4 col-xs-6 divPriceMin">
                  <label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="sectionBtn">
                    <i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Min price") ?>
                  </label>
                  <input type="text" id="priceMin" name="priceMin" class="form-control" 
                         placeholder="<?php echo Yii::t("common","Min price") ?>"/>
              </div>

                <div class="form-group col-md-4 col-sm-4 col-xs-6 divPriceMax">
                  <label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="sectionBtn">
                      <i class="fa fa-angle-down"></i>
                      <?php echo Yii::t("common","Max price") ?>
                  </label>
                  <input type="text" id="priceMax" name="priceMax" class="form-control col-md-5" placeholder="<?php echo Yii::t("common","Max price") ?>"/>
                </div>
                <div class="form-group col-md-4 col-sm-4 col-xs-12 divMoney">
                  <label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="sectionBtn">
                    <i class="fa fa-money"></i> <span class="hidden-xs hidden-sm"><?php echo Yii::t("common","Money"); ?></span>
                  </label>
                  <select class="form-control" name="devise" id="devise" style="">
                  <?php 
                    $params = CO2::getThemeParams();
                    $devises = $params["devises"]; ?>
                    <?php if(@$devises){ 
                      foreach($devises as $key => $devise){ ?>
                      <option class="bold" value="<?php echo $key; ?>"><?php echo Yii::t("common",$devise); ?></option>
                    <?php } } ?>
                  </select>
                </div>
              <div class="form-group col-md-12 col-sm-12 col-xs-12 margin-top-10 text-center">
              <button class="btn btn-link bg-white text-azure margin-top-15 btn-price-filter font-montserrat" data-key="reset" data-type="classifieds">
                  <i class="fa fa-refresh"></i> <span class=""><?php echo Yii::t("common","Refresh") ?></span>
                </button>
                <button class="btn btn-link bg-azure margin-top-15 btn-price-filter font-montserrat" data-type="classifieds">
                  <i class="fa fa-search"></i> <span class=""><?php echo Yii::t("common","Search") ?></span>
                </button>
              </div>
          </div>
      </div>
  </div>
</div>