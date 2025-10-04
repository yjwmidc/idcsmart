<?php /*a:3:{s:44:"../public/hcydxoep/template/default/host.php";i:1756623755;s:46:"../public/hcydxoep/template/default/header.php";i:1756623755;s:46:"../public/hcydxoep/template/default/footer.php";i:1756623755;}*/ ?>
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

<link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/client.css">
<!-- =======内容区域======= -->
<div id="content" class="host" v-cloak>
  <com-config>
    <t-card class="list-card-container">
      <ul class="common-tab">
        <li v-for="item in tabList" :key="item.value" :class="params.tab === item.value ? 'active' : ''"
          @click="changeHostTab(item.value)">
          <a href="javascript:;">{{item.label }}</a>
        </li>
      </ul>
      <div class="common-header">
        <template v-if="params.tab !== 'failed'">
          <div class="flex">
            <t-button :loading="pullLoading" @click="handlePull">
              {{lang.data_export_tip10}}
            </t-button>
            <t-button @click="batchDel" class="add" theme="danger"
              v-if="$checkPermission('auth_user_detail_host_info_batch_delete')">
              {{lang.batch_dele}}
            </t-button>
            <t-button theme="default" :loading="exportLoading" class="add com-gray-btn" @click="exportVisible = true"
              v-if="$checkPermission('auth_business_host_export_excel') && hasExport">
              {{lang.data_export}}
            </t-button>
          </div>
          <div class="right-search">
            <div class="flex view-filed" v-if="!isAdvance">
              <!-- 选择视图 -->
              <t-tooltip :show-arrow="false" theme="light" placement="top-left" overlay-class-name="view-change-tip">
                <template slot="content">
                  <p>{{lang.field_tip1}}</p>
                  <p>{{lang.field_tip2}}</p>
                  <p>{{lang.field_tip3}}</p>
                  <p>{{lang.field_tip4}}</p>
                </template>
                <t-icon name="help-circle" class="view-tip"></t-icon>
              </t-tooltip>
              <!-- :class="{'not-default': params.view_id !== defaultId}" -->
              <t-select :value="params.view_id" :label="lang.view_filed + ':'" class="choose-view not-default"
                @change="chooseView" :popup-props="{ overlayClassName: `view-select`}">
                <t-option v-for="item in admin_view_list" :value="item.id" :label="item.name" :key="item.id">
                </t-option>
                <div class="bot-opt" slot="panelBottomContent">
                  <t-option key="new" value="new" :label="lang.field_add_view"></t-option>
                  <t-option key="manage" value="manage" :label="lang.field_manage_view"></t-option>
                </div>
              </t-select>
              <!-- 选择视图 end -->
              <t-select v-model="searchType" class="com-list-type" @change="changeType">
                <t-option v-for="item in calcTypeSelect" :value="item.value" :label="item.label" :key="item.value">
                </t-option>
              </t-select>
              <t-input v-model="params.keywords" class="search-input" :placeholder="lang.input"
                @keypress.enter.native="search" clearable v-show="searchType !== 'product_id' && searchType !== 'sale'"
                @clear="clearKey('keywords')" :maxlength="30" show-limit-number>
              </t-input>
              <input class="com-empty-input"></input>
              <com-tree-select v-show="searchType === 'product_id'" :multiple="true" :autowidth="true"
                :value="params.product_id" @choosepro="choosePro">
              </com-tree-select>
              <!-- 选择销售 -->
              <t-select v-model="curSaleId" :placeholder="lang.please_choose_sale" clearable
                v-show="hasSale && searchType === 'sale'">
                <t-option v-for="item in allSales" :value="item.id" :label="item.name" :key="item.name">
                </t-option>
              </t-select>
              <t-button @click="search">{{lang.query}}</t-button>
            </div>
            <div class="view-filed" v-if="isAdvance" style="margin-right: -10px;">
              <t-tooltip :show-arrow="false" theme="light" placement="top-left" overlay-class-name="view-change-tip">
                <template slot="content">
                  <p>{{lang.field_tip1}}</p>
                  <p>{{lang.field_tip2}}</p>
                  <p>{{lang.field_tip3}}</p>
                  <p>{{lang.field_tip4}}</p>
                </template>
                <t-icon name="help-circle" class="view-tip"></t-icon>
              </t-tooltip>
              <t-select :value="params.view_id" :label="lang.view_filed + ':'" class="choose-view not-default"
                @change="chooseView" :popup-props="{ overlayClassName: `view-select`}">
                <t-option v-for="item in admin_view_list" :value="item.id" :label="item.name" :key="item.id">
                </t-option>
                <div class="bot-opt" slot="panelBottomContent">
                  <t-option key="new" value="new" :label="lang.field_add_view"></t-option>
                  <t-option key="manage" value="manage" :label="lang.field_manage_view"></t-option>
                </div>
              </t-select>
            </div>
            <t-button @click="changeAdvance" style="margin-left: 16px;" theme="primary" variant="outline">
              {{isAdvance ? lang.pack_up : lang.advanced_filter}}
            </t-button>
            <com-view-filed view="host" @changefield="changeField" ref="customFiled"></com-view-filed>
          </div>
        </template>
        <!-- 手动处理 -->
        <template v-else>
          <div class="flex">
            <t-button @click="handleBatchRetry" class="add" :loading="batchRetryLoading">
              {{lang.retry_batch}}
            </t-button>
          </div>
          <div class="right-search">
            <t-select v-model="params.action" :placeholder="lang.choose_failed_action" @change="search" clearable
              @clear="search">
              <t-option v-for="item in failAction" :value="item.value" :label="item.label" :key="item.value">
              </t-option>
            </t-select>
            <input class="com-empty-input" type="password"></input>
            <t-input v-model="params.keywords" class="failed-input" :placeholder="lang.failed_tip1"
              @keypress.enter.native="search" clearable @clear="clearKey('keywords')" :maxlength="30" show-limit-number>
            </t-input>
            <t-button @click="search">{{lang.query}}</t-button>
          </div>
        </template>

      </div>
      <div class="advanced" v-show="isAdvance">
        <div class="edit-view">
          <t-button class="add" v-if="viewFiledNum && data_range_switch"
            @click="handleEditView">{{lang.view_data_range}}({{viewFiledNum}})</t-button>
        </div>
        <div class="search">
          <input type="password" style="width: 0; height: 0; opacity: 0;position: absolute;">
          <t-input v-model="params.host_id" class="search-input" :placeholder="`${lang.input}${lang.tailorism}ID`"
            @keypress.enter.native="search" clearable @clear="clearKey('host_id')">
          </t-input>
          <t-input v-model="params.username" class="search-input" :placeholder="`${lang.input}${lang.username}`"
            @keypress.enter.native="search" clearable @clear="clearKey('username')">
          </t-input>
          <com-tree-select :value="params.product_id" :multiple="true" :autowidth="true" @choosepro="choosePro">
          </com-tree-select>
          <!-- 选择模块 -->
          <t-select v-model="params.module" :placeholder="lang.nav_text9" clearable @clear="clearKey('module')">
            <t-option v-for="item in moduleList" :value="item.name" :label="item.display_name" :key="item.name">
            </t-option>
          </t-select>
          <!-- 选择模块 end -->
          <t-input v-model="params.name" class="search-input" :placeholder="`${lang.input}${lang.products_token}`"
            @keypress.enter.native="search" clearable @clear="clearKey('name')">
          </t-input>
          <!-- 到期时间 -->
          <!-- <t-select v-model="params.due_time" :placeholder="lang.please_choose_due" clearable>
            <t-option v-for="item in dueTimeArr" :value="it
            em.value" :label="item.label" :key="item.value">
            </t-option>
          </t-select> -->
          <t-date-range-picker allow-input clearable v-model="range" enable-time-picker :presets="presets">
          </t-date-range-picker>
          <t-input v-model="params.first_payment_amount" class="search-input"
            :placeholder="`${lang.input}${lang.buy_amount}`" @keypress.enter.native="search" clearable
            @clear="clearKey('first_payment_amount')">
          </t-input>
          <t-input v-model="params.ip" class="search-input" :placeholder="`${lang.input}IP`"
            @keypress.enter.native="search" clearable @clear="clearKey('ip')">
          </t-input>
          <!-- 选择销售 -->
          <t-select v-model="curSaleId" :placeholder="lang.please_choose_sale" clearable v-show="hasSale">
            <t-option v-for="item in allSales" :value="item.id" :label="item.name" :key="item.name">
            </t-option>
          </t-select>
          <t-button @click="search">{{lang.query}}</t-button>
        </div>
      </div>
      <t-table row-key="id" :data="calcList" size="medium" :columns="params.tab === 'failed' ? manualColumns  : columns"
        resizable :hover="hover" :loading="loading" :table-layout="tableLayout ? 'auto' : 'fixed'"
        :hide-sort-tips="true" @sort-change="sortChange" @column-resize-change="resizeChange"
        @select-change="rehandleSelectChange" :selected-row-keys="checkId">
        <template slot="sortIcon">
          <t-icon name="caret-down-small"></t-icon>
        </template>
        <template #sale="{row}">
          <span>{{row.sale || '--'}}</span>
        </template>
        <template #username_company="{row}">
          <t-tooltip :show-arrow="false" :content="calcDevloper(row.developer_type)" theme="light"
            v-if="row.developer_type">
            <svg class="common-look">
              <use xlink:href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/icon/icons.svg#cus-developer">
              </use>
            </svg>
          </t-tooltip>
          <login-by-user :id="row.client_id" :website_url="website_url">
            <a :href="`client_detail.htm?client_id=${row?.client_id}`" class="aHover">
              <span v-if="row.client_name">{{row.client_name}}</span>
              <span v-if="row.company">({{row.company}})</span>
            </a>
          </login-by-user>
        </template>
        <template #client_id="{row}">
          <a :href="`client_detail.htm?client_id=${row.client_id}`" class="aHover">{{row.client_id}}</a>
        </template>
        <template #certification="{row}">
          <t-tooltip :show-arrow="false" theme="light">
            <span slot="content">{{!row.certification ? lang.real_tip8 : row.certification_type === 'person' ?
                      lang.real_tip9 : lang.real_tip10}}</span>
            <t-icon :class="row.certification ? 'green-icon' : ''"
              :name="!row.certification ? 'user-clear': row.certification_type === 'person' ? 'user' : 'usergroup'" />
          </t-tooltip>
        </template>
        <template #client_status="{row}">
          <t-tag theme="success" class="com-status" v-if="row.status" variant="light">{{lang.enable}}</t-tag>
          <t-tag theme="danger" class="com-status" v-else variant="light">{{lang.deactivate}}</t-tag>
        </template>
        <template #renew_amount_cycle="{row}">
          <template v-if="row.billing_cycle">
            {{currency_prefix}}&nbsp;{{row.renew_amount | filterMoney}}<span>/</span>{{row.billing_cycle_name}}
          </template>
          <template v-else>
            {{currency_prefix}}&nbsp;{{row.first_payment_amount}}/{{lang.onetime}}
          </template>
        </template>
        <template #first_payment_amount="{row}">
          {{currency_prefix}}&nbsp;{{row.first_payment_amount | filterMoney}}
        </template>
        <template #base_price="{row}">
          {{currency_prefix}}&nbsp;{{row.base_price}}
        </template>
        <template #billing_cycle="{row}">
          {{billingCycle[row.billing_cycle]}}
        </template>
        <template #reg_time="{row}">
          {{row.reg_time ? moment(row.reg_time * 1000).format('YYYY-MM-DD HH:mm') : ''}}
        </template>
        <template #product_name_status="{row}">
          <div class="com-pro-name">
            <t-tag theme="default" variant="light" v-if="row.status==='Cancelled'"
              class="canceled">{{lang.canceled}}</t-tag>
            <t-tag theme="danger" variant="light" v-if="row.status==='Unpaid'">{{lang.Unpaid}}</t-tag>
            <t-tag theme="primary" variant="light" v-if="row.status==='Pending'">{{lang.Pending}}</t-tag>
            <t-tag theme="success" variant="light" v-if="row.status==='Active'">{{lang.Active}}</t-tag>
            <t-tag theme="danger" variant="light" v-if="row.status==='Failed'">{{lang.Failed}}</t-tag>
            <t-tag theme="default" variant="light" v-if="row.status==='Suspended'">{{lang.Suspended}}</t-tag>
            <t-tag theme="default" variant="light" v-if="row.status==='Deleted'" class="delted">{{lang.Deleted}}</t-tag>
            <t-tag theme="default" variant="light" v-if="row.status==='Grace'"
              class="grace-tag">{{lang.product_set_text127}}</t-tag>
            <t-tag theme="default" variant="light" v-if="row.status==='Keep'"
              class="keep-tag">{{lang.product_set_text128}}</t-tag>
            <a :href="`host_detail.htm?client_id=${row.client_id}&id=${row.id}`" @click="goHostDetail(row)"
              class="aHover" v-if="$checkPermission('auth_business_host_check_host_detail')" style="margin-left: 3px;">
              {{row.product_name}}
            </a>
            <span v-else style="margin-left: 3px;">{{row.product_name}}</span>
          </div>
          <span class="com-base-info" v-if="row.base_info">{{row.base_info}}</span>
        </template>
        <template #ip="{row}">
          {{row.dedicate_ip || '--'}}
          <t-popup placement="top" trigger="hover">
            <template #content>
              <div class="ips">
                <p v-for="(item,index) in row.allIp" :key="index">
                  {{item}}
                  <svg class="common-look" @click="copyIp(item)">
                    <use xlink:href="#icon-copy">
                    </use>
                  </svg>
                </p>
              </div>
            </template>
            <span v-if="row.ip_num > 1 && $checkPermission('auth_business_host_check_host_detail')" class="showIp">
              ({{row.ip_num}})
            </span>
          </t-popup>
          <svg class="common-look" v-if="row.ip_num > 0 && $checkPermission('auth_business_host_check_host_detail')"
            @click="copyIp(row.allIp)">
            <use xlink:href="#icon-copy">
            </use>
          </svg>
          <span v-if="row.ip_num > 1 && !$checkPermission('auth_business_host_check_host_detail')" class="showIp"
            style="cursor: inherit;">
            ({{row.ip_num}})
          </span>
        </template>
        <template #host_name="{row}">
          {{row.name}}
        </template>
        <template #id="{row}">
          <a :href="`host_detail.htm?client_id=${row.client_id}&id=${row.id}`" @click="goHostDetail(row)" class="aHover"
            v-if="$checkPermission('auth_business_host_check_host_detail')">
            {{row.id}}
          </a>
          <span v-else>{{row.id}}</span>
        </template>
        <template #active_time="{row}">
          <span>{{row.active_time ===0 ? '-' : moment(row.active_time * 1000).format('YYYY/MM/DD HH:mm')}}</span>
        </template>
        <template #due_time="{row}">
          <span>{{row?.due_time ===0 ? '-' : moment(row?.due_time * 1000).format('YYYY/MM/DD HH:mm')}}</span>
        </template>
        <template #failed_action_trigger_time="{row}">
          <span>{{row?.failed_action_trigger_time ===0 ? '-' : moment(row?.failed_action_trigger_time * 1000).format('YYYY/MM/DD HH:mm')}}</span>
        </template>
        <template #failed_action="{row}">
          {{calcActionName(row.failed_action)}}
        </template>
        <template #op="{row}">
          <!-- <a class="common-look" style="position: relative;" v-loading="row.retryIng" @click="handleRetry(row)"
            v-if="row.retry === 1">{{lang.retry}}</a>
          <a class="common-look" @click="handleMark(row)">{{lang.failed_tip2}}</a> -->

          <span class="com-mix-btn">
            <t-tooltip :content="lang.failed_tip2" :show-arrow="false" theme="light">
              <i class="iconfont icon-shoudong" @click="handleMark(row)"></i>
            </t-tooltip>
            <t-tooltip :content="lang.retry" :show-arrow="false" theme="light" v-if="row.retry === 1"
              v-loading="row.retryIng">
              <i class="iconfont icon-retry" @click="handleRetry(row)"></i>
            </t-tooltip>
          </span>

        </template>
        <template #footer-summary v-if="params.tab !== 'failed'">
          <div class="page-total-amount" v-if="total">
            <div class="amount-item">
              {{lang.page_total_renew_amount}}：<span
                class="amount-num">{{currency_prefix}}{{page_total_renew_amount}}</span>
            </div>
            <div class="amount-item">
              {{lang.total_renew_amount}}：<span class="amount-num">{{currency_prefix}}{{total_renew_amount}}</span>
            </div>
          </div>
        </template>
      </t-table>
      <com-pagination v-if="total" :total="total" :page="params.page" :limit="params.limit" @page-change="changePage">
      </com-pagination>
      <t-dialog :header="lang.data_export" :visible.sync="exportVisible" :footer="false">
        <div style="margin-bottom: 20px;">
          <div>{{lang.data_export_tip2}},{{lang.data_export_tip3}}<span
              style="color: var(--td-brand-color);">{{total}}</span>{{lang.data_export_tip4}}</div>
          <div style="margin-top:20px; color: var(--td-text-color-placeholder);">
            <span style="margin-right: var(--td-comp-margin-xs);
              color: var(--td-error-color);
              line-height: var(--td-line-height-body-medium);">*</span>
            {{lang.data_export_tip5}}
          </div>
          <div style="margin-bottom: 15px; color: var(--td-text-color-placeholder);">
            <span style="margin-right: var(--td-comp-margin-xs);
              color: var(--td-error-color);
              line-height: var(--td-line-height-body-medium);">*</span>
            {{lang.data_export_tip6}}
          </div>
        </div>
        <div class="com-f-btn">
          <t-button theme="primary" type="submit" :loading="exportLoading"
            @click="handelDownload">{{ exportLoading ? lang.data_export_tip8 : lang.data_export_tip7}}</t-button>
          <t-button theme="default" variant="base" @click="exportVisible = false">{{lang.cancel}}</t-button>
        </div>
      </t-dialog>
      <safe-confirm ref="safeRef" :password.sync="admin_operate_password" @confirm="hadelSafeConfirm"></safe-confirm>
      <!-- 删除 -->
      <t-dialog theme="warning" :header="lang.delHostTips" :close-btn="false" :visible.sync="delVisible">
        <t-checkbox v-model="module_delete">{{lang.delHostCheck}}</t-checkbox>
        <template slot="footer">
          <div class="common-dialog">
            <t-button @click="onConfirm" :loading="submitLoading">{{lang.sure}}</t-button>
            <t-button theme="default" @click="delVisible=false">{{lang.cancel}}</t-button>
          </div>
        </template>
      </t-dialog>
      <!-- 标记已处理 -->
      <t-dialog :header="lang.failed_tip2" :visible.sync="markDialog" class="mark-dialog">
        <div class="host-info">
          <p class="item">
            <span class="label">{{lang.tailorism}}ID：</span>
            <span class="value">{{curMarkObj.id}}</span>
          </p>
          <p class="item">
            <span class="label">{{lang.product_name}}：</span>
            <span class="value">{{curMarkObj.name}}</span>
          </p>
          <p class="item">
            <span class="label">{{lang.status}}：</span>
            <span class="value">{{calcStatusName(curMarkObj.status)}}</span>
          </p>
          <p class="item">
            <span class="label">{{lang.failed_action}}：</span>
            <span class="value">{{calcActionName(curMarkObj.failed_action)}}</span>
          </p>
          <p class="item">
            <span class="label">{{lang.failed_reason}}：</span>
            <span class="value">{{curMarkObj.failed_action_reason}}</span>
          </p>
        </div>
        <template slot="footer">
          <div class="common-dialog">
            <t-button @click="submitMark" :loading="submitLoading">{{lang.sure}}</t-button>
            <t-button theme="default" @click="markDialog=false">{{lang.cancel}}</t-button>
          </div>
        </template>
      </t-dialog>
      <!-- 批量拉取商品 -->
      <t-dialog :header="lang.data_export_tip11" :visible.sync="pullVisible" :footer="false">
        <t-form :data="batchPullForm" :rules="rules" ref="pullForm" @submit="submitPull">
          <t-form-item :label="lang.temp_host" name="product_id">
            <com-tree-select :multiple="true" :value="batchPullForm.product_id" @choosepro="choosePullPro"
              style="width: 100%;">
            </com-tree-select>
          </t-form-item>
          <t-form-item :label="lang.client_care_label29" name="host_status">
            <t-checkbox-group v-model="batchPullForm.host_status">
              <t-checkbox key="Active" value="Active" :label="lang.opened_notice"></t-checkbox>
              <t-checkbox key="Suspended" value="Suspended" :label="lang.Suspended"></t-checkbox>
            </t-checkbox-group>
          </t-form-item>
          <div class="com-f-btn">
            <t-button theme="primary" type="submit" :loading="submitLoading">{{lang.hold}}</t-button>
            <t-button theme="default" variant="base" @click="pullVisible = false">{{lang.cancel}}</t-button>
          </div>
        </t-form>
      </t-dialog>
    </t-card>
  </com-config>
</div>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/comViewFiled/comViewFiled.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/comTreeSelect/comTreeSelect.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/safeConfirm/safeConfirm.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/loginByUser/loginByUser.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/api/client.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/host.js"></script>
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

