<?php /*a:2:{s:51:"../public/clientarea/template/pc/default/header.php";i:1756623755;s:104:"../public/plugins/addon/idcsmart_certification/template/clientarea/pc/default/authentication_person.html";i:1756623755;}*/ ?>
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
                {{lang.realname_text11}}
              </div>
              <div class="top-line"></div>
            </div>
            <!-- 个人认证页面 -->
            <div class="main-content">
              <el-form :model="certificationPerson" class="certification-person" :rules="personRules"
                ref="certificationPerson" label-position='top' label-width="100px">
                <el-form-item :label="lang.realname_text12" prop="card_name">
                  <el-input v-model="certificationPerson.card_name" :placeholder="lang.realname_text13"></el-input>
                </el-form-item>
                <el-form-item :label="lang.realname_text14" prop="phone">
                  <el-input v-model="certificationPerson.phone" :placeholder="lang.realname_text15"></el-input>
                </el-form-item>
                <el-form-item v-model="certificationPerson.card_type" :label="lang.realname_text16" prop="card_type">
                  <el-select v-model="certificationPerson.card_type" clearable>
                    <el-option v-for="item in id_card_type" :key="item.label" :label="item.label" :value="item.value">
                    </el-option>
                  </el-select>
                </el-form-item>
                <el-form-item v-for="(item,index) in custom_fieldsObj" :key="index"
                  :prop="certificationPerson.custom_fields[`${item.field}`]" :label="item.title"
                  :rules="{ required: item.required, message: item.tip, trigger: 'blur'}">
                  <el-input v-model="certificationPerson.custom_fields[`${item.field}`]"
                    v-if="item.type ==='text'"></el-input>
                  <el-select v-model="certificationPerson.custom_fields[`${item.field}`]" clearable
                    v-if="item.type ==='select'">
                    <el-option v-for=" (items,key,indexs) in item.options" :key="indexs" :label="items" :value="key">
                    </el-option>
                  </el-select>
                  <el-upload v-if="item.type==='file'" class="upload-btn" :headers="{Authorization: jwt}"
                    action="/console/v1/upload" :before-remove="beforeRemove" multiple :file-list="filelist"
                    :on-success="(response, file, fileList)=>handleSuccess(response, file, fileList,item)"
                    ref="fileupload">
                    <el-button icon="el-icon-upload2">{{lang.realname_text17}}</el-button>
                  </el-upload>
                </el-form-item>
                <el-form-item :label="lang.realname_text19" prop="card_number">
                  <el-input v-model="certificationPerson.card_number" :placeholder="lang.realname_text18"></el-input>
                </el-form-item>
                <el-form-item :label="lang.realname_text20" v-if="certificationInfoObj.certification_upload == 1"
                  required>
                  <div class="upload-btn">
                    <el-upload class="upload-1 img-upload" :headers="{Authorization: jwt}" action="/console/v1/upload"
                      auto-upload accept=".jpg,.gif,.jpeg,.png" :file-list="card_one_fileList"
                      :on-progress="(event,file,fileList)=>onProgress(event,file,fileList,'img_one')"
                      :before-upload="(file)=>onUpload(file,'img_one')" :on-remove="handleRemove1" :limit=1
                      list-type="picture-card" :class="{ hide: img_one != '' }" :on-success="handleSuccess1">
                      <div slot="default" class="upload-btn-img">
                        <img
                          src="/plugins/addon/idcsmart_certification/template/clientarea/pc/default/img/account/upload-ID-1.png"
                          alt="">
                      </div>
                      <div slot="file" slot-scope="{file}">
                        <img class="el-upload-list__item-thumbnail" :src="file.url" alt=""
                          v-if="upload1_progress === '100.00%'">
                        <div class="upload-progress" v-else v-loading="upload1_progress !=='100.00%'"
                          :element-loading-text="upload1_progress"></div>
                        <span class="el-upload-list__item-actions">
                          <span class="el-upload-list__item-preview" @click="handlePictureCardPreview(file)">
                            <i class="el-icon-zoom-in"></i>
                          </span>
                          <span class="el-upload-list__item-delete" @click="handleRemove1">
                            <i class="el-icon-delete"></i>
                          </span>
                        </span>
                      </div>
                      <div slot="tip" class="el-upload__tip">
                        <p class="tips-text">{{lang.realname_text21}}</p>
                        <p v-show="uploadTipsText1!=''" class="red-text">{{ uploadTipsText1 }}</p>
                      </div>
                    </el-upload>
                    <el-upload action="/console/v1/upload" :headers="{Authorization: jwt}" accept=".jpg,.gif,.jpeg,.png"
                      class="img-upload" :on-progress="(event,file,fileList)=>onProgress(event,file,fileList,'img_two')"
                      :file-list="card_two_fileList" :before-upload="(file)=>onUpload(file,'img_two')"
                      :on-remove="handleRemove2" :limit=1 list-type="picture-card" :class="{ hide: img_two !='' }"
                      :on-success="handleSuccess2">
                      <div slot="default" class="upload-btn-img">
                        <img
                          src="/plugins/addon/idcsmart_certification/template/clientarea/pc/default/img/account/upload-ID-2.png"
                          alt="">
                      </div>
                      <div slot="file" slot-scope="{file}">
                        <img class="el-upload-list__item-thumbnail" :src="file.url" alt=""
                          v-if="upload2_progress === '100.00%'">
                        <div class="upload-progress" v-else v-loading="upload2_progress !=='100.00%'"
                          :element-loading-text="upload2_progress"></div>
                        <span class="el-upload-list__item-actions">
                          <span class="el-upload-list__item-preview" @click="handlePictureCardPreview(file)">
                            <i class="el-icon-zoom-in"></i>
                          </span>
                          <span class="el-upload-list__item-delete" @click="handleRemove2">
                            <i class="el-icon-delete"></i>
                          </span>
                        </span>
                      </div>
                      <div slot="tip" class="el-upload__tip">
                        <p class="tips-text">{{lang.realname_text22}}</p>
                        <p v-show="uploadTipsText2!=''" class="red-text">{{ uploadTipsText2 }}</p>
                      </div>
                    </el-upload>
                  </div>
                </el-form-item>
              </el-form>
              <div class="next-box">
                <el-button @click="goSelect" class="back-btn">{{lang.realname_text8}}</el-button>
                <el-button :loading="sunmitBtnLoading" @click="personSumit">{{ sunmitBtnLoading ? lang.realname_text9 :
                  lang.realname_text10}}</el-button>
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
    src="/plugins/addon/idcsmart_certification/template/clientarea/pc/default/js/authenticationPerson.js"></script>
