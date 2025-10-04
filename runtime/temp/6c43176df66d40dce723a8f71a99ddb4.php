<?php /*a:3:{s:51:"../public/clientarea/template/pc/default/regist.php";i:1756623755;s:51:"../public/clientarea/template/pc/default/header.php";i:1756623755;s:51:"../public/clientarea/template/pc/default/footer.php";i:1756623755;}*/ ?>
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

<link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/regist.css" />
</head>

<body>
  <div id="mainLoading">
    <div class="ddr ddr1"></div>
    <div class="ddr ddr2"></div>
    <div class="ddr ddr3"></div>
    <div class="ddr ddr4"></div>
    <div class="ddr ddr5"></div>
  </div>
  <div class="template">
    <div id="regist">
      <!-- 验证码 -->
      <captcha-dialog ref="captcha" :is-show-captcha="isShowCaptcha"></captcha-dialog>
      <div class="login-container">
        <div class="container-back">
          <div class="back-line1"></div>
          <div class="back-line2"></div>
          <div class="back-line3"></div>
          <div class="back-text">
            <div class="text-welcome">WELCOME</div>
            <div class="text-title">
              <!-- {{lang.login_welcome}} -->
              {{ lang.login_welcome }}{{ commonData.website_name
                }}{{ lang.login_vip }}
            </div>
            <div class="text-level">
              {{ lang.login_level }}
            </div>
          </div>
        </div>
        <div class="container-before">
          <div class="login">
            <div class="login-text">
              <div class="login-text-title">{{ lang.regist }}</div>
              <div class="login-text-regist">
                {{ lang.regist_yes_account
                  }}<a @click="toLogin">{{ lang.regist_login_text }}</a>
              </div>
            </div>
            <div class="login-form">
              <div class="login-top">
                <div v-if="commonData.register_email == 1" class="login-email" :class="isEmailOrPhone? 'active':null"
                  @click="changeType(true)">
                  {{ lang.login_email }}
                </div>
                <div v-if="commonData.register_phone == 1" class="login-phone" :class="!isEmailOrPhone? 'active':null"
                  @click="changeType(false)">
                  {{ lang.login_phone }}
                </div>
              </div>
              <div class="form-main" v-if="commonData.register_email == 1 || commonData.register_phone == 1">
                <div class="form-item">
                  <input type="password" class="empty-input">
                  <el-input v-if="isEmailOrPhone" v-model="formData.email" :placeholder="lang.login_email"></el-input>
                  <el-input v-else class="input-with-select select-input" v-model="formData.phone"
                    :placeholder="lang.login_phone">
                    <el-select filterable slot="prepend" v-model="formData.countryCode">
                      <el-option v-for="item in countryList" :key="item.name" :value="item.phone_code"
                        :label="'+' + item.phone_code">
                        +{{item.phone_code}} {{item.name_zh}}
                      </el-option>
                    </el-select>

                  </el-input>
                </div>
                <template v-if="commonData.code_client_phone_register == 1 && !isEmailOrPhone">
                  <div class="form-item code-item" v-if="!(commonData.code_client_email_register==0 && isEmailOrPhone)">
                    <!-- 手机验证码 -->
                    <el-input v-if="!isEmailOrPhone" v-model="formData.phoneCode" :placeholder="lang.login_phone_code">
                    </el-input>
                    <count-down-button ref="phoneCodebtn" @click.native="sendPhoneCode" v-if="!isEmailOrPhone"
                      my-class="code-btn">
                    </count-down-button>
                  </div>
                </template>
                <template v-if="commonData.code_client_email_register == 1 && isEmailOrPhone">
                  <div class="form-item code-item">
                    <!-- 邮箱验证码 -->
                    <el-input v-if="isEmailOrPhone" v-model="formData.emailCode" :placeholder="lang.email_code">
                    </el-input>
                    <count-down-button ref="emailCodebtn" @click.native="sendEmailCode" v-if="isEmailOrPhone"
                      my-class="code-btn"></count-down-button>
                  </div>
                </template>

                <div class="form-item">
                  <el-input :placeholder="lang.tip1" v-model="formData.password" type="password">
                  </el-input>
                </div>
                <div class="form-item">
                  <el-input :placeholder="lang.tip2" v-model="formData.repassword" type="password"></el-input>
                </div>

                <el-form :model="ruleForm" ref="ruleForm" :rules="rules" label-position="top" class="custom-form"
                  v-plugin="'ClientCustomField'">
                  <el-form-item :prop="item.id + ''" :label="item.name" v-for="item in customFieldList" :key="item.id">
                    <el-select v-model="ruleForm[item.id]" :placeholder="item.description"
                      v-if="item.type === 'dropdown'">
                      <el-option :label="items" :value="items" v-for="(items,indexs) in item.options"
                        :key="indexs"></el-option>
                    </el-select>
                    <el-checkbox true-label="1" false-label="0" :label="item.name" v-model="ruleForm[item.id]"
                      v-else-if="item.type === 'tickbox'">
                      {{item.description}}
                    </el-checkbox>
                    <el-input :placeholder="item.description" v-model="ruleForm[item.id]"
                      v-else-if="item.type === 'dropdown_text'">
                      <el-select v-model="item.select_select" slot="prepend" style="width: 1.3rem;">
                        <el-option :label="items" :value="items" v-for="(items,indexs) in item.options"
                          :key="indexs"></el-option>
                      </el-select>
                    </el-input>
                    <el-input type="textarea" v-model="ruleForm[item.id]" v-else-if="item.type === 'textarea'"
                      :placeholder="item.description">
                    </el-input>
                    <el-input v-model="ruleForm[item.id]" :placeholder="item.description" v-else></el-input>
                  </el-form-item>
                </el-form>


                <div class="form-item read-item">
                  <!-- <el-checkbox v-model="checked">
                                        
                                    </el-checkbox>
                                    {{lang.tip3}}<a @click="toRead">{{lang.login_list}}</a> -->
                  <el-checkbox v-model="checked" class="check-div">
                  </el-checkbox>
                  <span class="read-text" @click="checked = !checked">
                    {{ lang.tip3
                    }}<a @click="goHelpUrl('terms_service_url')">{{
                      lang.read_service
                    }}</a>{{ lang.read_and
                    }}<a @click="goHelpUrl('terms_privacy_url')">{{
                      lang.read_privacy
                    }}</a>
                  </span>
                </div>
                <template v-if="showSale">
                  <div class="form-item read-item">
                    <el-checkbox v-model="checked1">{{lang.tip4}}</el-checkbox>
                  </div>
                  <template v-if="checked1">
                    <div class="read-item">
                      <el-input :placeholder="lang.tip5" v-model="customfield.sale_number"
                        v-if="register_select_sale == 0">
                      </el-input>
                      <el-select v-model="customfield.sale_number" filterable v-else style="width: 100%;">
                        <el-option :label="item.name" :value="item.sale_number" v-for="(item,index) in salesList"
                          :key="item.sale_number">
                        </el-option>
                      </el-select>
                    </div>
                  </template>
                </template>
                <div class="read-item" v-if="errorText.length !== 0">
                  <el-alert :title="errorText" type="error" show-icon :closable="false">
                  </el-alert>
                </div>
                <div class="form-item">
                  <el-button type="primary" class="login-btn" @click="doRegist">{{ lang.regist_to_login }}</el-button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- =======页面独有======= -->
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/countDownButton/countDownButton.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/crypto-js.min.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/jquery.mini.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/captchaDialog/captchaDialog.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/regist.js"></script>
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

