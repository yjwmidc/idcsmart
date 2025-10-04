<?php /*a:3:{s:60:"../public/hcydxoep/template/default/configuration_system.php";i:1756623755;s:46:"../public/hcydxoep/template/default/header.php";i:1756623755;s:46:"../public/hcydxoep/template/default/footer.php";i:1756623755;}*/ ?>
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
  <link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/iconfont/iconfont.css">
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/vue.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/utils/permission.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/composition-api.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/tdesign.min.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/comConfig/comConfig.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/comPagination/comPagination.js"></script>
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
    <t-layout class="aside" id="aside" v-cloak :class="{'is-fold':collapsed}">
      <com-config>
        <div class="header">
          <div class="logo">
            <img :src="logUrl" alt="logo" @click="goIndex">
            <t-button theme="default" shape="square" variant="text" @click.native="changeCollapsed" v-if="!collapsed"
              class="nav-icon">
              <t-icon name="view-list"></t-icon>
            </t-button>
          </div>
          <div class="h-left">
            <t-button theme="default" shape="square" variant="text" @click.native="changeCollapsed" v-if="collapsed"
              class="nav-icon">
              <t-icon name="view-list"></t-icon>
            </t-button>
            <div class="global-search">
              <input type="password" class="com-empty-input">
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
                    {{lang.theme_text3}}
                  </template>
                </t-dropdown-item>
                <t-dropdown-item class="operations-dropdown-container-item" @click="toSafeCenter">
                  <template>
                    <t-icon name="lock-off"></t-icon>
                    {{lang.setting_text106}}
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
            <template slot="closeBtn">
              <t-icon name="close"></t-icon>
            </template>
            <div class="setting-group-title">{{ lang.theme_text1 + lang.theme_mode }}</div>
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
            <div class="setting-group-title">{{ lang.theme_text1 + lang.theme_color }}</div>
            <t-radio-group v-model="formData.brandTheme" class="theme-radio-group">
              <div v-for="(item, index) in COLOR_OPTIONS.slice(0, COLOR_OPTIONS.length)" :key="index"
                class="setting-layout-drawer theme" :class="{no:item!==formData.brandTheme}">
                <t-radio-button :key="index" :value="item" class="setting-layout-color-group"
                  :style="{color:getBrandColor(item,colorList)['@brand-color']}">
                  <template>
                    <div :style="{background:getBrandColor(item,colorList)['@brand-color']}" class="color"></div>
                  </template>
                </t-radio-button>
              </div>
            </t-radio-group>
            <div class="setting-group-title">{{ lang.theme_text2 + lang.theme_color }}</div>
            <t-radio-group v-model="formData.clientTheme" @change="changeClientTheme" class="theme-radio-group">
              <div v-for="item in clientThemeList" :key="item.name" class="setting-layout-drawer theme"
                :class="{no:item!==formData.clientTheme}">
                <t-radio-button :value="item.name" class="setting-layout-color-group" :style="{color:item.color}">
                  <template>
                    <div :style="{background:item.color}" class="color"></div>
                  </template>
                </t-radio-button>
              </div>
              <div
                style="width: 38px;height: 38px;display: flex;align-items: center;justify-content: center; cursor: pointer;"
                @click="()=>{this.$message.warning('如需更多颜色主题，请联系官方QQ:2853266782')}">
                <div
                  style="width: 24px; height: 24px;background-color: var(--td-brand-color); border-radius: 50%;display: flex;align-items: center;justify-content: center;">
                  <t-icon name="add-circle" style="font-size: 24px; color: #fff;"></t-icon>
                </div>
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
                    <t-icon :name="item.icon.replace('t-icon-','')" />
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
                <t-icon :name="item.icon.replace('t-icon-','')" />
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
                    <t-option v-for="item in globalConfig" :value="item.table" :label="item.name" :key="item.table">
                    </t-option>
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
                      :popup-props="{ attach: '#search-key' }">
                    </t-date-picker>
                    <template v-else>
                      <input type="password" class="com-empty-input" />
                      <t-input :placeholder="lang.input" v-model="globalForm.value"
                        @keypress.enter.native="handleGlobal">
                      </t-input>
                    </template>
                  </div>
                  <div class="search" @click="handleGlobal">
                    <t-icon :name="searchLoading ? 'loading' : 'search'"></t-icon>
                  </div>
                </div>
              </div>
            </div>
            <!-- <t-button variant="text" shape="square">
              <t-button variant="text" shape="square" @click.native="changeCollapsed">
                <t-icon name="view-list"></t-icon>
              </t-button>
            </t-button> -->
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

<!-- =======内容区域======= -->
<link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/setting.css">
<div id="content" class="configuration-system" v-cloak>
  <com-config>
    <t-card class="list-card-container">
      <ul class="common-tab">
        <li class="active" v-permission="'auth_system_configuration_system_configuration_system_configuration_view'">
          <a href="javascript:;">{{lang.system_setting}}</a>
        </li>
        <li v-permission="'auth_system_configuration_system_configuration_debug'">
          <a href="configuration_debug.htm">{{lang.debug_setting}}</a>
        </li>
        <li v-permission="'auth_system_configuration_system_configuration_access_configuration_view'">
          <a href="configuration_login.htm">{{lang.login_setting}}</a>
        </li>
        <li v-permission="'auth_system_configuration_system_configuration_oss_management'">
          <a href="configuration_oss.htm">{{lang.oss_setting}}</a>
        </li>
        <li v-permission="'auth_system_configuration_system_configuration_user_api_management'">
          <a href="configuration_api.htm">{{lang.user_api_text1}}</a>
        </li>
        <li v-permission="'auth_system_configuration_system_configuration_system_info_view'">
          <a style="display: flex; align-items: center;" href="configuration_upgrade.htm">{{lang.system_upgrade}}
            <img v-if="isCanUpdata" style="width: 20px; height: 20px; margin-left: 5px;"
              src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/upgrade.svg">
          </a>
        </li>
      </ul>
      <div class="box">
        <p class="com-tit"><span>{{ lang.web_setting }}</span></p>
        <t-form :data="formData" :rules="rules" ref="formValidatorStatus" label-align="top" @submit="onSubmit">
          <t-row :gutter="{ xs: 8, sm: 16, md: 24, lg: 32, xl: 32, xxl: 60 }">
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="website_name" :label="lang.site_name">
                <t-input v-model="formData.website_name" :placeholder="lang.site_name"></t-input>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="website_url" :label="lang.domain">
                <div slot="label" style="display: inline-flex; align-items: center;">
                  <span class="label">{{lang.domain}}</span>
                  <t-tooltip placement="top-right" :content="lang.domain_help" :show-arrow="false" theme="light">
                    <t-icon name="help-circle" size="18px" />
                  </t-tooltip>
                </div>
                <t-input v-model="formData.website_url" :placeholder="lang.domain"></t-input>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="clientarea_url" :label="lang.clientarea_url">
                <div slot="label" class="custom-label">
                  <span class="label">{{lang.clientarea_url}}</span>
                  <t-tooltip placement="top-right" :content="lang.clientarea_url_tip" :show-arrow="false" theme="light">
                    <t-icon name="help-circle" size="18px" />
                  </t-tooltip>
                </div>
                <t-input v-model="formData.clientarea_url" :placeholder="lang.clientarea_url_tip1"></t-input>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="lang_admin" :label="lang.back_language">
                <t-select v-model="formData.lang_admin">
                  <t-option v-for="item in adminArr" :value="item.display_lang" :label="item.display_name"
                    :key="item.display_lang"></t-option>
                </t-select>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="lang_admin" :label="lang.font_language">
                <t-select v-model="formData.lang_home">
                  <t-option v-for="item in homeArr" :value="item.display_lang" :label="item.display_name"
                    :key="item.display_lang"></t-option>
                </t-select>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="terms_service_url" :label="lang.service_address">
                <t-input v-model="formData.terms_service_url" :placeholder="lang.service_address"></t-input>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="terms_privacy_url" :label="lang.privacy_clause_address">
                <t-input v-model="formData.terms_privacy_url" :placeholder="lang.privacy_clause_address"></t-input>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="clientarea_logo_url" :label="lang.logo_url">
                <t-input v-model="formData.clientarea_logo_url" :placeholder="lang.logo_url"></t-input>
              </t-form-item>
            </t-col>
          </t-row>
          <t-row :gutter="{ xs: 8, sm: 16, md: 24, lg: 32, xl: 32, xxl: 60 }">
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="system_logo" :label="lang.member_center + 'LOGO'" :help="`${lang.size}：${lang.width}130px，${lang.height}28px；${lang.logo_size}：≤2M`">
                <t-upload ref="uploadRef3" :size-limit="{ size: 2, unit: 'MB' }" :action="uploadUrl"
                  v-model="formData.system_logo" :auto-upload="true" @fail="handleFail" theme="custom"
                  :headers="uploadHeaders" accept="image/*" :format-response="formatImgResponse">
                  <div class="upload">
                    <t-icon name="add" size="24px"></t-icon>
                    <span class="txt">{{lang.upload_img}}</span>
                  </div>
                </t-upload>
                <div class="logo" v-if="formData.system_logo[0]?.url">
                  <div class="box">
                    <img :src="formData.system_logo[0]?.url" alt="">
                    <div class="hover" @click="deleteLogo" v-if="formData.system_logo[0]?.url">
                      <t-icon name="delete"></t-icon>
                    </div>
                  </div>
                  <!-- <span class="name">{{formData.system_logo[0]?.url.split('^')[1]}}</span> -->
                </div>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="tab_logo" :label="lang.label_page + 'LOGO'" :help="`${lang.size}：${lang.width}32px，${lang.height}32px；${lang.logo_size}：≤2M`">
                <t-upload ref="uploadRef3" :size-limit="{ size: 2, unit: 'MB' }" :action="uploadUrl"
                  v-model="formData.tab_logo" :auto-upload="true" @fail="handleFail" theme="custom"
                  :headers="uploadHeaders" accept="image/*" :format-response="formatImgResponse">
                  <div class="upload">
                    <t-icon name="add" size="24px"></t-icon>
                    <span class="txt">{{lang.upload_img}}</span>
                  </div>
                </t-upload>
                <div class="logo tab" v-if="formData.tab_logo[0]?.url">
                  <div class="box">
                    <img :src="formData.tab_logo[0]?.url" alt="">
                    <div class="hover" @click="deleteTabLogo" v-if="formData.tab_logo[0]?.url">
                      <t-icon name="delete"></t-icon>
                    </div>
                  </div>
                  <!-- <span class="name">{{formData.tab_logo[0]?.url.split('^')[1]}}</span> -->
                </div>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="lang_admin" :label="lang.logo_blank">
                <t-radio-group name="clientarea_logo_url_blank" v-model="formData.clientarea_logo_url_blank">
                  <t-radio value="1">{{lang.blank_page}}</t-radio>
                  <t-radio value="0">{{lang.parent_page}}</t-radio>
                </t-radio-group>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6" class="service">
              <div class="maintain">
                <t-form-item name="lang_admin" :label="lang.maintenance_mode">
                  <t-radio-group name="maintenance_mode" v-model="formData.maintenance_mode">
                    <t-radio value="1">{{lang.open}}</t-radio>
                    <t-radio value="0">{{lang.close}}</t-radio>
                  </t-radio-group>
                </t-form-item>
                <t-form-item v-if="formData.maintenance_mode == '1'" :label="lang.maintenance_mode_info"
                  name="maintenance_mode_message">
                  <t-textarea :placeholder="lang.maintenance_mode_info" v-model="formData.maintenance_mode_message" />
                </t-form-item>
              </div>
            </t-col>
          </t-row>
          <!-- 基础设置 -->
          <p class="com-tit"><span>{{ lang.basic_setting }}</span></p>
          <t-row :gutter="{ xs: 8, sm: 16, md: 24, lg: 32, xl: 32, xxl: 60 }">
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="client_start_id_value" :label="lang.client_start_id">
                <t-input-number v-model="formData.client_start_id_value" :placeholder="lang.client_start_id"
                  theme="normal" :max="99999999" :min="1" :decimal-places="0"></t-input-number>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="order_start_id_value" :label="lang.order_start_id">
                <t-input-number v-model="formData.order_start_id_value" :placeholder="lang.order_start_id"
                  theme="normal" :max="99999999" :min="1" :decimal-places="0"></t-input-number>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6" v-if="client_custom_field_list.length !== 0">
              <t-form-item name="client_custom_field" :label="lang.client_custom_label35">
                <div slot="label" class="custom-label">
                  <span class="label">{{lang.client_custom_label35}}</span>
                  <t-tooltip placement="top-right" :content="lang.client_custom_label36" :show-arrow="false"
                    theme="light">
                    <t-icon name="help-circle" size="18px" />
                  </t-tooltip>
                </div>
                <t-select v-model="formData.customfield.client_custom_field.id" clearable>
                  <t-option v-for="item in client_custom_field_list" :value="item.id" :label="item.name" :key="item.id">
                  </t-option>
                </t-select>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="lang_admin" :label="lang.account_change">
                <div slot="label" class="custom-label">
                  <span class="label">{{lang.account_change}}</span>
                  <t-tooltip placement="top-right" :content="lang.client_custom_label37" :show-arrow="false"
                    theme="light">
                    <t-icon name="help-circle" size="18px" />
                  </t-tooltip>
                </div>
                <t-select v-model="formData.prohibit_user_information_changes" :min-collapsed-num="2" multiple
                  clearable>
                  <t-option v-for="item in user_information_fields" :value="item.id" :label="item.name" :key="item.id">
                  </t-option>
                </t-select>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="ip_white_list">
                <div slot="label" class="custom-label">
                  <span class="label">{{lang.ip_white_list}}</span>
                  <t-tooltip placement="top-right" :show-arrow="false" theme="light">
                    <template #content>
                      <div>{{lang.ip_white_list_help1}}</div>
                      <div>{{lang.ip_white_list_help2}}</div>
                      <div>{{lang.ip_white_list_help3}}</div>
                    </template>
                    <t-icon name="help-circle" size="18px" />
                  </t-tooltip>
                </div>
                <t-textarea :placeholder="lang.ip_white_list_tip" v-model="formData.ip_white_list"></t-textarea>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="global_list_limit" :label="lang.global_list_num">
                <t-input-number v-model="formData.global_list_limit" :placeholder="lang.global_default_num"
                  theme="normal" :max="500" :min="1" :decimal-places="0">
                  <template #suffix><span>{{lang.global_per_page}}</span></template>
                </t-input-number>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="lang_admin" :label="lang.isAllowChooseLan">
                <t-radio-group name="creating_notice_sms" v-model="formData.lang_home_open">
                  <t-radio value="1">{{lang.allow}}</t-radio>
                  <t-radio value="0">{{lang.prohibit}}</t-radio>
                </t-radio-group>
              </t-form-item>
            </t-col>
            <t-col :xs="12" :xl="3" :md="6">
              <t-form-item name="lang_admin" :label="lang.show_del_order">
                <t-radio-group name="home_show_deleted_host" v-model="formData.home_show_deleted_host">
                  <t-radio value="1">{{lang.show_del_yes}}</t-radio>
                  <t-radio value="0">{{lang.show_del_no}}</t-radio>
                </t-radio-group>
              </t-form-item>
            </t-col>
          </t-row>
          <t-form-item class="com-is-fixed broaden" :class="{'has-shadow': !footerInView}">
            <t-button theme="primary" type="submit" :loading="submitLoading"
              v-permission="'auth_system_configuration_system_configuration_system_configuration_save_configuration'">
              {{lang.hold}}
            </t-button>
          </t-form-item>
        </t-form>
      </div>
    </t-card>
  </com-config>
</div>
<!-- =======页面独有======= -->

<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/api/setting.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/configuration_system.js"></script>
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

