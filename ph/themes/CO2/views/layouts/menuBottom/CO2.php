
<div class="toolbar-bottom shadow2 font-montserrat">

    <button class="btn btn-default lbh tooltips" data-hash="#home"
            data-placement="top" data-original-title="Page d'accueil">
        <i class="fa fa-home" style="font-size: 19px;"></i>
    </button>
    <button class="btn btn-default letter-green" data-target="#dash-create-modal" data-toggle="modal">
        <i class="fa fa-plus-circle"></i> <span class="hidden-xs"><?php echo Yii::t("common", "add") ?></span>
    </button>
    <button class="btn btn-default letter-blue btn-show-map">
        <i class="fa fa-map-marker"></i> <span class="hidden-xs"><?php echo Yii::t("common", "map") ?></span>
    </button>
    <!-- <button class="btn btn-default">
        <i class="fa fa-comments"></i> messagerie
    </button>
    <button class="btn btn-default">
        <i class="fa fa-connectdevelop"></i> contacts
    </button> -->
    <!-- <button class="btn btn-default">
        <i class="fa fa-cogs"></i> 
    </button> -->
    <a href="https://www.helloasso.com/associations/open-atlas/collectes/communecter/don" target="_blank"
            data-placement="top" data-original-title="Participer au financement du réseau"
            class="btn btn-default letter-pink tooltips">
            <!-- <i class="fa fa-chain" data-alt="eye-dropper"></i>  -->
            <i class="fa fa-gift"></i> <span class="hidden-xs"><?php echo Yii::t("common", "co-tribuer") ?></span>
    </a>

    <a class="btn btn-default tooltips lbh" href="#info.p.stats"
             data-placement="top" data-original-title="Statistiques : visualiser la fréquentation quotidienne du réseau">
        <i class="fa fa-bar-chart"></i>
    </a>
    <a class="btn btn-default tooltips lbh" href="#coBugs"
             data-placement="top" data-original-title="Déclarer un bug">
        <i class="fa fa-bug"></i>
    </a>
    <a class="btn btn-default lbh tooltips" href="#default.view.page.index.dir.docs" 
             data-placement="top" data-original-title="Documentation : en savoir + sur Communecter !">
        <i class="fa fa-book"></i>
    </a>

    <button class="btn btn-default tooltips letter-red" id="show-bottom-app">
        <i class="fa fa-bars"></i>
    </button>

    <button class="btn btn-default bg-blue-k" style="width:50px;" onclick="KScrollTo('.main-container')">
        <i class="fa fa-chevron-up"></i>
    </button>

</div>

<div class="toolbar-bottom-apps shadow2 font-montserrat hidden">

    <a class="btn btn-default lbh letter-red" href="#search">
        <i class="fa fa-search"></i> 
        <span class="hidden-xs"><?php echo Yii::t("common", "Search") ?></span> 
    </a>
    <a class="btn btn-default lbh letter-red" href="#live">
        <i class="fa fa-newspaper-o"></i> 
        <span class="hidden-xs"><?php echo Yii::t("common", "In live") ?></span> 
    </a>
    <a class="btn btn-default lbh letter-red" href="#agenda">
        <i class="fa fa-calendar"></i> 
        <span class="hidden-xs"><?php echo Yii::t("common", "Agenda") ?></span> 
    </a>
    <a class="btn btn-default lbh letter-red" href="#annonces">
        <i class="fa fa-bullhorn"></i> 
        <span class="hidden-xs"><?php echo Yii::t("common", "Market place") ?></span> 
    </a>
    <a class="btn btn-default lbh letter-red" href="#ressources">
        <i class="fa fa-cubes"></i> 
        <span class="hidden-xs"><?php echo Yii::t("common", "Sharing") ?></span> 
    </a>

</div>