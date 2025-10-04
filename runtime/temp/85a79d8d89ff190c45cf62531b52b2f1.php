<?php /*a:2:{s:51:"../public/clientarea/template/pc/default/header.php";i:1756623755;s:103:"../public/plugins/addon/idcsmart_certification/template/clientarea/pc/default/authentication_thrid.html";i:1756623755;}*/ ?>
<!-- 页面独有样式 -->
<link rel="stylesheet"
  href="/plugins/addon/idcsmart_certification/template/clientarea/pc/default/css/authentication.css">
</head>

<body>
  <!-- mounted之前显示 -->
  <div id="mainLoading">
    <div class="ddr ddr1"></div>
    <div class="ddr ddr2"></div>
    <div class="ddr ddr3"></div>
    <div class="ddr ddr4"></div>
    <div class="ddr ddr5"></div>
  </div>
  <div class="template">
    <el-container>
      <aside-menu></aside-menu>
      <el-container>
        <top-menu></top-menu>
        <el-main>
          <!-- 自己的东西 -->
          <div class="main-card">
            <div class="main-top">
              <div class="main-card-title">
                {{lang.realname_text1}}
              </div>
              <div class="top-line"></div>
            </div>
            <!-- 选择认证方式页面 -->
            <div class="third-box" id="third-box"></div>
            <div class="go-Back-Btn">
            </div>
          </div>
        </el-main>
      </el-container>
    </el-container>
  </div>
  <!-- =======页面独有======= -->
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/jquery.mini.js"></script>
  <script src="/plugins/addon/idcsmart_certification/template/clientarea/pc/default/api/certification.js"></script>
  <script src="/plugins/addon/idcsmart_certification/template/clientarea/pc/default/lang/index.js"></script>
  <script src="/plugins/addon/idcsmart_certification/template/clientarea/pc/default/js/authenticationThrid.js"></script>
