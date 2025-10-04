<?php /*a:5:{s:32:"../public/web/default/index.html";i:1749055993;s:33:"../public/web/default/header.html";i:1749055993;s:40:"../public/web/default/public/header.html";i:1749055993;s:33:"../public/web/default/footer.html";i:1749055993;s:40:"../public/web/default/public/footer.html";i:1749055993;}*/ ?>
<!DOCTYPE html>
<html lang="en" theme-color="default" theme-mode id="addons_js" addons_js='<?php echo json_encode($addons); ?>'>

<head>
  <meta charset="UTF-8">
  <title><?php echo htmlentities($title); ?></title>
  <meta name="keywords" content="<?php echo htmlentities($keywords); ?>" />
  <meta name="description" content="<?php echo htmlentities($description); ?>" />

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Language" content="zh-cn">

  <!-- 公共区域 -->
  <link rel="icon" type="image/x-icon" href="/favicon.ico">
  <link rel="stylesheet" href="/web/default/assets/font/iconfont.css">
  <link rel="stylesheet" href="/web/default/common/reset.css">
  <link rel="stylesheet" href="/web/default/common/style.css">
  <link rel="stylesheet" href="/web/default/common/theme.css">
  <link rel="stylesheet" href="/web/default/common/common.css">
  <link rel="stylesheet" href="/web/default/vender/animate/animate.css">
  <script src="/web/default/vender/jQuery/jquery-3.5.1.min.js"></script>

  <!-- bootstrap -->
  <link rel="stylesheet" href="/web/default/vender/bootstrap/css/bootstrap.min.css">
  <script src="/web/default/vender/bootstrap/js/bootstrap.min.js"></script>
  <!-- swiper -->
  <link rel="stylesheet" href="/web/default/vender/swiper/swiper-bundle.min.css">
  <script src="/web/default/vender/swiper/swiper-bundle.min.js"></script>

  <script src="/web/default/common/common.js"></script>

  <link rel="alternate" hreflang="zh-Hans" href="<?php echo htmlentities($url); ?>">
  <link rel="canonical" href="<?php echo htmlentities($url); ?>">
  <script type="application/ld+json">
  {
    "@context": "https://ziyuan.baidu.com/contexts/cambrian.jsonld",
    "@id": "<?php echo htmlentities($url); ?>",
    "title": "<?php echo htmlentities($title); ?>",
    "description": "<?php echo htmlentities($description); ?>",
    "pubDate": "<?php echo htmlentities($pub_date); ?>",
    "upDate": "<?php echo htmlentities($up_date); ?>"
  }
</script>
<!-- 当前页面 -->
<link rel="stylesheet" href="/web/default/css/index.css">
<link rel="stylesheet" href="/web/default/css/viewer.min.css">

<script src="/web/default/js/index.js"></script>
<script src="/web/default/js/viewer.min.js"></script>

</head>

<body id="index">
  <header><div class="nav-shadow">
  <div class="section-content nav-header">
    <div class="nav-left">
      <div class="nav-icon">
        <a href="<?php echo isset($data['header_nav'][0]['file_address']) ? htmlentities($data['header_nav'][0]['file_address']) : 'index.html'; ?>"><img
            src="<?php echo isset($data['config']['official_website_logo']) ? htmlentities($data['config']['official_website_logo']) : ''; ?>" alt="" <?php if(( !isset($data['config']) )): ?> id="logo"
            <?php endif; ?>></a>
      </div>
      <div class="nav-menu">
        <?php if(( isset($data['header_nav']) )): foreach($data['header_nav'] as $key=>$value): if(( $key >= 1)): if(( $value['file_address'] != '' )): ?>
        <a href="<?php echo htmlentities($value['file_address']); ?>" <?php if(( $value['blank']==1 )): ?> target="_blank" <?php endif; ?>>
          <div class="nav-item"><?php echo htmlentities($value['name']); ?></div>
        </a>
        <?php else: ?>
        <div class="nav-item"><?php echo htmlentities($value['name']); ?></div>
        <?php endif; ?>
        <?php endif; ?>
        <?php endforeach; else: ?>
        <a href="/activities.html">
          <div class="nav-item">最新活动</div>
        </a>
        <div class="nav-item">产品</div>
        <div class="nav-item">解决方案</div>
        <div class="nav-item">合作伙伴</div>
        <div class="nav-item">客户支持</div>
        <div class="nav-item">关于我们</div>
        <?php endif; ?>
      </div>
    </div>
    <div class="nav-right">
      <a href="/document.html">
        <div class="control">文档</div>
      </a>
      <!-- <a href="">
        <div class="control">备案</div>
      </a> -->
      <a href="/home.htm">
        <div class="control">控制台</div>
      </a>
      <div class="no-login" style="display: none;">
        <div class="btn btn-normal-light mr-10" id="loginBtn">登录</div>
        <div class="btn btn-normal" id="registBtn">立即注册</div>
      </div>
      <div class="login-in " style="display: none;">
        <div id="headImg" class="head-img"></div>
        <span class="ml-10 font-el1 name" id="username"></span>
        <div class="login-menu animated fadeIn">
          <div class="login-menu-item" id="accountBtn">账户信息
            <span class="no-real-name real-name" id="noCertification">未实名</span>
            <span class="real-name " id="isCertification" style="display: none;">已实名</span>
          </div>
          <div class="login-menu-item" id="financeBtn">未付款订单</div>
          <div class="login-menu-item" id="ticketBtn">我的工单</div>
          <div class="login-menu-item" id="logout">退出账户</div>
        </div>
      </div>
    </div>
  </div>

  <div class="nav-cont">
    <div class="section-content">
      <?php if(( isset($data['header_nav']) )): foreach($data['header_nav'] as $key=>$value): if(( $key >= 1)): if(( count($value['children']) > 0 )): ?>
      <div class="nav-cont-menu  animated slideInDown">
        <div class="nav-content ">
          <?php foreach($value['children'] as $k=>$v): ?>
          <a href="<?php echo htmlentities($v['file_address']); ?>" <?php if(( $v['blank']==1 )): ?> target="_blank" <?php endif; ?>>
            <div class="nav-item-box">
              <?php if(( $v['icon'] != '' )): ?>
              <img src="<?php echo htmlentities($v['icon']); ?>" alt="">
              <?php endif; ?>
              <div class="item-box-title">
                <div class="title"><?php echo htmlentities($v['name']); ?></div>
                <div class="desc"><?php echo htmlentities($v['description']); ?></div>
              </div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php else: ?>
      <div class="nav-cont-menu nav-cont-empty"></div>
      <?php endif; ?>
      <?php endif; ?>
      <?php endforeach; else: ?>
      <div class="nav-cont-menu nav-cont-empty"></div>
      <div class="nav-cont-menu  animated slideInDown">
        <div class="nav-content ">
          <a href="/cloud.html">
            <div class="nav-item-box">
              <img src="/web/default/assets/img/nav/group-1.png" alt="">
              <div class="item-box-title">
                <div class="title">云服务器</div>
                <div class="desc">高可用的弹性计算服务</div>
              </div>
            </div>
          </a>
          <a href="/dedicated.html">
            <div class="nav-item-box">
              <img src="/web/default/assets/img/nav/group-2.png" alt="">
              <div class="item-box-title">
                <div class="title">物理裸机</div>
                <div class="desc">高性能物理裸机租用服务</div>
              </div>
            </div>
          </a>
          <a href="/domain.html">
            <div class="nav-item-box">
              <img src="/web/default/assets/img/nav/group-3.png" alt="">
              <div class="item-box-title">
                <div class="title">域名注册</div>
                <div class="desc">全球主流域名注册服务</div>
              </div>
            </div>
          </a>
          <a href="/ssl.html">
            <div class="nav-item-box">
              <img src="/web/default/assets/img/nav/group-4.png" alt="">
              <div class="item-box-title">
                <div class="title">SSL证书</div>
                <div class="desc">一站式SSL证书管理服务</div>
              </div>
            </div>
          </a>
          <a href="/sms.html">
            <div class="nav-item-box">
              <img src="/web/default/assets/img/nav/group-5.png" alt="">
              <div class="item-box-title">
                <div class="title">短信服务</div>
                <div class="desc">10秒内精准触达全球客户</div>
              </div>
            </div>
          </a>
          <a href="/trademark.html">
            <div class="nav-item-box">
              <img src="/web/default/assets/img/nav/group-6.png" alt="">
              <div class="item-box-title">
                <div class="title">商标注册</div>
                <div class="desc">1V1全流程商标注册服务</div>
              </div>
            </div>
          </a>
          <a href="/trusteeship.html">
            <div class="nav-item-box">
              <img src="/web/default/assets/img/nav/group-7.png" alt="">
              <div class="item-box-title">
                <div class="title">服务器托管</div>
                <div class="desc">安全无忧的高品质托管服务</div>
              </div>
            </div>
          </a>
          <a href="/rent.html">
            <div class="nav-item-box">
              <img src="/web/default/assets/img/nav/group-8.png" alt="">
              <div class="item-box-title">
                <div class="title">机柜租用</div>
                <div class="desc">覆盖全球的T3+机房资源</div>
              </div>
            </div>
          </a>
          <a href="/icp.html">
            <div class="nav-item-box">
              <img src="/web/default/assets/img/nav/group-9.png" alt="">
              <div class="item-box-title">
                <div class="title">ICP办理</div>
                <div class="desc">极速获取专属解决方案</div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="nav-cont-menu  animated slideInDown">
        <div class="nav-content ">
          <a href="/solution/ecommerce.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">电商行业</div>
                <div class="desc">快速实现线上营销创新与业务增收</div>
              </div>
            </div>
          </a>
          <a href="/solution/finance.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">金融行业</div>
                <div class="desc">实现金融机构与用户的高效触达</div>
              </div>
            </div>
          </a>
          <a href="/solution/game.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">游戏行业</div>
                <div class="desc">提升研发效率，增强交互体验</div>
              </div>
            </div>
          </a>
          <a href="/solution/auto.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">汽车行业</div>
                <div class="desc">助力更开放的出行服务连接生态</div>
              </div>
            </div>
          </a>
          <a href="/solution/travel.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">文旅行业</div>
                <div class="desc">推动文旅行业数智化转型升级</div>
              </div>
            </div>
          </a>
          <a href="/solution/education.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">教育行业</div>
                <div class="desc">打造云时代教育治理新模式</div>
              </div>
            </div>
          </a>
          <a href="/solution/medical.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">医疗行业</div>
                <div class="desc">提升各级医疗资源互联互通能力</div>
              </div>
            </div>
          </a>
          <a href="/solution/agriculture.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">农业行业</div>
                <div class="desc">构建智慧农业生产服务体系</div>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="nav-cont-menu animated slideInDown">
        <div class="nav-content ">
          <a href="/partner/cps.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">CPS推广</div>
                <div class="desc">邀好友上云，赢35%返现奖励</div>
              </div>
            </div>
          </a>
          <a href="/partner/agent.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">代理伙伴</div>
                <div class="desc">品牌让利，多渠道扶持，互助共赢</div>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="nav-cont-menu animated slideInDown">
        <div class="nav-content ">
          <a href="/document.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">文档中心</div>
                <div class="desc">全面细致的产品帮助文档</div>
              </div>
            </div>
          </a>
          <a href="/plugin/27/ticket.htm">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">技术工单</div>
                <div class="desc">资深工程师即时为您解答</div>
              </div>
            </div>
          </a>
          <a href="javascript:;" class="line-server-btn">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">在线客服</div>
                <div class="desc">7x24小时快速响应</div>
              </div>
            </div>
          </a>
          <a href="/service-guarantee.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">服务保障</div>
                <div class="desc">多渠道不间断服务支撑</div>
              </div>
            </div>
          </a>
          <a href="/contact.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">联系我们</div>
                <div class="desc">专业售前咨询和售后支持服务</div>
              </div>
            </div>
          </a>
          <a href="/announce.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">官方公告</div>
                <div class="desc">最新官方服务动态</div>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="nav-cont-menu animated slideInDown">
        <div class="nav-content ">
          <a href="/about.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">公司介绍</div>
                <div class="desc">助力中小企业数智化转型升级</div>
              </div>
            </div>
          </a>
          <a href="/recruit.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">人才招聘</div>
                <div class="desc">和我们一起，用云技术改变世界</div>
              </div>
            </div>
          </a>
          <a href="/news.html">
            <div class="nav-item-box">
              <div class="item-box-title">
                <div class="title">新闻资讯</div>
                <div class="desc">快速掌握行业前沿资讯</div>
              </div>
            </div>
          </a>

        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

</div>



<!-- 侧边 -->
<div class="aside-tools">
  <div class="tools-list">
    <?php if(( isset($data['side_floating_window']) )): foreach($data['side_floating_window'] as $key=>$value): ?>
    <div class="tools-item">
      <img src="<?php echo htmlentities($value['icon']); ?>" alt="">
      <div class="tools-box">
        <div class="tools-box-s">
          <h5><?php echo htmlentities($value['name']); ?></h5>
          <?php echo $value['content']; ?>
        </div>
      </div>
    </div>
    <?php endforeach; else: ?>
    <div class="tools-item">
      <img src="/web/default/assets/img/index/phone.png" alt="">
      <div class="tools-box">
        <div class="tools-box-s">
          <h5>电话咨询</h5>
          <p>7*24h不间断服务</p>
          <p class="com-contact-tel"></p>
        </div>
      </div>
    </div>
    <div class="tools-item">
      <img src="/web/default/assets/img/index/listen.png" alt="">
      <div class="tools-box">
        <div class="tools-box-s">
          <h5>在线客服</h5>
          <p>工作日 09:00-18:00</p>
          <a href="javascript:;" class="line-server-btn">
            <div class="button">立即查询</div>
          </a>
        </div>
      </div>
    </div>
    <div class="tools-item">
      <img src="/web/default/assets/img/index/worl-order.png" alt="">
      <div class="tools-box">
        <div class="tools-box-s">
          <h5>提交工单</h5>
          <p>专业工程师快速响应</p>
          <a href="/plugin/27/ticket.htm">
            <div class="button">立即提交</div>
          </a>
        </div>
      </div>
    </div>
    <div class="tools-item">
      <img src="/web/default/assets/img/index/message.png" alt="">
      <div class="tools-box">
        <div class="tools-box-s">
          <h5>意见反馈</h5>
          <p>您的意见是我们不断前进的动力</p>
          <a href="/feedback.html">
            <div class="button">立即反馈</div>
          </a>
        </div>
      </div>
    </div>
    <div class="tools-item">
      <img src="/web/default/assets/img/index/cart.png" alt="">
      <div class="tools-box">
        <div class="tools-box-s">
          <h5>购物车</h5>
          <p>从这里开始，打造云端专属空间</p>
          <a href="/cart/shoppingCar.htm">
            <div class="button">前往购物车</div>
          </a>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>
</div>
</header>

  <!-- banner -->
  <section class="section banner">
    <div class="swiper banner-cont">
      <div class="swiper-wrapper">
        <?php if(( isset($data['banner']) )): foreach($data['banner'] as $key=>$value): ?>
        <div class="swiper-slide">
          <a href="<?php echo htmlentities($value['url']); ?>">
            <img class="img-responsive img center-block" src="<?php echo htmlentities($value['img']); ?>" alt="">
          </a>
        </div>
        <?php endforeach; else: ?>
        <div class="swiper-slide">
          <img class="img-responsive img center-block" src="/web/default/assets/img/index/1@2x.png" alt="">
          <div class="section-content">
            <h1>中小企业的云计算底座</h1>
            <p class="banner-desc">主题云聚焦中小企业的数智化转型进程，以技术和数据为驱动，以产品和场景为载体，专注于打磨云上业务服务能力，助力中小企业全面业务上云演化。</p>
            <div class="btn btn2 btn-normal">立即查看</div>
          </div>
        </div>
        <div class="swiper-slide">
          <img class="img-responsive img center-block" src="/web/default/assets/img/index/1@2x.png" alt="">
          <div class="section-content">
            <h1>中小企业的云计算底座</h1>
            <p class="banner-desc">主题云聚焦中小企业的数智化转型进程，以技术和数据为驱动，以产品和场景为载体，专注于打磨云上业务服务能力，助力中小企业全面业务上云演化。</p>
            <div class="btn btn2 btn-normal">立即查看</div>
          </div>
        </div>
        <div class="swiper-slide">
          <img class="img-responsive img center-block" src="/web/default/assets/img/index/1@2x.png" alt="">
          <div class="section-content">
            <h1>中小企业的云计算底座</h1>
            <p class="banner-desc">主题云聚焦中小企业的数智化转型进程，以技术和数据为驱动，以产品和场景为载体，专注于打磨云上业务服务能力，助力中小企业全面业务上云演化。</p>
            <div class="btn btn2 btn-normal">立即查看</div>
          </div>
        </div>
        <?php endif; ?>
      </div>
      <!-- 如果需要分页器 -->
      <div class="swiper-pagination"></div>
    </div>
    </div>
    <div class="banner-s">
      <div class="section-content banner-list">
        <div class="banner-item" id="cloud-box">
          <h5>云服务器专场</h5>
          <p class="title-desc mt-10 mb-10">无数个人用户的共同选择</p>
          <span class="banner-tag">4核8G仅需228元</span>
        </div>
        <div class="banner-item" id="domain-box">
          <h5>域名注册</h5>
          <p class="title-desc mt-10 mb-10">优选主流域名注册服务</p>
          <span class="banner-tag">.top 88元起</span>
        </div>
        <div class="banner-item" id="cps-box">
          <h5>CPS推广</h5>
          <p class="title-desc mt-10 mb-10">多种产品高达30%高额佣金</p>
          <span class="banner-tag">最高可返佣金5W</span>
        </div>
        <div class="banner-item" id="logon-box">
          <h5>注册有礼</h5>
          <p class="title-desc mt-10 mb-10">免费注册领取专属礼包</p>
          <span class="banner-tag">价值2000元</span>
        </div>
      </div>

    </div>
  </section>

  <!-- 服务内容 -->
  <section class="section service">
    <div class="section-content">
      <div class="section-title">
        <h2>备受信赖的云计算服务商</h2>
        <div class="section-desc">主题云致力于为中小微企业提供全链业务上云解决方案，助力中国制造走向全球！</div>
      </div>
      <div class="service-content  fboxCol">
        <div class="fboxRow ">
          <a href="./cloud.html" class="flex1">
            <div class="service-box service-hot">
              <h4 class="service-title">云服务器</h4>
              <div class="title-desc">安全可靠、管理便捷的弹性计算服务，可随时变更计算资源，按需付费，降本增效。</div>
              <div class="service-tag-group">
                <div class="service-tag">弹性灵活</div>
                <div class="service-tag">简单易用</div>
                <div class="service-tag">秒级创建</div>
              </div>
              <div class="service-btn-group fboxWrap Xbetween Ycenter mt-30">
                <div class="service-price font14 font-theme"><span>￥</span><span
                    class="font24 font-weight">200</span><span>/3个月</span></div>
                <div class="fboxWrap">
                  <div class="btn btn-normal-light mr-15">查看详情</div>
                  <div class="btn btn-normal">立即购买</div>
                </div>
              </div>
            </div>
          </a>
          <a href="./dedicated.html" class="flex1">
            <div class="service-box">
              <h4 class="service-title">物理裸机</h4>
              <div class="title-desc">可弹性伸缩的高性能计算服务，性能无损、安全隔离、分钟级极速交付。</div>
              <div class="service-tag-group">
                <div class="service-tag">高配硬件</div>
                <div class="service-tag">性能无损</div>
                <div class="service-tag">资源独享</div>
              </div>
              <div class="service-btn-group fboxWrap Xbetween Ycenter mt-30">
                <div class="service-price font14 font-theme"><span>￥</span><span
                    class="font24  font-weight">200</span><span>/3个月</span></div>
                <div class="fboxWrap">
                  <div class="btn btn-normal-light mr-15">查看详情</div>
                  <div class="btn btn-normal">立即购买</div>
                </div>
              </div>
            </div>
          </a>
          <a href="./domain.html" class="flex1">
            <div class="service-box">
              <h4 class="service-title">域名注册</h4>
              <div class="title-desc">上百种域名后缀注册，智能查询、快速注册、实时生效、高性价比。</div>
              <div class="service-tag-group">
                <div class="service-tag">品类齐全</div>
                <div class="service-tag">快速响应</div>
                <div class="service-tag">实时生效</div>
              </div>
              <div class="service-btn-group fboxWrap Xbetween Ycenter mt-30">
                <div class="service-price font14 font-theme"><span>.top ￥</span><span
                    class="font24  font-weight">200</span><span>起</span></div>
                <div class="fboxWrap">
                  <div class="btn btn-normal-light mr-15">查看详情</div>
                  <!-- <div class="btn btn-normal">立即购买</div> -->
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="fboxRow">
          <a href="./ssl.html" class="flex1">
            <div class="service-box ">
              <h4 class="service-title">SSL证书</h4>
              <div class="title-desc">一站式安全证书服务，可在线快速签发多种品牌数字证书，保障数据安全</div>
              <div class="service-tag-group">
                <div class="service-tag">安全可信</div>
                <div class="service-tag">快速签发</div>
                <div class="service-tag">一站式服务</div>
              </div>

            </div>
          </a>
          <a href="./sms.html" class="flex1">
            <div class="service-box ">
              <h4 class="service-title">短信服务</h4>
              <div class="title-desc">三网合一专属通道，支持快速发送短信验证码和短信通知, 到达率高达99%。</div>
              <div class="service-tag-group">
                <div class="service-tag">低成本</div>
                <div class="service-tag">低时延</div>
                <div class="service-tag">高覆盖</div>
              </div>

            </div>
          </a>
          <a href="./trademark.html" class="flex1">
            <div class="service-box ">
              <h4 class="service-title">商标注册</h4>
              <div class="title-desc">提供商标查询、商标注册、商标续展等一站式高效服务，快速注册和管理商标。</div>
              <div class="service-tag-group">
                <div class="service-tag">专家指导</div>
                <div class="service-tag">智能申报</div>
                <div class="service-tag">高成功率</div>
              </div>

            </div>
          </a>

        </div>

        <div class="fboxRow">
          <a href="./trusteeship.html" class="flex1">
            <div class="service-box ">
              <h4 class="service-title">服务器托管</h4>
              <div class="title-desc">依托全球高等级数据中心，提供高定制化、高可用性、高安全性的服务器托管服务。</div>
              <div class="service-tag-group">
                <div class="service-tag">双电接入</div>
                <div class="service-tag">互联互通</div>
                <div class="service-tag">多地区可选</div>
              </div>

            </div>
          </a>
          <a href="./rent.html" class="flex1">
            <div class="service-box ">
              <h4 class="service-title">机柜租用</h4>
              <div class="title-desc">多条线路机房机柜，集冗余设计、高性能、可靠性、安全性和可扩展性于一身。</div>
              <div class="service-tag-group">
                <div class="service-tag">T3+数据中心</div>
                <div class="service-tag">安全合规</div>
                <div class="service-tag">灵活定制</div>
              </div>

            </div>
          </a>
          <a href="./icp.html" class="flex1">
            <div class="service-box ">
              <h4 class="service-title">ICP办理</h4>
              <div class="title-desc">1V1备案处理服务机制,0元快速备案,备案过程0担忧。</div>
              <div class="service-tag-group">
                <div class="service-tag">全程跟进</div>
                <div class="service-tag">高效便捷</div>
                <div class="service-tag">极速下证</div>
              </div>

            </div>
          </a>

        </div>
      </div>
    </div>

  </section>

  <!-- 解决方案 -->
  <section class="section section-bg resolve">
    <div class="section-content">
      <div class="section-title">
        <h2>全场景全栈解决方案</h2>
        <div class="section-desc">专业构架师针对丰富的业务场景，为千行百业构建稳定、易用的高性价比解决方案。</div>
      </div>
      <div class="resolve-content ">
        <div class="fboxRow">
          <div class="resolve-box">
            <a href="./solution/e-commerce.html">
              <div>
                <h4>电商</h4>
                <div class="title-desc">有效应对大促带来的业务高并发问题，助力电商客户快速实现营销创新与业务增收。</div>
                <p class="resolve-link">查看详情 <span class="iconfont icon-arrow-right"></span></p>
              </div>
            </a>
          </div>
          <div class="resolve-box">
            <a href="./solution/finance.html">
              <div>
                <h4>金融</h4>
                <div class="title-desc">助力金融机构打造面向垂直场景的创新方案，实现金融机构与用户之间的高效触达。</div>
                <p class="resolve-link">查看详情 <span class="iconfont icon-arrow-right"></span></p>
              </div>
            </a>
          </div>
          <div class="resolve-box">
            <a href="./solution/game.html">
              <div>
                <h4>游戏</h4>
                <div class="title-desc">构建高质量、全方位、深度体验的游戏云平台，提升研发效率，增强交互体验。</div>
                <p class="resolve-link">查看详情 <span class="iconfont icon-arrow-right"></span></p>
              </div>
            </a>
          </div>
          <div class="resolve-box">
            <a href="./solution/auto.html">
              <div>
                <h4>汽车</h4>
                <div class="title-desc">面向汽车行业提供全场景信息化解决方案，助力车企打造更开放的新型连接生态。</div>
                <p class="resolve-link">查看详情 <span class="iconfont icon-arrow-right"></span></p>
              </div>
            </a>
          </div>
        </div>

        <div class="fboxRow">
          <div class="resolve-box">
            <a href="./solution/travel.html">
              <div>
                <h4>文旅</h4>
                <div class="title-desc">通过“科技+文化旅游”的融合创新及落地应用，推动文旅行业信息化、智慧化发展。</div>
                <p class="resolve-link">查看详情 <span class="iconfont icon-arrow-right"></span></p>
              </div>
            </a>
          </div>
          <div class="resolve-box">
            <a href="./solution/education.html">
              <div>
                <h4>教育</h4>
                <div class="title-desc">实现数据互联、可视化、高交互的云上教育环境，打造云时代教育治理新模式。</div>
                <p class="resolve-link">查看详情 <span class="iconfont icon-arrow-right"></span></p>
              </div>
            </a>
          </div>
          <div class="resolve-box">
            <a href="./solution/medical.html">
              <div>
                <h4>医疗</h4>
                <div class="title-desc">协助医疗机构打造资源共享、再利用、再生产的数据生态循环，提高资源配置效率。</div>
                <p class="resolve-link">查看详情 <span class="iconfont icon-arrow-right"></span></p>
              </div>
            </a>
          </div>
          <div class="resolve-box">
            <a href="./solution/agriculture.html">
              <div>
                <h4>农业</h4>
                <div class="title-desc">助力农企构建智慧农业生产服务体系，提升农业精细化种植与管理水平。</div>
                <p class="resolve-link">查看详情 <span class="iconfont icon-arrow-right"></span></p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>

  </section>

  <!-- 服务实践 -->
  <section class="section practice">
    <div class="section-content">
      <div class="section-title">
        <h2>聚焦核心场景，助力数智升级</h2>
        <div class="section-desc">主题云专注为各行业用户提供专业、智能、无忧的上云方案</div>
      </div>
      <?php if(( isset($data['partner']) )): ?>
      <div class="practice-content fboxRow">
        <?php foreach($data['partner'] as $key=>$value): if(( $key < 3 )): ?> <div class="practice-box">
          <img src="<?php echo htmlentities($value['img']); ?>" alt="">
          <div class="mt-10 over-hide"><?php echo htmlentities($value['name']); ?></div>
          <p class="tr font-grey mt-20 font12"><?php echo htmlentities($value['description']); ?></p>
      </div>
      <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <div class="fboxWrap brand-group fboxWrap"
      style="<?php if(( count($data['partner']) > 3 )): ?>display: flex;<?php else: ?>display: none;<?php endif; ?>">
      <?php foreach($data['partner'] as $key=>$value): if(( $key >= 3 )): ?>
      <div class="brand-box">
        <img src="<?php echo htmlentities($value['img']); ?>" alt="">
      </div>
      <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="practice-content fboxRow" id="practiceBox">
    </div>
    <div class="fboxWrap brand-group fboxWrap" id="morPracticeBox" style="display: none;">
    </div>
    <?php endif; ?>
    </div>

  </section>

  <!-- 安全合规、高速稳定的基础设施 -->
  <section class="section section-base">
    <div class="section-content">
      <div class="section-title">
        <h2>安全合规、高速稳定的基础设施</h2>
      </div>
      <div class="fboxRow base">
        <div class="base-content mt-40">
          <div class="fboxRow Ycenter mb-30">
            <h2>20+</h2><span class="title-desc ml-10">国家地理区域</span>
          </div>
          <div class="fboxRow Ycenter mb-30">
            <h2>60+</h2><span class="title-desc ml-10">可用区</span>
          </div>
          <div class="fboxRow Ycenter mb-30">
            <h2>500+</h2><span class="title-desc ml-10">全球CDN节点</span>
          </div>
          <div class="fboxRow Ycenter mb-30">
            <h2>1T+</h2><span class="title-desc ml-10">可承载DDOS攻击</span>
          </div>

        </div>
        <img src="/web/default/assets/img/index/map.png" alt="">
      </div>
    </div>
    <div class="cert">
      <?php if(( isset($data['honor']) )): ?>
      <div class="section-content cert-list fboxWrap">
        <?php foreach($data['honor'] as $key=>$value): ?>
        <div class="cert-item">
          <img src=<?php echo htmlentities($value['img']); ?> alt="">
          <p class="mt-20"><?php echo htmlentities($value['name']); ?></p>
        </div>
        <?php endforeach; ?>
      </div>
      <?php else: ?>
      <div class="section-content cert-list fboxWrap" id="certBox">
      </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- 新闻 -->
  <section class="section news">
    <div class="section-content">
      <div class="section-title">
        <h2>新动向，新机遇</h2>
        <div class="section-desc">最新发展动态、最热行业资讯，与主题云一起见证云时代精彩瞬间</div>
      </div>
      <div class="news-content fboxWrap">
        <div class="news-cont">
          <div class="news-head fboxRow Xbetween Yend">
            <div class="news-title">官方公告</div>
            <div class="news-more"><a href="./announce.html">更多</a><span class="iconfont icon-arrow-right"></span></div>
          </div>
          <div class="news-list" id="announceList">

          </div>
        </div>

        <div class="news-cont">
          <div class="news-head fboxRow Xbetween Yend">
            <div class="news-title">新闻资讯</div>
            <div class="news-more"><a href="./news.html">更多</a><span class="iconfont icon-arrow-right"></span></div>
          </div>
          <div class="news-list" id="newsList">
          </div>
        </div>
      </div>

    </div>

  </section>

  <div style="height: 0;">
    <img id="viewer" alt="" style="display: none;">
  </div>

  
<footer class="section footer index"><div class="register-advert ">
  <a href="regist.htm"><img class="img-responsive" src="/web/default/assets/img/index/register@2x.png" alt=""></a>
</div>
<div class=" section-promise">
  <div class="promise section-content section-p">
    <div class="promise-box"><img src="/web/default/assets/img/index/promise-1.png"> <span class="ml-20">3天 无忧退款</span>
    </div>
    <div class="promise-box"><img src="/web/default/assets/img/index/promise-2.png"> <span class="ml-20">0元 免费备案</span>
    </div>
    <div class="promise-box"><img src="/web/default/assets/img/index/promise-3.png"> <span class="ml-20">1V1 专属客服</span>
    </div>
    <div class="promise-box"><img src="/web/default/assets/img/index/promise-4.png"> <span class="ml-20">7*24
        小时服务</span></div>
  </div>
</div>
<div class="section-content section-p">


  <div class="footer-content">
    <div class="footer-nav">
      <div class="footer-nav-left">
        <?php if(( isset($data['footer_nav']) )): foreach($data['footer_nav'] as $key=>$value): ?>
        <div class="footer-nav-box">
          <div class="footer-nav-head"><?php echo htmlentities($value['name']); ?></div>
          <div class="footer-nav-cont">
            <?php foreach($value['children'] as $k=>$v): ?>
            <div class="footer-nav-item"><a class="link-hover" href="<?php echo htmlentities($v['url']); ?>" <?php if(( $v['blank']==1 )): ?> target="_blank"
                <?php endif; ?>><?php echo htmlentities($v['name']); ?></a></div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; else: ?>
        <div class="footer-nav-box">
          <div class="footer-nav-head">热门产品</div>
          <div class="footer-nav-cont">
            <div class="footer-nav-item"><a class="link-hover" href="/cloud.html">云服务器</a></div>
            <div class="footer-nav-item"><a class="link-hover" href="/dedicated.html">物理裸机</a></div>
            <div class="footer-nav-item"><a class="link-hover" href="/domain.html">域名注册</a></div>
            <div class="footer-nav-item"><a class="link-hover" href="/ssl.html">SSL证书</a></div>
            <div class="footer-nav-item"><a class="link-hover" href="/sms.html">短信服务</a></div>
            <div class="footer-nav-item"><a class="link-hover" href="/trusteeship.html">服务器托管</a></div>
          </div>
        </div>

        <div class="footer-nav-box">
          <div class="footer-nav-head">客户支持</div>
          <div class="footer-nav-cont">
            <div class="footer-nav-item"><a class="link-hover" href="/document.html">文档中心</a></div>
            <div class="footer-nav-item"><a class="link-hover" href="/plugin/27/ticket.htm">技术工单</a></div>
            <div class="footer-nav-item"><a class="link-hover line-server-btn" href="javascript:;">在线客服</a></div>
            <div class="footer-nav-item"><a class="link-hover" href="/contact.html">联系我们</a></div>
            <div class="footer-nav-item"><a class="link-hover" href="/announce.html">官网公告</a></div>
          </div>
        </div>

        <div class="footer-nav-box">
          <div class="footer-nav-head">账户管理</div>
          <div class="footer-nav-cont">
            <div class="footer-nav-item"><a class="link-hover" href="/home.htm">管理控制台</a></div>
            <div class="footer-nav-item"><a class="link-hover" href="/domain.html">域名管理</a></div>
            <!-- <div class="footer-nav-item"><a class="link-hover" href="">备案管理</a></div> -->
            <div class="footer-nav-item"><a class="link-hover" href="/finance.htm">订单管理</a></div>
            <div class="footer-nav-item"><a class="link-hover" href="/home.htm">发票管理</a></div>
            <div class="footer-nav-item"><a class="link-hover" href="/account.htm">账号管理</a></div>
          </div>
        </div>

        <div class="footer-nav-box">
          <div class="footer-nav-head">了解我们</div>
          <div class="footer-nav-cont">
            <div class="footer-nav-item"><a class="link-hover" href="/about.html">公司介绍</a></div>
            <div class="footer-nav-item"><a class="link-hover" href="/recruit.html">人才招聘</a></div>
            <div class="footer-nav-item"><a class="link-hover" href="/news.html">新闻资讯</a></div>
          </div>
        </div>

        <div class="footer-nav-box">
          <div class="footer-nav-head">其他</div>
          <div class="footer-nav-cont">
            <div class="footer-nav-item"><a class="link-hover" id="terms_service_url" href="javascript:;">用户协议</a></div>
            <div class="footer-nav-item"><a class="link-hover" id="terms_privacy_url" href="javascript:;">隐私政策</a></div>
            <div class="footer-nav-item"><a class="link-hover" href="/agreement.htm?id=26">Cookies政策</a></div>
            <div class="footer-nav-item"><a class="link-hover" href="/agreement.htm?id=27">法律声明</a></div>
          </div>
        </div>
        <?php endif; ?>
      </div>

      <div class="footer-nav-right">
        <div class="footer-nav-box">
          <div class="footer-nav-head">联系我们</div>
          <?php if(( isset($data['config']) )): ?>
          <div class="footer-nav-cont">
            <div class="footer-nav-item"><?php echo htmlentities($data['config']['enterprise_name']); ?></div>
            <div class="footer-nav-item mt-20"><?php echo htmlentities($data['config']['enterprise_telephone']); ?></div>
            <div class="footer-nav-item"><?php echo htmlentities($data['config']['enterprise_mailbox']); ?></div>
          </div>
          <div class="qr-code"><img src="<?php echo htmlentities($data['config']['enterprise_qrcode']); ?>" alt=""></div>
          <?php else: ?>
          <div class="footer-nav-cont">
            <div class="footer-nav-item" id="enterprise_name"></div>
            <div class="footer-nav-item mt-20" id="enterprise_telephone"></div>
            <div class="footer-nav-item" id="enterprise_mailbox"></div>
          </div>
          <div class="qr-code"><img src="" alt="" id="enterprise_qrcode"></div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <?php if(( isset($data['friendly_link']) )): ?>
    <div class="footer-link">
      <span>友情链接：</span>
      <?php foreach($data['friendly_link'] as $key=>$value): ?>
      <a href=<?php echo htmlentities($value['url']); ?> target="_blank" rel="nofollow"><?php echo htmlentities($value['name']); ?></a>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="footer-link" id="footerLink">
      <span>友情链接：</span>
    </div>
    <?php endif; if(( isset($data['config']) )): ?>
    <div class="footer-record">
      <div class='left-info'>
        <a href='<?php echo htmlentities($data['config']['icp_info_link']); ?>' target="_blank" rel="nofollow"><?php echo htmlentities($data['config']['icp_info']); ?></a>
        <a href='<?php echo htmlentities($data['config']['public_security_network_preparation_link']); ?>' target="_blank"
          rel="nofollow"><?php echo htmlentities($data['config']['public_security_network_preparation']); ?></a>
        <span><?php echo htmlentities($data['config']['telecom_appreciation']); ?></span>
      </div>
      <span><?php echo htmlentities($data['config']['copyright_info']); ?></span>
    </div>
    <?php else: ?>
    <div class="footer-record" id="footerRecord">
      <span id="copyright_info"></span>
    </div>
    <?php endif; ?>
  </div>
</div>
</footer>
</body>
</html>

