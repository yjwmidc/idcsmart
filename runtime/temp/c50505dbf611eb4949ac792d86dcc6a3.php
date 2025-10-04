<?php /*a:2:{s:51:"../public/clientarea/template/pc/default/header.php";i:1755667656;s:105:"../public/plugins/addon/idcsmart_certification/template/clientarea/pc/default/authentication_company.html";i:1755667656;}*/ ?>
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
                <svg t="1749023272025" class="top-back-img" viewBox="0 0 1024 1024" version="1.1" @click="backTicket"
                  style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" p-id="20485" width="0.26rem"
                  height="0.26rem">
                  <path
                    d="M672.426667 209.92H455.68v-136.533333l-295.253333 170.666666 295.253333 170.666667v-136.533333h215.04C819.2 278.186667 938.666667 397.653333 938.666667 546.133333s-119.466667 267.946667-267.946667 267.946667H52.906667c-18.773333 0-34.133333 15.36-34.133334 34.133333s15.36 34.133333 34.133334 34.133334h619.52c186.026667 0 336.213333-150.186667 336.213333-336.213334s-151.893333-336.213333-336.213333-336.213333z"
                    p-id="20486" fill="var(--color-primary)"></path>
                </svg>
                {{lang.realname_text1}}
              </div>
              <div class="top-line"></div>
            </div>
            <!-- 企业认证页面 -->
            <div class="main-content">
              <el-form :model="certificationEnterprise" class="certification-enterprise" :rules="enterpriseRules"
                ref="certificationEnterprise" label-position='top' label-width="100px">
                <el-form-item :label="lang.realname_text2" prop="company">
                  <el-input v-model="certificationEnterprise.company" :placeholder="lang.realname_text3"></el-input>
                </el-form-item>
                <el-form-item :label="lang.realname_text4" prop="company_organ_code">
                  <el-input v-model="certificationEnterprise.company_organ_code"
                    :placeholder="lang.realname_text5"></el-input>
                </el-form-item>
                <el-form-item v-for="(item,index) in custom_fieldsObj" :key="index" :label="item.title"
                  :rules="{ required: item.required, message: item.tip, trigger: 'blur'}">
                  <el-input v-model="certificationEnterprise.custom_fields[item.field]" v-if="item.type ==='text'">
                  </el-input>
                  <el-select v-model="certificationEnterprise.custom_fields[item.field]" clearable
                    v-if="item.type ==='select'">
                    <el-option v-for=" (items,key,indexs) in item.options" :key="indexs" :label="items" :value="key">
                    </el-option>
                  </el-select>
                  <el-upload v-if="item.type==='file'" :headers="{Authorization: jwt}" class="upload-btn" :limit=1
                    :file-list="item.fileList"
                    :class="{ hide:certificationEnterprise.custom_fields[item.field].length !== 0 }"
                    :before-upload="(file)=>beforeUpload(file,item)" action="/console/v1/upload"
                    :on-remove="(file)=>beforeRemove(file,item)" list-type="picture-card" accept=".jpg,.gif,.jpeg,.png"
                    :on-success="(response)=>handleSuccess(response,item)" ref="fileupload">
                    <i slot="default" class="el-icon-plus"></i>
                    <div slot="file" slot-scope="{file}">
                      <img class="el-upload-list__item-thumbnail" :src="file.url" alt="">
                      <span class="el-upload-list__item-actions">
                        <span class="el-upload-list__item-preview" @click="handlePictureCardPreview(file)">
                          <i class="el-icon-zoom-in"></i>
                        </span>
                        <span class="el-upload-list__item-delete" @click="beforeRemove(file,item)">
                          <i class="el-icon-delete"></i>
                        </span>
                      </span>
                    </div>
                  </el-upload>
                </el-form-item>
                <el-form-item :label="lang.realname_text7" v-if="certificationInfoObj.certification_upload == 1"
                  required>
                  <el-upload :on-progress="onProgress" :headers="{Authorization: jwt}" action="/console/v1/upload"
                    class="img-upload" accept=".jpg,.gif,.jpeg,.png" :before-upload="(file)=>onUpload(file,'img_three')"
                    :file-list="card_three_fileList" :on-remove="handleRemove3" :limit=1 list-type="picture-card"
                    :class="{ hide:img_three!='' }" :on-success="handleSuccess3">
                    <div slot="default" class="upload-btn-img">
                      <img
                        src="/plugins/addon/idcsmart_certification/template/clientarea/pc/default/img/account/IDcard-3.png"
                        alt="">
                    </div>
                    <div slot="file" slot-scope="{file}">
                      <img class="el-upload-list__item-thumbnail" :src="file.url" alt=""
                        v-if="upload_progress === '100.00%'">
                      <div class="upload-progress" v-else v-loading="upload_progress !=='100.00%'"
                        :element-loading-text="upload_progress"></div>
                      <span class="el-upload-list__item-actions">
                        <span class="el-upload-list__item-preview" @click="handlePictureCardPreview(file)">
                          <i class="el-icon-zoom-in"></i>
                        </span>
                        <span class="el-upload-list__item-delete" @click="handleRemove3">
                          <i class="el-icon-delete"></i>
                        </span>
                      </span>
                    </div>
                    <div slot="tip" class="el-upload__tip red-text" v-show="uploadTipsText3!=''">{{ uploadTipsText3 }}
                    </div>
                  </el-upload>
                </el-form-item>
              </el-form>
              <div class="next-box">
                <el-button @click="goSelect" class="back-btn">{{lang.realname_text8}}</el-button>
                <el-button :loading="sunmitBtnLoading"
                  @click="companySumit">{{ sunmitBtnLoading ? lang.realname_text9 : lang.realname_text10}}</el-button>
              </div>
            </div>
          </div>
          <el-dialog :visible.sync="dialogVisible">
            <div class="visibleImg">
              <img :src="dialogImageUrl" alt="">
            </div>
          </el-dialog>
        </el-main>
      </el-container>
    </el-container>
  </div>
  <!-- =======页面独有======= -->
  <script src="/plugins/addon/idcsmart_certification/template/clientarea/pc/default/api/certification.js"></script>
  <script src="/plugins/addon/idcsmart_certification/template/clientarea/pc/default/lang/index.js"></script>
  <script
    src="/plugins/addon/idcsmart_certification/template/clientarea/pc/default/js/authenticationCompny.js"></script>
