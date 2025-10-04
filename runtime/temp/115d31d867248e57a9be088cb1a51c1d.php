<?php /*a:3:{s:48:"../public/clientarea/template/pc/default/404.php";i:1758278322;s:51:"../public/clientarea/template/pc/default/header.php";i:1758278322;s:51:"../public/clientarea/template/pc/default/footer.php";i:1758278322;}*/ ?>
<!DOCTYPE html>
<html lang="en" theme="<?php echo htmlentities($clientarea_theme_color); ?>" id="addons_js" addons_js='<?php echo json_encode($addons); ?>'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title></title>
    <link rel="icon" href="/favicon.ico">
    <!-- 公共 -->
    <script>
        const url = "/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/"
        const system_version = "<?php echo htmlentities($system_version); ?>"
    </script>

    <!-- 模板样式 -->
    <link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/css/common/reset.css">

    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/theme/index.js"></script>

    <link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/css/common/common.css">
    <link rel="stylesheet" href="/upload/common/iconfont/iconfont.css">


    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/js/common/vue.js"></script>
    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/js/common/element.js"></script>


    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/utils/util.js"></script>
    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/lang/index.js"></script>
    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/js/common/common.js"></script>

<link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/NotFound.css" />

</head>

<body>
  <div class="template">
    <el-container>
      <aside-menu></aside-menu>
      <el-container>
        <top-menu></top-menu>
        <el-main>
          <!-- 自己的东西 -->
          <div class="main-card">
            <div class="content-box">
              <div class="img-box">
                <img src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/common/404.png" alt="">
              </div>
              <div class="tips-box">
                {{lang.status_text1}}
                <p class="tran-again" @click="goBack">{{lang.status_text2}}</p>
              </div>
            </div>
          </div>
        </el-main>
      </el-container>
    </el-container>
  </div>
  <!-- =======页面独有======= -->
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/NotFound.js"></script>
  <!-- =======公共======= -->
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/utils/directive.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/js/common/axios.min.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/utils/request.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/api/common.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/coinActive/coinActive.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/components/asideMenu/asideMenu.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/components/topMenu/topMenu.js"></script>
</body>

</html>

