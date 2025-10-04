<?php /*a:3:{s:59:"../public/hcydxoep/template/default/template_web_config.php";i:1749055993;s:46:"../public/hcydxoep/template/default/header.php";i:1749055993;s:46:"../public/hcydxoep/template/default/footer.php";i:1749055993;}*/ ?>
<!DOCTYPE html>
<html lang="en" theme-color="default" theme-mode>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
  <title></title>
  <link rel="icon" href="/favicon.ico">
  <link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/common/tdesign.min.css" />
  <link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/common/reset.css" />
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/vue.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/utils/permission.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/composition-api.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/tdesign.min.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/comConfig/comConfig.js"></script>
  <script>
    Vue.config.devtools = false;
    Vue.prototype.lang = window.lang;
    const url = "/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/"
  </script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/lang.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/moment.min.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/layout.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/iconfont/iconfont.js"></script>
</head>

<body>
  <!-- loading -->
  <div id="loading">
    <div class="box">
      <div></div>
      <div></div>
    </div>
  </div>
  <t-layout id="layout">
    <!-- header+menu -->
    <t-layout class="aside" id="aside" v-cloak :class="{isFold:collapsed}">
      <com-config>
        <div class="header">
          <div class="logo" @click="goIndex">
            <img :src="logUrl" alt="logo">
          </div>

          <div class="h-left">
            <!-- <t-button theme="default" shape="square" variant="text" @click.native="changeCollapsed">
            <t-icon name="view-list"></t-icon>
          </t-button> -->
            <div class="global-search">
              <t-input id="global-input" :class="{ 'hover-active': isSearchFocus, 'h-search': true}"
                :placeholder="lang.please_search" @blur="changeSearchFocus(false)" @focus="changeSearchFocus(true)"
                @change="changeSearch" clearable>
                <template #prefix-icon>
                  <t-icon name="search" size="20px"></t-icon>
                </template>
              </t-input>
              <div class="search-content" v-show="isShow" id="search-content">
                <t-loading attach="#con" :loading="loadingSearch" size="small"></t-loading>
                <div class="con" v-if="global" id="con">
                  <t-collapse expand-icon-placement="right" default-expand-all :expand-on-row-click="true">
                    <t-collapse-panel value="0" :header="lang.user + '（' + global.clients.length + '）' " class="item"
                      v-if="global.clients.length>0">
                      <ul>
                        <li v-for="item in global.clients" :key="item.id">
                          <a :href="`${baseUrl}client_detail.htm?client_id=${item.id}`">
                            <p class="s-tit">{{item.username}}<span class="company" v-if="item.company">{{'(' + item.company
                              + ')'}}</span></p>
                            <p class="phone" v-if="item.phone">{{item.phone}}</p>
                          </a>
                        </li>
                      </ul>
                    </t-collapse-panel>
                    <t-collapse-panel value="1" :header="lang.tailorism + '（' + global.hosts.length + '）' " class="item"
                      v-if="global.hosts.length>0">
                      <ul>
                        <li v-for="item in global.hosts" :key="item.id">
                          <a :href="`${baseUrl}host_detail.htm?client_id=${item.client_id}&id=${item.id}`">
                            <p class="s-tit">{{item.product_name}}&nbsp;#/{{item.id}}</p>
                            <p class="host-name">{{item.product_name}}</p>
                          </a>
                        </li>
                      </ul>
                    </t-collapse-panel>
                    <t-collapse-panel value="2" :header="lang.product + '（' + global.products.length + '）' "
                      class="item" v-if="global.products.length>0">
                      <ul>
                        <li v-for="item in global.products" :key="item.id">
                          <a :href="`${baseUrl}product_detail.htm?id=${item.id}`">
                            <p class="s-tit">{{item.name}}</p>
                            <p class="host-name">{{item.product_group_name_first}}/{{item.product_group_name_second}}
                            </p>
                          </a>
                        </li>
                      </ul>
                    </t-collapse-panel>
                  </t-collapse>
                </div>
                <p class="no-data" v-if="noData">{{lang.tip10}}</p>
              </div>
            </div>
          </div>
          <t-alert theme="warning" style="padding: 10px;" v-if="versionData.expire === 1 || versionData.expire === 2">
            <template #message>
              <div class="expire-notice">
                {{lang.expire_text1}}
                {{versionData.expire=== 2 ? lang.expire_text3 : lang.expire_text2}}
                <span>({{ versionData.due_time }})</span>
                {{lang.expire_text4}}，{{lang.expire_text5}}
              </div>
            </template>
          </t-alert>
          <!-- 修改密码弹窗结束 -->
          <!-- header operations -->
          <div class="operations-container">
            <t-popup placement="bottom">
              <t-badge :count="total_count" style="margin: 0 10px;">
                <t-button style="width: 20px; height: 20px;" theme="default" shape="square" variant="text"
                  @click="goMessageList">
                  <t-icon name="notification" size="20px"></t-icon>
                </t-button>
              </t-badge>
              <template #content>
                <div class="notification-container" v-loading="loadingMsg">
                  <t-tabs v-model="msgType">
                    <!-- <t-tab-panel value="system" :label="`${lang.notice_text1}(${systemCount})`">
                    </t-tab-panel> -->
                    <t-tab-panel value="idcsmart" :label="`${lang.notice_text2}(${idcsmartCount})`">
                    </t-tab-panel>
                  </t-tabs>
                  <div class="notification-content">
                    <div class="notification-title">
                      <t-button variant="text" theme="primary" @click="goMessageList">{{lang.notice_text3}}</t-button>
                    </div>
                    <div class="notification-list">
                      <div class="notification-item"
                        v-for="item in (msgType === 'system'? systemMsgList : idcsmartMsgList)">
                        <div class="notification-item-title">
                          <span class="title-text aHover" @click="goMesgDetail(item.id)">{{item.title}}</span>
                          <span v-if="item.read === 0" class="read-btn"
                            @click.stop="readMsg(item)">{{lang.notice_text4}}</span>
                        </div>
                        <div class="notification-item-main">
                          <div v-html="item.content">{{item.content}}</div>
                        </div>
                        <div class="notification-item-footer">
                          <span class="time">{{moment(item.accept_time * 1000).format('YYYY-MM-DD HH:mm')}}</span>
                          <span
                            class="notification-item-type">{{item.type === 'system' ? lang.notice_text1 : lang.notice_text2}}</span>
                        </div>
                      </div>
                    </div>
                    <div class="notification-empty">
                      <p
                        v-if="msgType === 'system' && systemMsgList.length === 0 || msgType === 'idcsmart' && idcsmartMsgList.length === 0">
                        {{lang.notice_text21}}
                      </p>
                    </div>
                  </div>
                </div>
              </template>
            </t-popup>
            <t-tooltip placement="bottom" :content="lang.help_document">
              <t-button theme="default" shape="square" variant="text" @click="goHelp">
                <t-icon name="help-circle" size="20px" />
              </t-button>
            </t-tooltip>
            <t-dropdown @click="changeLang" trigger="click" :min-column-width="100"
              :popup-props="{overlayClassName: 'lang-list'}">
              <t-button variant="text">
                <img :src="curSrc" alt="" class="cur-img">
              </t-button>
              <t-dropdown-menu slot="dropdown" attach="html">
                <t-dropdown-item :value="item.display_lang" v-for="item in langList" :key="item.display_lang">
                  <img :src="item.display_img" alt="" class="img">
                  {{item.display_name}}
                </t-dropdown-item>
              </t-dropdown-menu>
            </t-dropdown>
            <t-dropdown :min-column-width="100" trigger="click" class="user-btn" size="small">
              <t-button class="header-user-btn" theme="default" variant="text">
                <template #icon>
                  <t-icon name="user-circle" size="20px"></t-icon>
                </template>
                <div class="header-user-account">
                  {{userName}}
                  <t-icon name="chevron-down"></t-icon>
                </div>
              </t-button>
              <t-dropdown-menu slot="dropdown" attach="html">
                <t-dropdown-item class="operations-dropdown-container-item" @click="toggleSettingPanel">
                  <template>
                    <t-icon name="setting"></t-icon>
                    {{lang.theme_setting}}
                  </template>
                </t-dropdown-item>
                <t-dropdown-item class="operations-dropdown-container-item" @click="toSafeCenter">
                  <template>
                    <t-icon name="lock-off"></t-icon>
                    {{lang.setting_text24}}
                  </template>
                </t-dropdown-item>
                <t-dropdown-item class="operations-dropdown-container-item" @click="handleLogout">
                  <template>
                    <t-icon name="poweroff"></t-icon>
                    {{lang.logout}}
                  </template>
                </t-dropdown-item>
              </t-dropdown-menu>
            </t-dropdown>
            <!-- <t-tooltip placement="bottom" :content="lang.system_setting">
            <t-button theme="default" shape="square" variant="text" @click="toggleSettingPanel">
              <t-icon name="setting" size="20px"></t-icon>
            </t-button>
          </t-tooltip> -->
          </div>
          <!-- system-setting -->
          <t-drawer :visible.sync="visible" :header="lang.system_setting" :footer="false" id="setting">
            <template Slot="closeBtn">
              <t-icon name="close"></t-icon>
            </template>
            <div class="setting-group-title">{{ lang.theme_mode }}</div>
            <t-radio-group v-model="formData.mode">
              <div v-for="(item, index) in MODE_OPTIONS" :key="index" class="setting-layout-drawer">
                <div>
                  <t-radio-button :key="index" :value="item.type">
                    <img :src="item.src"></img>
                  </t-radio-button>
                  <p :style="{ textAlign: 'center', marginTop: '8px' }">{{ item.text }}</p>
                </div>
              </div>
            </t-radio-group>
            <div class="setting-group-title">{{ lang.theme_color }}</div>
            <t-radio-group v-model="formData.brandTheme">
              <div v-for="(item, index) in COLOR_OPTIONS.slice(0, COLOR_OPTIONS.length)" :key="index"
                class="setting-layout-drawer theme" :class="{no:item!==formData.brandTheme}">
                <t-radio-button :key="index" :value="item" class="setting-layout-color-group">
                  <template>
                    <div :style="{background:getBrandColor(item,colorList)['@brand-color']}" class="color"></div>
                  </template>
                </t-radio-button>
              </div>
            </t-radio-group>
          </t-drawer>
        </div>
        <!-- aside menu -->
        <t-menu :theme="formData.mode" :value="curValue" :collapsed="collapsed" :expanded="expanded"
          @expand="expanded = $event">
          <div v-for="(item,index) in navList" :key="index">
            <template v-if="!item.child">
              <a :href="getMenuUrl(item)" onclick="return false">
                <t-menu-item :value="item.id" @click="jumpHandler(item)">
                  <template #icon>
                    <t-icon :name="item.icon" />
                  </template>
                  <span style="display: flex; align-items: center;">
                    {{item.name}}
                    <img
                      v-if="(item.url === 'configuration_system.htm' && isCanUpdata) || (item.url === 'plugin.htm' && pluginUpgrade)"
                      style="width: 20px; height: 20px; margin-left: 10px;"
                      src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/upgrade.svg">
                  </span>
                </t-menu-item>
              </a>
            </template>
            <t-submenu :value="item.id" mode="popup" v-else>
              <template #icon>
                <t-icon :name="item.icon" />
              </template>
              <span slot="title" style="display: flex; align-items: center;">
                {{item.name}}
                <img
                  v-if="(setting_parent_id === item.id && !expanded.includes(setting_parent_id) && isCanUpdata) || plugin_parent_id === item.id && !expanded.includes(plugin_parent_id) && pluginUpgrade"
                  style="width: 20px; height: 20px; margin-left: 10px;"
                  src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/upgrade.svg">
              </span>
              <div v-for="ele in item.child" :key="ele.id">
                <template v-if="!ele.child">
                  <a :href="getMenuUrl(ele)" onclick="return false">
                    <t-menu-item :value="ele.id" :key="ele.id" @click="jumpHandler(ele)">
                      <span style="display: flex; align-items: center;">
                        <span>{{ele.name}}</span>
                        <img
                          v-if="(ele.url === 'configuration_system.htm' && isCanUpdata) || (ele.url === 'plugin.htm' && pluginUpgrade)"
                          style="width: 20px; height: 20px; margin-left: 10px;"
                          src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/upgrade.svg">
                      </span>
                    </t-menu-item>
                  </a>
                </template>
                <t-submenu :value="ele.id" mode="popup" v-else>
                  <span slot="title">
                    {{ele.name}}
                  </span>
                  <template v-for="e in ele.child">
                    <a :href="getMenuUrl(e)" onclick="return false">
                      <t-menu-item :value="e.id" :key="e.id" @click="jumpHandler(e)">
                        <span>
                          {{e.name}}
                        </span>
                      </t-menu-item>
                    </a>
                  </template>
                </t-submenu>
              </div>
            </t-submenu>
          </div>
          <template #operations>
            <div id="global_search" :class="{collapsed: collapsed}">
              <div class="search hide">
                <t-icon name="search"></t-icon>
              </div>
              <div class="search-box">
                <div class="item" id="search-table">
                  <t-select v-model="globalForm.table" placeholder="" :popup-props="{ attach: '#search-table' }">
                    <t-option v-for="item in globalConfig" :value="item.table" :label="item.name"
                      :key="item.table"></t-option>
                  </t-select>
                  <t-select v-model="globalForm.key" placeholder="" @change="changeKey"
                    :popup-props="{ attach: '#search-table' }">
                    <t-option v-for="item in calcFiled" :value="item.key" :label="item.name" :key="item.key"></t-option>
                  </t-select>
                </div>
                <div class="item bot" id="search-key">
                  <div class="left">
                    <template v-if="curSearchType === 'select'">
                      <t-tree-select v-if="globalForm.key === 'product_id'" v-model="globalForm.value"
                        :data="curSearchOptions" :popup-props="popupProps" :tree-props="treeProps"
                        :placeholder="lang.product_id_empty_tip" filterable>
                      </t-tree-select>
                      <t-select v-else v-model="globalForm.value" :placeholder="lang.select"
                        :popup-props="{ attach: '#search-key' }">
                        <t-option v-for="item in curSearchOptions" :value="item.value" :label="item.name"
                          :key="item.value">
                        </t-option>
                      </t-select>
                    </template>
                    <t-date-picker allow-input v-else-if="curSearchType === 'date'" v-model="globalForm.value"
                      :popup-props="{ attach: '#search-key' }"></t-date-picker>
                    <t-input v-else :placeholder="lang.input" v-model="globalForm.value"
                      @keypress.enter.native="handleGlobal"></t-input>
                  </div>
                  <div class="search" @click="handleGlobal">
                    <t-icon :name="searchLoading ? 'loading' : 'search'"></t-icon>
                  </div>
                </div>
              </div>
            </div>
            <t-button variant="text" shape="square">
              <t-button variant="text" shape="square" @click.native="changeCollapsed">
                <t-icon name="view-list"></t-icon>
              </t-button>
            </t-button>
          </template>
        </t-menu>
        <!-- 修改密码弹窗开始 -->
        <t-dialog :visible.sync="editPassVisible" :header="lang.change_password" :on-close="editPassClose"
          :footer="false" width="600">
          <t-form :data="editPassFormData" ref="userDialog" @submit="onSubmit">

            <t-form-item :label="lang.password" name="password" :rules="[
                    { required: true , message: `${lang.input}${lang.password}`, type: 'error' },
                { pattern: /^[\w@!#$%^&*()+-_]{6,32}$/, message: lang.verify8 + '，' + lang.verify14 + '6~32', type: 'warning' }
              ]">
              <t-input :placeholder="`${lang.input}${lang.password}`" type="password"
                v-model="editPassFormData.password" />
            </t-form-item>
            <t-form-item :label="lang.surePassword" name="repassword" :rules="[
                    { required: true, message: `${lang.input}${lang.surePassword}`, type: 'error' },
            { validator: checkPwd, trigger: 'blur' }
          ]">
              <t-input :placeholder="`${lang.input}${lang.surePassword}`" type="password"
                v-model="editPassFormData.repassword" />
            </t-form-item>
            <div class="f-btn" style="text-align: right;">
              <t-button theme="primary" type="submit">{{lang.hold}}</t-button>
              <t-button theme="default" variant="base" @click="editPassClose">{{lang.cancel}}</t-button>
            </div>
          </t-form>
        </t-dialog>
      </com-config>
    </t-layout>
    <t-layout class="t-layout right-box">
      <div class="empty"></div>
      <t-content class="area">

<link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/template_controller.css" />
<!-- =======内容区域======= -->
<div id="content" class="template template_web_config" v-cloak>
  <com-config>
    <t-card class="list-card-container">
      <div class="top-box">
        <h2 class="top-back">{{lang.temp_controller}}
          <a :href="backUrl" class="template-back">&lt;&lt;{{lang.temp_back}}</a>
        </h2>
        <div class="top-btn">
          <t-button @click="handleUpgrade" v-if="themeInfo.upgrade === 1">{{lang.upgrade_plugin}}</t-button>
          <t-button theme="danger" @click="handleDelete">{{lang.tem_delete}}</t-button>
        </div>
      </div>
      <t-tabs v-model="tab" class="controller-tab" @change="changeTab">
        <t-tab-panel v-for="item in tabList" :value="item.url" :key="item.name" :label="item.title">
        </t-tab-panel>
      </t-tabs>
      <div class="box">
        <!-- 参数配置 -->
        <t-form :data="infoParams" @submit="submitConfig" :rules="typeRules" class="info-form" label-align="top">
          <t-form-item :label="lang.temp_icp_info" name="icp_info">
            <t-input v-model="infoParams.icp_info" :placeholder="`${lang.temp_icp_info}`"></t-input>
          </t-form-item>
          <t-form-item :label="lang.tem_jump_link" name="icp_info_link">
            <t-input v-model="infoParams.icp_info_link" :placeholder="`${lang.tem_jump_link}`"></t-input>
          </t-form-item>
          <t-form-item :label="lang.temp_put_on_record" name="public_security_network_preparation">
            <t-input v-model="infoParams.public_security_network_preparation"
              :placeholder="`${lang.temp_put_on_record}`"></t-input>
          </t-form-item>
          <t-form-item :label="lang.tem_jump_link" name="public_security_network_preparation_link">
            <t-input v-model="infoParams.public_security_network_preparation_link"
              :placeholder="`${lang.tem_jump_link}`"></t-input>
          </t-form-item>
          <t-form-item :label="lang.temp_telecom_value" name="telecom_appreciation">
            <t-input v-model="infoParams.telecom_appreciation" :placeholder="`${lang.temp_telecom_value}`"></t-input>
          </t-form-item>
          <t-form-item :label="lang.temp_copyright" name="copyright_info">
            <t-input v-model="infoParams.copyright_info" :placeholder="`${lang.temp_copyright}`">
            </t-input>
          </t-form-item>
          <t-form-item :label="lang.temp_enterprise_name" name="enterprise_name">
            <t-input v-model="infoParams.enterprise_name" :placeholder="`${lang.temp_enterprise_name}`"></t-input>
          </t-form-item>
          <t-form-item :label="lang.temp_enterprise_telephone" name="enterprise_telephone">
            <t-input v-model="infoParams.enterprise_telephone"
              :placeholder="`${lang.temp_enterprise_telephone}`"></t-input>
          </t-form-item>
          <t-form-item :label="lang.temp_enterprise_mailbox" name="enterprise_mailbox">
            <t-input v-model="infoParams.enterprise_mailbox" :placeholder="`${lang.temp_enterprise_mailbox}`"></t-input>
          </t-form-item>
          <t-form-item :label="lang.temp_online_link" name="online_customer_service_link" class="qrcode">
            <t-textarea v-model="infoParams.online_customer_service_link" :autosize="{ minRows: 3, maxRows: 8 }"
              :placeholder="`${lang.temp_online_link}`"></t-textarea>
          </t-form-item>
          <t-form-item :label="lang.temp_enterprise_qrcode" name="qrcode">
            <t-upload :action="uploadUrl" :headers="uploadHeaders" :format-response="formatResponse"
              v-model="infoParams.qrcode" theme="image" :placeholder="lang.upload_tip" theme="image-flow"
              accept="image/*" :auto-upload="true"></t-upload>
          </t-form-item>
          <t-form-item :label="lang.temp_web_logo" name="logo" class="web-logo">
            <t-upload :tips="lang.tem_tip7" :action="uploadUrl" :format-response="formatResponse"
              :headers="uploadHeaders" v-model="infoParams.logo" theme="image" :placeholder="lang.upload_tip"
              theme="image-flow" accept="image/*" :auto-upload="true">
            </t-upload>
          </t-form-item>
          <t-button theme="primary" type="submit" :loading="loading" class="info-btn">
            {{lang.hold}}
          </t-button>
        </t-form>
        <!-- 友情链接 -->
        <div class="limit-table">
          <div class="com-top">
            <p class="tit">{{lang.temp_friendly_link}}</p>
            <div class="add-btn" @click="addCalc('friendly_link')">{{lang.tem_add}}</div>
          </div>
          <t-table row-key="id" :data="friendly_link_list" size="medium" :columns="linkColumns" :hover="hover"
            :loading="friendly_link_loading" :table-layout="tableLayout ? 'auto' : 'fixed'" display-type="fixed-width"
            :hide-sort-tips="true">
            <template slot="sortIcon">
              <t-icon name="caret-down-small"></t-icon>
            </template>
            <template #op="{row}">
              <t-tooltip :content="lang.edit" :show-arrow="false" theme="light">
                <t-icon name="edit-1" @click="updateItem('friendly_link', row)" class="common-look"></t-icon>
              </t-tooltip>
              <t-tooltip :content="lang.delete" :show-arrow="false" theme="light">
                <t-icon name="delete" @click="deleteItem('friendly_link',row)" class="common-look"></t-icon>
              </t-tooltip>
            </template>
          </t-table>
        </div>
        <!-- 荣誉资质 -->
        <div class="limit-table">
          <div class="com-top">
            <p class="tit">{{lang.honor}}</p>
            <div class="add-btn" @click="addCalc('honor')">{{lang.order_text53}}</div>
          </div>
          <t-table row-key="id" :data="honor_list" size="medium" :columns="honorColumns" :hover="hover"
            :loading="honor_loading" :table-layout="tableLayout ? 'auto' : 'fixed'" display-type="fixed-width"
            :hide-sort-tips="true">
            <template slot="sortIcon">
              <t-icon name="caret-down-small"></t-icon>
            </template>
            <template #img="{row}">
              {{row.img.split('^')[1] || '--'}}
            </template>
            <template #op="{row}">
              <t-tooltip :content="lang.edit" :show-arrow="false" theme="light">
                <t-icon name="edit-1" @click="updateItem('honor', row)" class="common-look"></t-icon>
              </t-tooltip>
              <t-tooltip :content="lang.delete" :show-arrow="false" theme="light">
                <t-icon name="delete" @click="deleteItem('honor',row)" class="common-look"></t-icon>
              </t-tooltip>
            </template>
          </t-table>
        </div>
        <!-- 合作伙伴 -->
        <div class="limit-table">
          <div class="com-top">
            <p class="tit">{{lang.partner}}</p>
            <div class="add-btn" @click="addCalc('partner')">{{lang.order_text53}}</div>
          </div>
          <t-table row-key="id" :data="partner_list" size="medium" :columns="partnerColumns" :hover="hover"
            :loading="partner_loading" :table-layout="tableLayout ? 'auto' : 'fixed'" display-type="fixed-width"
            :hide-sort-tips="true">
            <template slot="sortIcon">
              <t-icon name="caret-down-small"></t-icon>
            </template>
            <template #img="{row}">
              {{row.img.split('^')[1] || '--'}}
            </template>
            <template #op="{row}">
              <t-tooltip :content="lang.edit" :show-arrow="false" theme="light">
                <t-icon name="edit-1" @click="updateItem('partner', row)" class="common-look"></t-icon>
              </t-tooltip>
              <t-tooltip :content="lang.delete" :show-arrow="false" theme="light">
                <t-icon name="delete" @click="deleteItem('partner',row)" class="common-look"></t-icon>
              </t-tooltip>
            </template>
          </t-table>
        </div>
      </div>
    </t-card>
    <!-- 新增/编辑 友情链接/荣誉/合作 -->
    <t-dialog :header="infoTit" :visible.sync="classModel" :footer="false" width="600" :close-on-overlay-click="false"
      class="info-dialog">
      <t-form :data="classParams" ref="classForm" @submit="submitInfo" :rules="typeRules" class="cycle-form"
        v-if="classModel">
        <t-form-item :label="lang.tem_name" name="name">
          <t-input v-model="classParams.name" :placeholder="`${lang.tem_name}`"></t-input>
        </t-form-item>
        <t-form-item :label="lang.temp_feed_link" name="url" v-if="calcType === 'friendly_link'">
          <t-input v-model="classParams.url" :placeholder="`${lang.temp_feed_link}`"></t-input>
        </t-form-item>
        <t-form-item :label="lang.temp_picture" name="qrcode" v-if="calcType !== 'friendly_link'" :rules="[
    { required: true, message: lang.tem_attachment + lang.temp_picture, type: 'error' } ]">
          <t-upload :action="uploadUrl" :headers="uploadHeaders" v-model="classParams.qrcode" theme="image"
            :placeholder="lang.upload_tip" theme="custom" accept="image/*" :auto-upload="true"
            :format-response="formatResponse">
          </t-upload>
        </t-form-item>
        <t-form-item :label="lang.description" name="description" v-if="calcType === 'partner'">
          <t-input v-model="classParams.description" :placeholder="`${lang.description}`"></t-input>
        </t-form-item>
        <div class="com-f-btn">
          <t-button theme="primary" type="submit" :loading="submitLoading">{{lang.hold}}</t-button>
          <t-button theme="default" variant="base" type="reset" @click="classModel = false">{{lang.close}}</t-button>
        </div>
      </t-form>
    </t-dialog>
    <!-- 删除提示框 -->
    <t-dialog theme="warning" :header="lang.temp_sure_delete" :close-btn="false" :visible.sync="delVisible">
      <template slot="footer">
        <t-button theme="primary" @click="sureDelete" :loading="delLoading">{{lang.tem_sure}}</t-button>
        <t-button theme="default" @click="delVisible=false">{{lang.tem_cancel}}</t-button>
      </template>
    </t-dialog>

    <!-- 删除主题弹窗 -->
    <t-dialog theme="warning" :header="lang.tem_tip14" :close-btn="false" :visible.sync="delDialog">
      <div class="del-tip">
        <div class="del-tip-text">
          <h3>{{lang.tem_tip15}} <span style="color: var(--td-brand-color);"> {{theme}} </span></h3>
          <p>{{lang.tem_tip16}}</p>
        </div>
      </div>
      <template slot="footer">
        <t-button theme="primary" @click="sureDel" :loading="delLoading">{{lang.tem_sure}}</t-button>
        <t-button theme="default" @click="delDialog=false">{{lang.tem_cancel}}</t-button>
      </template>
    </t-dialog>

    <!-- 升级主题弹窗 -->
    <t-dialog :header="lang.tem_tip17" :visible.sync="upgradeDialog" :footer="false" width="500"
      @closed="upgradeDialog = false" placement="center">
      <div class="tem-upgrade-box" style="padding-left: 120px;">
        <p>{{lang.tem_tip18}}：{{themeInfo.old_version}}</p>
        <p>{{lang.tem_tip19}}：{{themeInfo.version}}</p>
        <p>{{lang.tem_tip20}}: {{themeInfo.description || '--'}}</p>
      </div>
      <div class="com-f-btn">
        <t-button theme="primary" @click="sureUpgrade" :loading="submitLoading">{{lang.tem_sure}}</t-button>
        <t-button theme="default" variant="base" @click="upgradeDialog = false">{{lang.cancel}}</t-button>
      </div>
    </t-dialog>
  </com-config>
</div>
<!-- =======页面独有======= -->
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/api/template_controller.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/template_web_config.js"></script>
<!-- footer -->
<t-footer id="footer" v-cloak>Copyright @ 2019-{{new Date().getFullYear()}}
</t-footer>
</t-content>
</t-layout>
</t-layout>
<!-- =======公共======= -->
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/axios.min.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/utils/request.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/api/common.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/commonTool.js"></script>

</body>

</html>

