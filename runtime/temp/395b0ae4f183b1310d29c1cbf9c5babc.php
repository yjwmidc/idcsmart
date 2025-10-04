<?php /*a:3:{s:50:"../public/hcydxoep/template/default/navigation.php";i:1756623755;s:46:"../public/hcydxoep/template/default/header.php";i:1756623755;s:46:"../public/hcydxoep/template/default/footer.php";i:1756623755;}*/ ?>
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

<link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/navigation.css">
<link rel="stylesheet" href="/upload/common/iconfont/iconfont.css">
<div id="content" class="navigation " v-cloak>
  <com-config>
    <t-card class="list-card-container table">
      <ul class="common-tab">
        <li :class="{active: value == 1}" @click="menuChange(1)"
          v-if="$checkPermission('auth_system_configuration_menu_home_menu_view')">
          <a href="javascript:;">{{lang.front_nav_manage}}</a>
        </li>
        <li :class="{active: value == 2}" @click="menuChange(2)"
          v-if="$checkPermission('auth_system_configuration_menu_admin_menu_view')">
          <a href="javascript:;">{{lang.admin_navigation}}</a>
        </li>
      </ul>
      <!-- 前台导航 -->
      <template v-if="value == 1">
        <t-button class="new_menu_btn" @click="showNewMenuDialog">{{lang.new_page}}</t-button>
        <div class="nav_main">
          <t-loading :loading="homeMenuLoading">
            <div class="nav_left">
              <draggable animation="300" :move="onMove" v-model="menuList" handle=".mover" force-fallback="true"
                @start="onStart" @end="onEnd" group="level2" chosen-class="chosen" ghost-class="ghost">
                <transition-group style="min-height: 10px;display:block;">
                  <div class="item" @click="moveId = 0" v-for="item in menuList" :key="item.id">
                    <!-- 一级导航 -->
                    <div v-show="item.id === moveId && isMove" class="before"
                      :class="isLv1?'lv1-padding':'lv2-padding'">
                      <div class="circle"></div>
                      <div class="line"></div>
                    </div>
                    <div class="level_1" :class="activeId === item.id?'active':''" @click="itemClick(item)"
                      @mousedown.stop="getMouseDown($event,item)" @mousemove.stop=" getMouseMove($event)">
                      <!-- <img v-if="item.icon && value==1" class="front-icon" :src="'/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/menu/'+item.icon +'.png'" /> -->
                      <t-icon name="move" class="mover"></t-icon>
                      <i v-if="item.icon && value==1" class="front-icon iconfont" :class="item.icon"></i>
                      <span v-else class="level_icon"></span>
                      <span class="lv1-text" :title="item.name.length >7?item.name:''">{{item.name}}</span>
                    </div>
                    <draggable animation="300" force-fallback="true" handle=".mover" v-model="item.child" group="level2"
                      :move="lv2OnMove" @start="onStart" @end="onEnd" chosen-class="chosen" ghost-class="ghost">
                      <transition-group style="min-height: 10px;display:block;">
                        <!-- 二级导航 -->
                        <div class="lv-2-item" @click="moveId = 0" v-for="children in item.child" :key="children.id">
                          <div v-show="children.id === moveId && isMove" class="before"
                            :class="isLv1?'lv1-padding':'lv2-padding'">
                            <div class="circle"></div>
                            <div class="line"></div>
                          </div>
                          <div :title="children.name.length >7?children.name:''" class="level_2 lv2-text"
                            :class="activeId === children.id?'active':''" @click="itemClick(children)"
                            @mousedown.stop="getMouseDown($event,children)" @mousemove.stop=" getMouseMove($event)">
                            <t-icon name="move" class="mover"></t-icon>
                            {{children.name}}
                          </div>
                        </div>

                      </transition-group>
                    </draggable>
                  </div>
                </transition-group>
              </draggable>
            </div>
          </t-loading>
          <div class="nav_right">
            <div class="menu_set" v-show="isShowSet">
              <t-form :data="formData" label-align="top" :label-width="60" @submit="saveSet">
                <t-form-item name="type" :label="lang.page_type">
                  <t-select v-model="formData.type" @change="typeChange">
                    <t-option v-for="item in menuType" :key="item.id" :label="item.label" :value="item.value" />
                  </t-select>
                </t-form-item>
                <t-form-item
                  v-show="(formData.type !== 'custom') && (formData.type !== 'module') && (formData.type !== 'res_module')"
                  name="url" :label="lang.select_page">
                  <!-- 系统页面 -->
                  <t-select v-if="formData.type == 'system'" v-model="formData.nav_id" @change="urlSelectChange">
                    <t-option v-for="item in selectList" :key="item.id" :value="item.id" :label="item.name" />
                  </t-select>
                  <!-- 插件 -->
                  <t-select v-if="formData.type == 'plugin'" v-model="formData.nav_id" @change="urlSelectChange">
                    <t-option-group v-for="(list,index) in selectList" :key="index" :label="list.title" divider>
                      <t-option v-for="item in list.navs" :value="item.id" :key="item.id" :label="item.name"></t-option>
                    </t-option-group>
                  </t-select>
                  <!-- 模块 -->
                  <t-select v-if="formData.type == 'module'" v-model="formData.url" @change="urlSelectChange">
                    <t-option v-for="(item,index) in moduleList" :key="item.index" :value="item.name"
                      :label="item.display_name" />
                  </t-select>
                </t-form-item>
                <t-form-item v-show="formData.type == 'module' || formData.type == 'res_module'" name="url"
                  :label="lang.module_type">
                  <!-- <t-select v-model="formData.module" @change="moduleChange">
                      <t-option v-for="(item,index) in calcMoudleList(formData.type)" :key="index" :value="item.name" :label="item.display_name" />
                    </t-select> -->
                  <t-select v-model="formData.multiple" :min-collapsed-num="1" @change="moduleChange" multiple>
                    <t-option v-for="(item,index) in mergeModule" :key="item.key" :value="item.key"
                      :label="item.display_name" :disabled="calcDisabled(item.key, 'formData')">
                    </t-option>
                  </t-select>
                </t-form-item>
                <template v-if="formData.type == 'module' || formData.type == 'res_module'">
                  <t-checkbox @change="saveSet" v-model="formData.show_quick_order">{{lang.module_gooods}}
                  </t-checkbox>
                  <t-form-item v-if="formData.show_quick_order" name="quick_order_url" :label="lang.module_gooods_url">
                    <t-input v-model="formData.quick_order_url" @blur="saveSet"
                      :placeholder="lang.module_gooods_url_tip">
                    </t-input>
                  </t-form-item>
                </template>
                <t-form-item v-show="formData.type == 'custom'" name="url" :label="lang.url_address" class="custom-url">
                  <t-input v-model="formData.url" @blur="urlInputChange"></t-input>
                  <div class="second">
                    <p>
                      <t-checkbox v-model="formData.second_reminder"
                        @change="saveSet()">{{lang.second_reminder}}</t-checkbox>
                    </p>
                    <p class="tip">{{lang.nav_text15}}</p>
                  </div>
                </t-form-item>
                <t-form-item name="icon" :label="lang.icon_code">
                  <t-popup placement="right-top" :visible="popupVisible">
                    <t-input class="icon-input" v-model="formData.icon">
                      <i class="iconfont" :class="formData.icon" slot="prefix-icon"></i>
                      <span @click="showIconList" class="icon-btn" slot="suffix-icon">{{lang.choose}}</span>
                    </t-input>
                    <template #content>
                      <div class="all-icon">
                        <div class="icon-top">
                          <div class="top-text">{{lang.icon}}</div>
                          <t-icon class="close" name="close" @click="popupVisible = false" />
                        </div>
                        <div class="main-icons">
                          <i @click="iconClick(item)" class="iconfont main-icons-item" v-for="item in iconsData"
                            :key="item.icon_id"
                            :class="item.font_class==formData.icon?'active ' + item.font_class:item.font_class"></i>
                          <!-- <i @click="iconClick(item)" class="iconfont main-icons-item" v-for="item in iconsData" :key="item.icon_id">
                              <svg class="icon" aria-hidden="true">
                                <use :xlink:href="`#icon-${item.font_class}`"></use>
                              </svg>
                            </i> -->
                        </div>
                      </div>
                    </template>
                  </t-popup>
                </t-form-item>
                <t-form-item name="name" :label="lang.navigate_name">
                  <t-input v-model="formData.name" :maxlength="8" @blur="nameInputChange"></t-input>
                </t-form-item>
                <t-form-item name="product_id" :label="lang.order_hosts" v-if="formData.type == 'module'"
                  :key="itemNum">
                  <t-tree-select @change="saveSet" :min-collapsed-num="1" v-model="formData.product_id"
                    :data="productList" :tree-props="treeProps" multiple clearable :placeholder="lang.select">
                  </t-tree-select>
                </t-form-item>
                <t-checkbox v-model="formData.isChecked" v-show="language.length>1"
                  @change="changeCheck">{{lang.multilingual}}</t-checkbox>
                <div v-show="formData.isChecked">
                  <t-form-item name="language" v-for="item in language" :key="item.display_lang"
                    :label="item.display_name">
                    <t-input v-model="formData.language[item.display_lang]"></t-input>
                  </t-form-item>
                </div>
                <t-form-item>
                  <div class="form-footer">
                    <!-- <t-button theme="primary" type="submit" class="btn-ok">保存</t-button> -->
                    <t-button theme="default" @click="delNav" class="btn-no">{{lang.delete}}</t-button>
                  </div>
                </t-form-item>
              </t-form>
            </div>
            <t-button class="sure_sub" @click="subMenu" :loading="submitLoading"
              v-permission="'auth_system_configuration_menu_home_menu_save_menu'">{{lang.apply_nav}}</t-button>
          </div>
        </div>
      </template>
      <!-- 后台导航 -->
      <template v-if="value == 2">
        <t-button class="new_menu_btn" @click="showNewMenuDialog">{{lang.create_page}}</t-button>
        <div class="nav_main">
          <t-loading :loading="adminMenuLoading">
            <div class="nav_left">
              <draggable animation="300" :move="onMove" v-model="menuList" force-fallback="true" handle=".mover"
                @start="onStart" @end="onEnd" group="level2" chosen-class="chosen" ghost-class="ghost">
                <transition-group style="min-height: 10px;display:block;">
                  <div @click="moveId = 0" class="item" v-for="item in menuList" :key="item.id">
                    <!-- 一级导航 -->
                    <div v-show="item.id === moveId && isMove" class="before"
                      :class="isLv1?'lv1-padding':'lv2-padding'">
                      <div class="circle"></div>
                      <div class="line"></div>
                    </div>
                    <div class="level_1" :class="activeId === item.id?'active':''" @click="itemClick(item)"
                      @mousedown.stop="getMouseDown($event,item)" @mousemove.stop=" getMouseMove($event)">
                      <t-icon name="move" class="mover"></t-icon>
                      <t-icon v-if="item.icon" class="back-icon" :name="item.icon.replace('t-icon-','')"></t-icon>
                      <span v-else class="level_icon"></span>
                      <span class="lv1-text" :title="item.name.length >7?item.name:''">{{item.name}}</span>
                    </div>
                    <draggable animation="300" force-fallback="true" handle=".mover" v-model="item.child" group="level2"
                      :move="lv2OnMove" @start="onStart" @end="onEnd" chosen-class="chosen" ghost-class="ghost">
                      <transition-group style="min-height: 10px;display:block;">
                        <!-- 二级导航 -->
                        <div @click="moveId = 0" class="lv-2-item" v-for="children in item.child" :key="children.id">
                          <div v-show="children.id === moveId && isMove" class="before"
                            :class="isLv1?'lv1-padding':'lv2-padding'">
                            <div class="circle"></div>
                            <div class="line"></div>
                          </div>
                          <div class="level_2 lv2-text" :title="children.name.length >7?children.name:''"
                            :class="activeId === children.id?'active':''" @click="itemClick(children)"
                            @mousedown.stop="getMouseDown($event,children)" @mousemove.stop=" getMouseMove($event)">
                            <t-icon name="move" class="mover"></t-icon>
                            {{children.name}}
                          </div>
                        </div>

                      </transition-group>
                    </draggable>
                  </div>
                </transition-group>
              </draggable>
            </div>
          </t-loading>
          <div class="nav_right">
            <div class="menu_set" v-show="isShowSet">
              <t-form :data="formData" label-align="top" :label-width="60" @submit="saveSet">
                <t-form-item name="type" :label="lang.page_type">
                  <t-select v-model="formData.type" @change="typeChange">
                    <t-option v-for="item in menuType" :key="item.id" :label="item.label" :value="item.value" />
                  </t-select>
                </t-form-item>
                <t-form-item v-show="formData.type !== 'custom'" name="url" :label="lang.select_page">
                  <!-- 系统页面 -->
                  <t-select v-if="formData.type == 'system'" v-model="formData.nav_id" @change="urlSelectChange">
                    <t-option v-for="item in selectList" :key="item.id" :value="item.id" :label="item.name" />
                  </t-select>
                  <!-- 插件 -->
                  <t-select v-if="formData.type == 'plugin'" v-model="formData.nav_id" @change="urlSelectChange">
                    <t-option-group v-for="(list,index) in selectList" :key="index" :label="list.title" divider>
                      <t-option v-for="item in list.navs" :value="item.id" :key="item.id" :label="item.name"></t-option>
                    </t-option-group>
                  </t-select>
                </t-form-item>
                <t-form-item v-show="formData.type === 'custom'" name="url" :label="lang.url_address">
                  <t-input v-model="formData.url" @blur="urlInputChange"></t-input>
                </t-form-item>
                <t-form-item name="icon" :label="lang.icon_code">
                  <!-- <t-input v-model="formData.icon"></t-input> -->
                  <t-popup placement="right-top" :visible="backPopupVisible">
                    <t-input class="icon-input" v-model="formData.icon">
                      <t-icon :name="formData.icon.replace('t-icon-','')" slot="prefix-icon"></t-icon>
                      <span @click="backPopupVisible=true" class="icon-btn"
                        slot="suffix-icon">{{lang.select_text}}</span>
                    </t-input>
                    <template #content>
                      <div class="all-icon">
                        <div class="icon-top">
                          <div class="top-text">{{lang.icon}}</div>
                          <t-icon class="close" name="close" @click="backPopupVisible = false" />
                        </div>
                        <div class="main-icons">
                          <!-- <i @click="formData.icon = item.font_class" class="iconfont main-icons-item back-icons-item"
                              v-for="item in adminIcon" :key="item.icon_id"
                              :class="item.font_class==formData.icon?'active ' + item.font_class:item.font_class">
                            </i> -->
                          <svg v-for="item in adminIcon" :key="item.icon_id" class="back-icons-item"
                            :class="item.font_class==formData.icon?'active ' + item.font_class: ''"
                            @click="formData.icon = item.font_class; saveSet()">
                            <use :href="`#${item.font_class}`"></use>
                          </svg>
                          <t-icon class="back-icons-item" :class="item.stem==formData.icon?'active':''"
                            :name="item.stem" v-for="item in manifest" :key="item.stem" @click="adminIconClick(item)">
                          </t-icon>
                          <!-- <i @click="formData.icon = item.font_class" class="iconfont main-icons-item" v-for="item in iconsData" :key="item.icon_id" :class="item.font_class==formData.icon?'active ' + item.font_class:item.font_class"></i> -->
                        </div>
                      </div>
                    </template>
                  </t-popup>
                </t-form-item>
                <t-form-item name="name" :label="lang.navigate_name">
                  <t-input v-model="formData.name" :maxlength="8" @blur="nameInputChange"></t-input>
                </t-form-item>
                <t-checkbox v-model="formData.isChecked" v-show="language.length>1"
                  @change="changeCheck">{{lang.multilingual}}</t-checkbox>
                <div v-show="formData.isChecked">
                  <t-form-item name="language" v-for="item in language" :key="item.display_lang"
                    :label="item.display_name">
                    <t-input v-model="formData.language[item.display_lang]" @change="changeLanguage"></t-input>
                  </t-form-item>
                </div>
                <t-form-item>
                  <div class="form-footer">
                    <t-button theme="default" @click="delNav" class="btn-no">{{lang.delete}}</t-button>
                  </div>
                </t-form-item>
              </t-form>
            </div>
            <t-button class="sure_sub" @click="subMenu" :loading="submitLoading"
              v-permission="'auth_system_configuration_menu_admin_menu_save_menu'">{{lang.apply_nav}}</t-button>
          </div>
        </div>
      </template>
    </t-card>

    <!-- 新增页面弹窗 -->
    <t-dialog :visible.sync="visible" :header="lang.add_page" :footer="false" @close="close" class="page-dialog">
      <t-form :data="newFormData" label-align="right" :label-width="120" @submit="confirmNewMenu" v-if="visible">
        <t-form-item name="type" :label="lang.page_type">
          <t-select v-model="newFormData.type" @change="newTypeChange">
            <t-option v-for="item in menuType" :key="item.id" :label="item.label" :value="item.value" />
          </t-select>
        </t-form-item>
        <t-form-item
          v-show="(newFormData.type !== 'custom') && (newFormData.type != 'module') && (newFormData.type != 'res_module')"
          name="url" :label="lang.select_page">
          <!-- <t-select v-model="newFormData.url" @change="newUrlSelectChange">
                    <t-option v-for="item in selectList" :key="item.id" :value="item.url" :label="item.name" />
                </t-select> -->
          <!-- 系统页面 -->
          <t-select v-if="newFormData.type == 'system'" v-model="newFormData.url" @change="newUrlSelectChange">
            <t-option v-for="item in selectList" :key="item.id" :value="item.url" :label="item.name" />
          </t-select>
          <!-- 插件 -->
          <t-select v-if="newFormData.type == 'plugin'" v-model="newFormData.url" @change="newUrlSelectChange">
            <t-option-group v-for="(list,index) in selectList" :key="index" :label="list.title" divider>
              <t-option v-for="item in list.navs" :value="`${item.id}@${item.url}`" :key="item.id"
                :label="item.name"></t-option>
            </t-option-group>
          </t-select>
        </t-form-item>
        <t-form-item v-show="(newFormData.type === 'custom') && (newFormData.type != 'module')" name="url"
          :label="lang.url_address" class="custom-url">
          <t-input v-model="newFormData.url"></t-input>
          <!-- 前台导航独有 -->
          <div class="second" v-show="value == '1'">
            <p>
              <t-checkbox v-model="newFormData.second_reminder">{{lang.second_reminder}}</t-checkbox>
            </p>
            <p class="tip">{{lang.nav_text15}}</p>
          </div>
        </t-form-item>
        <!-- 模块类型: 合并本地+代理模块 -->
        <t-form-item v-show="newFormData.type == 'module'" name="url" :label="lang.module_type">
          <t-select v-model="newFormData.multiple" :min-collapsed-num="1" @change="newModuleChange" multiple>
            <t-option v-for="(item,index) in mergeModule" :key="item.key" :value="item.key" :label="item.display_name"
              :disabled="calcDisabled(item.key, 'newFormData')">
            </t-option>
          </t-select>
        </t-form-item>
        <!-- 前台图标 -->
        <t-form-item name="icon" :label="lang.icon_code" v-show="value=='1'">
          <!-- <t-input v-model="newFormData.icon"></t-input> -->
          <t-popup placement="right-top" :visible="newPopupVisible">
            <t-input class="icon-input" v-model="newFormData.icon">
              <i class="iconfont" :class="newFormData.icon" slot="prefix-icon"></i>
              <span @click="newPopupVisible=true" class="icon-btn" slot="suffix-icon">{{lang.select_text}}</span>
            </t-input>
            <template #content>
              <div class="all-icon">
                <div class="icon-top">
                  <div class="top-text">{{lang.icon}}</div>
                  <t-icon class="close" name="close" @click="newPopupVisible = false" />
                </div>
                <div class="main-icons">
                  <i @click="newFormData.icon = item.font_class" class="iconfont main-icons-item"
                    v-for="item in iconsData" :key="item.icon_id"
                    :class="item.font_class==newFormData.icon?'active ' + item.font_class:item.font_class"></i>
                </div>
              </div>
            </template>
          </t-popup>
        </t-form-item>
        <!-- 后台图标 -->
        <t-form-item name="icon" :label="lang.icon_code" v-show="value=='2'">
          <t-popup placement="right-top" :visible="newBackPopupVisible" v-show="value=='2'">
            <t-input class="icon-input" v-model="newFormData.icon">
              <t-icon :name="newFormData.icon" slot="prefix-icon"></t-icon>
              <span @click="newBackPopupVisible=true" class="icon-btn" slot="suffix-icon">{{lang.select_text}}</span>
            </t-input>
            <template #content>
              <div class="all-icon">
                <div class="icon-top">
                  <div class="top-text">{{lang.icon}}</div>
                  <t-icon class="close" name="close" @click="newBackPopupVisible = false" />
                </div>
                <div class="main-icons">
                  <!-- <i @click="newFormData.icon = item.font_class" class="iconfont main-icons-item"
                    v-for="item in adminIcon" :key="item.icon_id"
                    :class="item.font_class==newFormData.icon?'active ' + item.font_class:item.font_class">
                  </i> -->
                   <svg v-for="item in adminIcon" :key="item.icon_id" class="back-icons-item"
                      :class="item.font_class==formData.icon?'active ' + item.font_class: ''"
                      @click="formData.icon = item.font_class; saveSet()">
                      <use :href="`#${item.font_class}`"></use>
                    </svg>
                  <t-icon class="back-icons-item" :class="item.stem==newFormData.icon?'active':''" :name="item.stem"
                    v-for="item in manifest" :key="item.stem" @click="newFormData.icon = item.stem"></t-icon>
                  <!-- <i @click="newFormData.icon = item.font_class" class="iconfont main-icons-item" v-for="item in iconsData" :key="item.icon_id" :class="item.font_class==newFormData.icon?'active ' + item.font_class:item.font_class"></i> -->
                </div>
              </div>
            </template>
          </t-popup>
        </t-form-item>

        <t-form-item name="name" :label="lang.navigate_name">
          <t-input v-model="newFormData.name" :maxlength="8"></t-input>
        </t-form-item>
        <t-form-item name="product_id" :label="lang.order_hosts"
          v-show="newFormData.type == 'module' || newFormData.type == 'res_module'">
          <t-tree-select :min-collapsed-num="1" v-model="newFormData.product_id" :data="productList"
            :tree-props="treeProps" multiple clearable :placeholder="lang.select"> </t-tree-select>
        </t-form-item>
        <!-- <t-tree :data="productList" :keys="treeKey" activable hover transition /> -->
        <t-checkbox class="new_menu_checkbox" v-model="newFormData.isChecked"
          v-show="language.length>1">{{lang.multilingual}}</t-checkbox>
        <div v-show="newFormData.isChecked">
          <t-form-item name="language" v-for="item in language" :key="item.display_lang" :label="item.display_name">
            <t-input v-model="newFormData.language[item.display_lang]"></t-input>
          </t-form-item>
        </div>
        <t-form-item>
          <div class="form-footer">
            <t-button theme="primary" type="submit" class="btn-ok" :loading="submitLoading">{{lang.hold}}</t-button>
            <t-button theme="default" class="btn-no" @click="close">{{lang.cancel}}</t-button>
          </div>
        </t-form-item>
      </t-form>
    </t-dialog>
  </com-config>
</div>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/mainfest.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/api/navigation.js"></script>
<!-- vue.draggable -->
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/Sortable.min.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/vuedraggable.umd.min.js"></script>
<script type="module" src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/navigation.js"></script>
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

