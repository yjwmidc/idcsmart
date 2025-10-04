<?php /*a:1:{s:45:"../public/hcydxoep/template/default/login.php";i:1758278328;}*/ ?>
<!DOCTYPE html>
<html lang="en" theme-color="default" theme-mode>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
  <title>登录</title>
  <link rel="icon" href="">
  <link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/common/tdesign.min.css" />
  <link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/common/reset.css" />
  <link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/login.css">
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/vue.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/composition-api.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/tdesign.min.js"></script>
  <script>
    Vue.prototype.lang = window.lang
    const url = "/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/"
  </script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/lang.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/jquery.min.js"></script>
</head>


<body>
  <div id="login" v-cloak>
    <div class="login-container">
      <div class="title-container">
        <h1 class="title margin-no">{{lang.login}}</h1>
        <h1 class="title">{{website_name}}{{lang.login_text}}</h1>
      </div>
      <t-form ref="form" :data="formData" :rules="rules" label-width="0" class="item-container" @submit="onSubmit">
        <template>
          <t-form-item name="name">
            <t-input v-model="formData.name" size="large" :placeholder="lang.acount">
              <template #prefix-icon>
                <t-icon name="user" />
              </template>
            </t-input>
          </t-form-item>
          <t-form-item name="password">
            <t-input v-model="formData.password" size="large" type="password" clearable key="password"
              :placeholder="lang.password">
              <template #prefix-icon>
                <t-icon name="lock-on" />
              </template>
            </t-input>
          </t-form-item>
          <!-- <t-form-item name="captcha" v-if="captcha_admin_login==1">
            <t-input v-model="formData.captcha" size="large" :placeholder="lang.captcha">
            </t-input>
            <img :src="captcha" :alt="lang.captcha" class="captcha" @click="getCaptcha">
          </t-form-item> -->
          <div id="admin-captcha"></div>
          <t-form-item class="btn-container">
            <t-button block size="large" type="submit" :loading="loading">{{lang.login}}</t-button>
          </t-form-item>
          <div class="check-container remember-pwd" v-if="admin_allow_remember_account == 1">
            <t-checkbox v-model="check">
              {{lang.setting_text145}}
              <t-tooltip placement="top-right" :content="lang.setting_text146" :show-arrow="false"
                theme="light">
                <t-icon name="help-circle" size="18px" />
              </t-tooltip>
            </t-checkbox>
          </div>
        </template>
      </t-form>

      <!-- 二次验证弹窗 -->
      <t-dialog :visible.sync="verifyVisible" :header="lang.setting_text94" :on-close="verifyClose" :footer="false"
        width="600">
        <t-form :data="verifyFormData" ref="verifyDialog" @submit="onVerifySubmit" reset-type="initial">
          <t-form-item :label="lang.setting_text136">
            <t-select v-model="verifyType" :placeholder="lang.setting_text135" style="width: 100%;">
              <t-option value="sms" :label="lang.setting_text111"></t-option>
              <t-option value="email" :label="lang.setting_text112"></t-option>
              <t-option value="totp" :label="lang.ssetting_text118"></t-option>
            </t-select>
          </t-form-item>
          <t-form-item name="code" :label="lang.setting_text114"
            :rules="[{required:true,message:lang.setting_text120}]">
            <div class="verify-box">
              <t-input v-model="verifyFormData.code" :placeholder="lang.setting_text120" style="width: 100%;"></t-input>
              <t-button v-if="verifyType ==='sms' || verifyType === 'email' " theme="primary" @click="getVerifyCode"
                style="flex-shrink: 0;"
                :disabled="isVerifySending">{{isVerifySending ? (verifyCodeTime + lang.setting_text124) : lang.setting_text115}}
              </t-button>
            </div>
          </t-form-item>
          <div class="com-f-btn" style="text-align: right;">
            <t-button theme="primary" type="submit" :loading="loading">{{lang.login}}</t-button>
            <t-button theme="default" variant="base" @click="verifyClose">{{lang.cancel}}</t-button>
          </div>
        </t-form>
      </t-dialog>
    </div>
    <footer class="copyright">Copyright @ 2019-{{new Date().getFullYear()}}</footer>
  </div>
  <!-- =======公共======= -->
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/axios.min.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/utils/request.js"></script>
  <!-- =======页面独有======= -->
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/api/common.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/login.js"></script>

</body>

</html>
