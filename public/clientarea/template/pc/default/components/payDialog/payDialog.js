// 线下支付弹窗
const proofDialog = {
  template: /*html*/ `
      <!-- 上传凭证 -->
      <div >
    <el-dialog custom-class='pay-dialog proof-dailog' :class='{look: isLook}' :visible.sync="proofDialog"
        :show-close="false" @close="proofClose">
        <template v-if="isLook">
            <div >
                <div class="dia-title">
                    <div class="title-text">{{lang.finance_custom19}}</div>
                </div>
                <div class="dia-content">
                    <div class="item">
                        <div class="view-box">
                            <p class="item" v-for="(item, index) in fileList" :key="index" @click="clickFile(item)">
                                {{item.name}}
                            </p>
                        </div>
                        <div class="dia-fotter">
                            <el-button class="cancel-btn" @click="proofClose">{{lang.finance_text58}}</el-button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template v-else>
            <div >
                <div class="dia-title">
                    <div class="title-text">{{lang.finance_custom6}}：{{zfData.orderId}}</div>
                    <div class="title-text">{{lang.pay_text2}}
                        <span class="pay-money">{{ commonData.currency_prefix }}
                            <span class="font-26">{{ Number(zfData.amount).toFixed(2)}}</span>
                        </span>
                        <i class="el-icon-circle-close close" @click="proofDialog = false"></i>
                    </div>
                </div>
                <div class="dia-content">
                    <div class="item">
                        <div class="pay-top">
                            <div class="pay-type" ref="payListRef">
                                <div class="type-item active">
                                    <img src="${url}img/common/bank.png" alt="" />
                                    <i class="el-icon-check"></i>
                                </div>
                            </div>
                        </div>
                        <div class="qr-money">
                            <span>{{lang.finance_custom11}}：</span>
                            <span class="pay-money">{{ commonData.currency_prefix}}
                                <span class="font-26">
                                    {{orderInfo.amount_unpaid}}{{commonData.currency_code}}
                                </span>
                            </span>
                        </div>
                        <p class="des">
                            ({{lang.finance_custom12}}：{{commonData.currency_prefix}}{{orderInfo.credit}}{{commonData.currency_code}})
                        </p>
                        <div class="custom-text">
                            <div class="qr-content" v-loading="payLoading" v-html="payHtml" id="payBox"></div>
                            <i class="el-icon-document-copy" v-if="payHtml" @click="copyText(payHtml)"></i>
                        </div>
                        <el-steps :space="200" :active="stepNum" finish-status="success" :align-center="true"
                            class="custom-step">
                            <el-step :title="lang.finance_custom7"></el-step>
                            <el-step :title="lang.finance_custom4"></el-step>
                            <el-step>
                                <template slot="title">
                                    <span class="txt" :class="{ fail: orderStatus === 'ReviewFail'}">{{orderStatus === 'ReviewFail'
                      ? lang.finance_custom9 : lang.finance_custom8}}</span>
                                    <el-popover placement="top-start" trigger="hover" :title="review_fail_reason">
                                        <span class="help" slot="reference" v-if="orderStatus === 'ReviewFail'">?</span>
                                    </el-popover>
                                </template>
                            </el-step>
                            <el-step :title="lang.finance_custom10"></el-step>
                        </el-steps>
                    </div>
                    <div class="item">
                        <p>{{lang.finance_custom4}}</p>
                        <el-upload class="upload-demo" ref="fileupload" drag action="/console/v1/upload"
                            :headers="{Authorization: jwt}" :before-remove="beforeRemove" multiple :file-list="fileList"
                            :on-success="handleSuccess" :on-preview="clickFile" :limit="10"
                            accept="image/*, .pdf, .PDF">
                            <div class="el-upload__text">
                                <p>{{lang.finance_custom16}}<em>{{lang.finance_custom17}}</em></p>
                                <p>{{lang.finance_custom18}}</p>
                            </div>
                        </el-upload>

                        <div class="dia-fotter">
                            <el-button class="cancel-btn" @click="changeWay">{{lang.finance_custom14}}</el-button>
                            <el-button @click="submitProof" :disabled="formData.voucher.length === 0" class="submit-btn"
                                :loading="submitLoading">
                                {{orderStatus === 'WaitUpload' ? lang.finance_custom4 : lang.finance_custom5}}
                            </el-button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </el-dialog>
    <!-- 图片预览 -->
    <div style="height: 0;">
        <img id="proofViewer" :src="preImg" alt="" ref="proofViewer" style="width: 0; height: 0;">
    </div>
    <!-- 变更支付方式 -->
    <div class="delete-dialog">
        <el-dialog width="4.35rem" :visible.sync="showChangeWay" :show-close=false @close="showChangeWay=false">
            <div class="delete-box">
                <div class="delete-content">{{lang.finance_custom15}}</div>
                <div class="delete-btn">
                    <el-button class="confirm-btn btn" @click="handelChangeWay"
                        :loading="changeLoading">{{lang.finance_btn8}}</el-button>
                    <el-button class="cancel-btn btn" @click="showChangeWay=false">{{lang.finance_btn7}}</el-button>
                </div>
            </div>
        </el-dialog>
    </div>
</div>
    `,
  computed: {
    srcList() {
      return this.formData.voucher;
    },
  },
  data() {
    return {
      proofDialog: false,
      zfData: {
        orderId: 0,
        amount: 0,
      },
      commonData: {
        currency_prefix: "￥",
      },
      orderInfo: {},
      stepNum: 0,
      orderStatus: "",
      review_fail_reason: "",
      payLoading: false,
      payHtml: "",
      fileList: [],
      jwt: `Bearer ${localStorage.jwt}`,
      formData: {
        id: "",
        voucher: [],
      },
      submitLoading: false,
      showChangeWay: false,
      changeLoading: false,
      viewer: null,
      preImg: "",
      isLook: false,
    };
  },
  methods: {
    loadViewer() {
      if (!this.viewer) {
        const link = document.createElement("link");
        link.rel = "stylesheet";
        link.href = `${url}css/common/viewer.min.css`;
        document.head.appendChild(link);
        const script = document.createElement("script");
        script.src = `${url}js/common/viewer.min.js`;
        document.head.appendChild(script);
        script.onload = () => {
          this.viewer = new Viewer(document.getElementById("proofViewer"), {
            button: true,
            inline: false,
            zoomable: true,
            title: true,
            tooltip: true,
            minZoomRatio: 0.5,
            maxZoomRatio: 100,
            movable: true,
            interval: 2000,
            navbar: true,
            loading: true,
          });
          this.viewer.show();
        };
      } else {
        this.viewer.show();
      }
    },
    proofClose() {
      this.proofDialog = false;
      this.viewer && this.viewer.destroy();
    },
    changeWay() {
      this.showChangeWay = true;
    },
    // 附件下载
    clickFile(item) {
      const name = item.name;
      const imgUrl = item.url || item.response?.data?.image_url;
      const type = name.substring(name.lastIndexOf(".") + 1);
      if (
        [
          "png",
          "jpg",
          "jepg",
          "bmp",
          "webp",
          "PNG",
          "JPG",
          "JEPG",
          "BMP",
          "WEBP",
        ].includes(type)
      ) {
        this.preImg = imgUrl;
        $("#proofViewer").attr("src", imgUrl);
        this.loadViewer();
      } else {
        const downloadElement = document.createElement("a");
        downloadElement.href = url;
        downloadElement.download = item.name; // 下载后文件名
        document.body.appendChild(downloadElement);
        downloadElement.click(); // 点击下载
      }
    },
    emitRefresh(isChange = false) {
      this.$emit("refresh", isChange, this.orderInfo.id);
    },
    copyText(text) {
      if (navigator.clipboard && window.isSecureContext) {
        // navigator clipboard 向剪贴板写文本
        this.$message.success(lang.pay_text17);
        return navigator.clipboard.writeText(text);
      } else {
        // 创建text area
        const textArea = document.createElement("textarea");
        textArea.value = text;
        // 使text area不在viewport，同时设置不可见
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        this.$message.success(lang.pay_text17);
        return new Promise((res, rej) => {
          // 执行复制命令并移除文本框
          document.execCommand("copy") ? res() : rej();
          textArea.remove();
        });
      }
    },
    async handelChangeWay() {
      try {
        this.changeLoading = true;
        const res = await changePayType(this.orderInfo.id);
        this.$message.success(res.data.msg);
        this.showChangeWay = false;
        this.proofDialog = false;
        this.changeLoading = false;
        this.emitRefresh(true);
      } catch (error) {
        console.log("error", error);
        this.changeLoading = false;
        this.showChangeWay = false;
        this.$message.error(error.data.msg);
      }
    },
    onProgress(event) {
      console.log(event);
    },
    async submitProof() {
      try {
        if (this.formData.voucher.length === 0) {
          return this.$message.warning(lang.finance_custom13);
        }
        this.submitLoading = true;
        const params = {
          id: this.zfData.orderId,
          voucher: this.formData.voucher,
        };
        const res = await uploadProof(params);
        this.submitLoading = false;
        this.$message.success(res.data.msg);
        this.proofDialog = false;
        this.emitRefresh();
      } catch (error) {
        this.submitLoading = false;
        this.$message.error(error.data.msg);
      }
    },
    beforeRemove(file, fileList) {
      // 获取到删除的 save_name
      let save_name = file.save_name || file.response.data.save_name;
      this.formData.voucher = this.formData.voucher.filter((item) => {
        return item != save_name;
      });
    },
    // 上传文件相关
    handleSuccess(response, file, fileList) {
      if (response.status != 200) {
        this.$message.error(response.msg);
        // 清空上传框
        let uploadFiles = this.$refs["fileupload"].uploadFiles;
        let length = uploadFiles.length;
        uploadFiles.splice(length - 1, length);
      } else {
        this.formData.voucher = [];
        this.formData.voucher = fileList.map(
          (item) => item.response?.data?.save_name || item.save_name
        );
      }
    },
    async getOrderDetails(orderId) {
      try {
        const res = await orderDetails(orderId);
        this.orderInfo = res.data.data.order;

        const {id, amount, status, review_fail_reason} = res.data.data.order;
        this.zfData.orderId = Number(id);
        this.zfData.amount = amount;
        this.proofDialog = true;
        this.orderStatus = status;
        this.review_fail_reason = review_fail_reason;
        this.isLook = status === "Paid" && this.orderInfo.voucher.length > 0;
        if (status === "WaitUpload") {
          this.stepNum = 2;
        } else {
          this.stepNum = 3;
        }
        // 获取转账信息
        this.payLoading = true;
        let result = "";
        if (!this.isLook) {
          result = await pay({
            id,
            gateway: "UserCustom",
          });
          this.payLoading = false;
          this.payHtml = result.data.data.html;
          $("#payBox").html(res.data.data.html);
        }

        this.fileList = this.orderInfo.voucher;
        this.formData.voucher = this.orderInfo.voucher.map(
          (item) => item.save_name
        );
      } catch (error) {
        console.log("error", error);
        this.$message.error(error.data.msg);
        this.payLoading = false;
      }
    },
  },
};

// 选择平台币弹窗
const selectCoin = {
  template: /*html*/ `
    <div >
    <el-dialog :visible.sync="selectCoinShow" custom-class="select-coin-dialog" :show-close="false"
        @close="handelAllPay">
        <div class="select-coin-title">
            <span class="title-text">{{lang.coin_text32}}{{coin_name}}</span>
            <span class="close-btn" @click="closeSelectDialog">
                <i class="el-icon-close"></i>
            </span>
        </div>
        <div class="select-coin-box" v-loading="selectCoinLoading">
            <div class="select-coin-box-top" v-if="coinList.length > 0">
                <div class="select-coin-num">{{lang.coin_text33}}{{coin_name}}({{lang.coin_text34}}：<span class="select-coin-num-price">{{commonData.currency_prefix}}{{coin_amount}}</span> ，{{lang.coin_text35}}{{auto ? coin_coupons_count : coin_coupon_ids.length}}{{lang.coin_text36}},{{lang.coin_text37}}<span
                        class="select-coin-num-text">{{coinList.length}}{{lang.coin_text36}}</span>)</div>
                <div class="select-coin-auto">
                    <el-checkbox v-model="auto" @change="autoChange">{{lang.coin_text38}}</el-checkbox>
                </div>
            </div>
            <el-checkbox-group v-model="coin_coupon_ids" @change="coinChange">
                <div class="select-coin-list">
                    <div class="select-coin-item" v-for="item in coinList" :key="item.id">
                        <div class="select-item-left">
                            <div class="select-item-info">
                                <span class="f-small">
                                {{commonData.currency_prefix}}<span :class="{'f-20':item.leave_amount.length >= 8,'f-40':item.leave_amount.length < 5,'f-32':item.leave_amount.length < 8 && item.leave_amount.length >= 5}" v-if="String(item.leave_amount).split('.')?.[0]">{{String(item.leave_amount).split('.')[0]}}</span>
                                  <span class="f-small" v-if="String(item.leave_amount).split('.')?.[1]">.{{String(item.leave_amount).split('.')[1]}}</span>
                                </span>
                            </div>
                        </div>
                        <div class="select-item-right">
                            <div class="coin-name">{{item.name}}</div>
                            <div class="coin-price" v-if="item.discount_amount > 0 && (coin_coupon_ids.includes(item.id) || auto)">
                              {{lang.coin_text39}}：{{commonData.currency_prefix}}{{item.discount_amount.toFixed(2)}}
                            </div>
                            <div class="coin-time">{{lang.coin_text40}}：
                                <template v-if="!item.effective_start_time">
                                    {{lang.voucher_effective}}
                                </template>
                                <template v-else>
                                    {{item.effective_start_time | formateTime}} -
                                    {{item.effective_end_time | formateTime}}
                                </template>
                            </div>
                        </div>
                        <el-checkbox class="select-coin-checkbox" :label="item.id" v-if="!auto">{{ }}</el-checkbox>
                    </div>
                </div>
            </el-checkbox-group>
            <el-empty v-if="coinList.length === 0 && !selectCoinLoading" :description="lang.coin_text41 + coin_name" :image-size="150"></el-empty>
        </div>
        <div class="select-coin-footer">
            <el-button type="primary" @click="closeSelectDialog">{{lang.coin_text42}}</el-button>
        </div>
    </el-dialog>

</div>
  `,
  data() {
    return {
      commonData: {},
      selectCoinShow: false,
      coin_coupon_ids: [],
      auto: false,
      selectCoinLoading: false,
      orderId: "",
      coinList: [],
      coin_amount: 0,
      coin_coupons_count: 0,
      coin_name: lang.coin_text43,
    };
  },
  filters: {
    formateTime(time) {
      if (time && time !== 0) {
        return formateDate1(time * 1000);
      } else {
        return lang.voucher_effective;
      }
    },
  },
  created() {
    this.commonData =
      JSON.parse(localStorage.getItem("common_set_before")) || {};
  },
  methods: {
    autoChange(val) {
      if (val) {
        this.coin_coupon_ids = this.coinList.map((item) => item.id);
      } else {
        this.coin_coupon_ids = [];
      }
      this.applyCoin();
    },
    coinChange() {
      this.applyCoin();
    },
    async getCoinPayList() {
      this.selectCoinLoading = true;
      try {
        const res = await apiCoinPayList({
          order_id: this.orderId,
        });
        this.coinList = res.data.data.list.map((item) => {
          item.discount_amount = 0;
          return item;
        });
        this.selectCoinLoading = false;
      } catch (error) {
        console.log("error", error);
        this.selectCoinLoading = false;
      }
    },
    handelAllPay() {
      this.$emit("confirm", {
        auto: this.auto,
        coin_coupon_ids: this.coin_coupon_ids,
      });
    },
    async openSelectDia(
      coin_name = lang.coin_text43,
      id,
      auto = true,
      coin_coupon_ids = []
    ) {
      this.coin_name = coin_name;
      this.auto = auto;
      this.orderId = id;
      this.coin_coupon_ids = coin_coupon_ids;
      this.selectCoinShow = true;
      await this.getCoinPayList();
      await this.applyCoin();
    },
    // 应用平台币
    async applyCoin() {
      try {
        this.selectCoinLoading = true;
        const res = await apiApplyCoin({
          order_id: this.orderId,
          use: this.auto || this.coin_coupon_ids.length > 0 ? 1 : 0,
          auto: Number(this.auto),
          coin_coupon_ids: this.coin_coupon_ids,
        });
        const {
          coin_amount = 0,
          coin_coupons_count = 0,
          coin_coupons = [],
        } = res.data.data;
        this.coin_amount = coin_amount;
        this.coin_coupons_count = coin_coupons_count;
        this.coinList.forEach((item) => {
          item.discount_amount = 0;
          coin_coupons.forEach((coin) => {
            if (coin.rel_id == item.id) {
              item.discount_amount =
                item.discount_amount + Math.abs(coin.amount);
            }
          });
        });
        this.selectCoinLoading = false;
      } catch (error) {
        this.selectCoinLoading = false;
        this.coin_amount = 0;
        this.coin_coupons_count = 0;
        this.$message.error(error.data.msg);
      }
    },
    closeSelectDialog() {
      this.selectCoinShow = false;
    },
  },
};

// 通用支付弹窗
const payDialog = {
  template: /*html*/ `
  <div>
  <el-dialog custom-class='new-pay-dialog' :visible.sync="isShowZf" :show-close="false" @close="zfClose">
      <div class="pay-title">
          <span class="title-text">{{lang.coin_text24}}</span>
          <span class="close-btn" @click="zfClose">
              <i class="el-icon-close"></i>
          </span>
      </div>
      <div class="pay-content">
          <div class="pay-order-top">
              <div class="pay-order-top-left">
                  <i class="el-icon-circle-check pay-order-icon"></i>
                  <div class="pay-order-tip">
                      <div class="pay-order-tip-text">
                          {{lang.coin_text25}}
                      </div>
                      <div class="pay-order-id">
                          {{lang.coin_text26}}：ID-{{zfData.orderId}}
                      </div>
                  </div>
              </div>
              <div class="pay-order-top-right">
                  <div>
                      <template v-if="zfData.gateway == 'UserCustom'">{{lang.pay_text7}}</template>
                      <template v-else-if="zfData.gateway == 'credit'">{{lang.order_text8}}</template>
                      <template v-else-if="zfData.gateway == 'CreditLimit'">{{lang.coin_text62}}</template>
                      <template v-else>{{lang.pay_text8}}</template>{{lang.coin_text27}}：{{commonData.currency_prefix}}
                      <span class="pay-order-price" v-loading="priceLoading">
                          {{calcPayAmount}}
                      </span>
                      {{commonData.currency_code}}
                  </div>
                  <div>
                      {{lang.coin_text28}}：{{ commonData.currency_prefix}}<span class="pay-order-total-price"
                          v-loading="priceLoading">{{calcShowOriginAmount}}</span>{{commonData.currency_code}}
                  </div>
              </div>
          </div>
          <div class="pay-order-des" v-if="commonData.recharge_pay_notice_content && isCz"
              v-html="commonData.recharge_pay_notice_content">
          </div>
          <div class="pay-order-check" v-if="!isCz">
              <div style="display: flex;align-items: center;">
                  <span style="margin-right: 0.16rem;">{{lang.coin_text23}}</span>
                  <template v-if="zfData.gateway !== 'credit' && zfData.gateway !== 'CreditLimit' && balance * 1 > 0">
                      <el-checkbox v-model="zfData.checked" @change="zfSelectChange"
                          style="margin-right: 5px;line-height: 1;">
                      </el-checkbox>
                      {{lang.pay_text21}}
                      ({{lang.pay_text6}}{{ commonData.currency_prefix}}
                      <span class="pay-order-balance">{{(balance * 1).toFixed(2)}}</span>
                      <template v-if="zfData.checked">
                           ,{{lang.order_text8}}{{ commonData.currency_prefix}}
                          <span
                              class="pay-order-balance">{{(balance * 1 >= zfData.amount * 1 ? zfData.amount * 1 : balance * 1).toFixed(2)}}</span>
                      </template>
                      )
                  </template>
              </div>
              <div v-plugin="'Coin'" v-if="showCoin" style="display: flex;align-items: center;">
                  <el-checkbox v-model="useCoin" @change="checkUseCoin"
                      style="margin-right: 5px;line-height: 1;"></el-checkbox>
                  {{lang.coin_text44}}{{coin_name}}
                  <template v-if="useCoin">
                      ({{lang.coin_text35}}{{coin_coupons_count}}{{lang.coin_text36}},{{lang.coin_text45}}{{
                      commonData.currency_prefix}}<span class="pay-order-coin-num">{{coin_amount}}</span> <span
                          class="pay-order-coin-detail" @click.stop="openSelectDialog">{{lang.coin_text46}}</span>)
                  </template>

              </div>
          </div>
          <div class="credit-tip" v-if="zfData.gateway == 'CreditLimit'">{{lang.pay_text4}}</div>
          <div class="pay-order-method" v-loading="getWayLoading">
              <div class="pay-method-list">
                  <div class="pay-method-item" :class="{active:zfData.gateway === item.name}"
                      v-for="item in gatewayList" :key="item.id" @click="handelSelect(item)">
                      <img class="pay-method-item-img" :src="item.url" v-if="item.url" alt="">
                      <div class="pay-method-item-text">
                          <div>{{item.title}}</div>
                          <div v-if="isShowCredit && item.name === 'CreditLimit'">
                              ({{ commonData.currency_prefix}}{{creditData.remaining_amount}})
                          </div>
                          <div class="type-dec" v-if="item.name === 'credit'">
                              ({{ commonData.currency_prefix}}{{balance}})
                          </div>
                      </div>
                      <i class="el-icon-check" v-if="zfData.gateway === item.name"></i>
                  </div>
              </div>
              <div class="pay-method-box" v-show="isShowPay && zfData.gateway !== 'CreditLimit'">
                  <!-- 线下支付 -->
                  <div class="pay-method-offline" v-if="zfData.gateway === 'UserCustom'">
                      <div class="custom-text-title">{{lang.coin_text29}}</div>
                      <div class="custom-text-content">
                          <div class="qr-content" id="payBox" v-loading="payLoading || loading" v-html="payHtml">
                          </div>
                          <i class="el-icon-document-copy" v-if="payHtml" @click="copyText(payHtml)"></i>
                      </div>
                      <el-steps :space="200" :active="1" finish-status="success" :align-center="true"
                          class="custom-offline-step">
                          <el-step :title="lang.finance_custom7"></el-step>
                          <el-step :title="lang.finance_custom4"></el-step>
                          <el-step :title="lang.finance_custom8"></el-step>
                          <el-step :title="lang.finance_custom10"></el-step>
                      </el-steps>
                      <el-button type="primary" class="custom-btn" :loading="submitLoading"
                          @click="handleCustom">{{lang.finance_custom20}}
                      </el-button>
                  </div>
                  <!-- 扫码支付 -->
                  <div class="pay-method-qr" v-if="zfData.gateway !== 'UserCustom'">
                      <div class="pay-qr-content">
                          <div class="qr-content" v-loading="payLoading || loading"
                              v-show="isShowimg && zfData.gateway !== 'UserCustom'" id="payBox">
                          </div>
                          <div class="pay-qr-text">
                              {{lang.coin_text30}} <br>
                              {{lang.coin_text31}}
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="pay-footer">
          <el-button type="primary" @click="handleOk" v-loading="doPayLoading"
              :disabled="getWayLoading || priceLoading || (balance * 1 < zfData.amount *1) && zfData.gateway !== 'CreditLimit'"
              v-if="!isShowPay || zfData.gateway === 'CreditLimit'">{{lang.pay_text9}}
          </el-button>
          <el-button type="info" class="cancel-btn" @click="zfClose">{{lang.pay_text12}}</el-button>
      </div>
  </el-dialog>
  <proof-dialog ref="proof" @refresh="refresh"></proof-dialog>
  <select-coin ref="selectCoinRef" @confirm="confirmCoin"></select-coin>
</div>

    `,
  created() {
    this.commonData =
      JSON.parse(localStorage.getItem("common_set_before")) || {};
  },
  mounted() {
    // 引入 jquery
    const script = document.createElement("script");
    script.src = `${url}js/common/jquery.mini.js`;
    document.body.appendChild(script);
  },
  components: {
    proofDialog,
    selectCoin,
  },
  destroyed() {
    clearInterval(this.timer);
    clearTimeout(this.balanceTimer);
  },
  props: {
    allowCredit: {
      // 是否允许使用信用额
      type: Boolean,
      default: true,
    },
  },
  data() {
    return {
      // 显示弹窗
      isShowZf: false,
      // 显示底部支付按钮
      isShowPay: false,
      timer: null,
      time: 300000,
      zfData: {
        // 订单id
        orderId: 0,
        // 订单金额
        amount: 0,
        checked: false,
        // 支付方式
        gateway: "",
      },
      // 支付方式
      gatewayList: [],
      payLoading: false,
      isShowCredit: false,
      cantUseCredit: false,
      isShowimg: true,
      creditData: {},
      // 用户余额
      balance: 0,
      payHtml: "",
      balanceTimer: null,
      commonData: {
        currency_prefix: "￥",
      },
      isPaySuccess: false,
      isCz: false,
      doPayLoading: false,
      loading: false,
      str: "",
      submitLoading: false,
      isTransfer: false,
      useCoin: false,
      auto: false,
      coin_coupon_ids: [],
      coin_coupons_count: 0,
      coin_amount: 0,
      showCoin: false,
      diaInitIng: false,
      priceLoading: false,
      coin_name: lang.coin_text43,
      getWayLoading: false,
      coinClientInfo: {},
    };
  },
  computed: {
    calcPayAmount() {
      const balance = this.zfData.checked ? Number(this.balance) : 0;
      const showAmount = this.zfData.amount * 1 - balance;
      if (
        this.zfData.gateway == "credit" ||
        this.zfData.gateway == "CreditLimit"
      ) {
        return Number(this.zfData.amount).toFixed(2);
      } else {
        return showAmount <= 0 ? "0.00" : showAmount.toFixed(2);
      }
    },
    calcShowOriginAmount() {
      return Number(this.zfData.amount * 1 + this.coin_amount * 1).toFixed(2);
    },
  },
  filters: {
    formateDownTime(time) {
      let minutes = Math.floor(time / 1000 / 60);
      let seconds = (time / 1000) % 60;
      return minutes + "分" + seconds + "秒";
    },
  },
  methods: {
    openSelectDialog() {
      this.$refs.selectCoinRef.openSelectDia(
        this.coin_name,
        this.zfData.orderId,
        this.auto,
        this.coin_coupon_ids
      );
    },
    checkUseCoin(val) {
      if (val) {
        this.auto = true;
      } else {
        this.auto = false;
        this.coin_coupon_ids = [];
      }
      this.applyCoin();
    },
    confirmCoin(data) {
      this.useCoin = data.auto || data.coin_coupon_ids.length > 0;
      this.coin_coupon_ids = data.coin_coupon_ids;
      this.auto = data.auto;
      this.applyCoin();
    },
    // 应用平台币
    async applyCoin(isInit = false) {
      try {
        this.priceLoading = true;
        const res = await apiApplyCoin({
          order_id: this.zfData.orderId,
          use: Number(this.useCoin),
          auto: Number(this.auto),
          coin_coupon_ids: this.coin_coupon_ids,
        });
        const {coin_amount = 0, coin_coupons_count = 0} = res.data.data;
        this.coin_amount = coin_amount;
        this.coin_coupons_count = coin_coupons_count;
        const detailRes = await orderDetails(this.zfData.orderId);
        const orderData = detailRes.data.data.order;
        this.zfData.amount = orderData.amount;
        this.priceLoading = false;
        if (isInit === false) {
          this.zfSelectChange();
        }
      } catch (error) {
        this.priceLoading = false;
        this.coin_amount = 0;
        this.coin_coupons_count = 0;
        this.$message.error(error.data.msg);
        if (isInit === false) {
          this.zfSelectChange();
        }
      }
    },
    async handleCustom() {
      try {
        this.submitLoading = true;
        const res = await submitApplication(this.zfData.orderId);
        this.$message.success(res.data.msg);
        this.submitLoading = false;
        this.isTransfer = true;
        this.$refs.proof.getOrderDetails(this.zfData.orderId);
        this.isShowZf = false;
      } catch (error) {
        this.submitLoading = false;
        this.$message.error(error.data.msg);
      }
    },
    refresh(bol, id) {
      if (bol) {
        return this.showPayDialog(id);
      }
      this.$emit("payok", this.zfData.orderId);
    },
    async initPay() {
      this.isShowCredit = havePlugin("CreditLimit");
      // 清除已有定时器
      if (this.timer) {
        clearInterval(this.timer);
      }
      this.time = 300000;
      this.gatewayList = [];
      this.balance = 0;
      this.zfData.gateway = "";
      this.zfData.checked = false;
      this.zfData.orderId = 0;
      this.zfData.amount = 0;
      this.isPaySuccess = false;
      this.isTransfer = false;
      this.isShowPay = false;
      this.useCoin = false;
      this.auto = false;
      this.showCoin = false;
      this.coin_coupon_ids = [];
      this.coin_coupons_count = 0;
      this.coin_amount = 0;
      this.getWayLoading = false;
      this.priceLoading = false;
      this.diaInitIng = false;
      this.isShowZf = true;
    },
    async getCoinInfo() {
      await apiCoinClientCoupon().then((res) => {
        this.coin_name = res.data.data.name;
        this.coinClientInfo = res.data.data;
      });
    },
    handelSelect(item) {
      // 如果支付方式相同，则不进行任何操作
      if (this.zfData.gateway === item.name) return;
      // 如果信用额不足，则提示
      if (
        item.name === "CreditLimit" &&
        this.zfData.amount * 1 > this.creditData.remaining_amount * 1
      ) {
        this.$message.error(lang.pay_text16);
        // 切换到不是余额和信用额的支付方式
        this.zfData.gateway = this.gatewayList.find(
          (item) => item.name !== "CreditLimit"
        )?.name;
        return;
      }
      // 如果当前是信用额支付 切换到别的支付方式 则勾选使用余额
      if (this.zfData.gateway === "CreditLimit" && this.balance * 1 > 0) {
        this.zfData.checked = true;
      }
      // 如果切换到余额支付，则取消勾选使用余额
      if (item.name === "CreditLimit") {
        this.zfData.checked = false;
      }
      this.zfData.gateway = item.name;
      this.zfSelectChange();
    },
    copyText(text) {
      if (navigator.clipboard && window.isSecureContext) {
        // navigator clipboard 向剪贴板写文本
        this.$message.success(lang.pay_text17);
        return navigator.clipboard.writeText(text);
      } else {
        // 创建text area
        const textArea = document.createElement("textarea");
        textArea.value = text;
        // 使text area不在viewport，同时设置不可见
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        this.$message.success(lang.pay_text17);
        return new Promise((res, rej) => {
          // 执行复制命令并移除文本框
          document.execCommand("copy") ? res() : rej();
          textArea.remove();
        });
      }
    },
    // 获取账户详情
    async getAccount() {
      const res = await account();
      if (res.data.status === 200) {
        this.balance = res.data.data.account.credit;
      }
    },
    // 支付关闭
    zfClose() {
      if (!this.isPaySuccess && !this.isTransfer) {
        this.$emit("paycancel", this.zfData.orderId);
      }
      this.isShowZf = false;
      this.isCz = false;
      this.cantUseCredit = false;
      this.isShowPay = false;
      this.diaInitIng = false;
      clearInterval(this.timer);
      this.time = 300000;
      if (this.zfData.checked) {
        // 如果勾选了使用余额
        this.zfData.checked = false;
        // 取消使用余额
        const params = {
          id: this.zfData.orderId,
          use: 0,
        };
        if (!this.isCz) {
          creditPay(params);
        }
      }
    },
    //  授信详情
    async getCreditDetail() {
      try {
        const res = await creditDetail();
        if (res.data.status === 200) {
          this.creditData = res.data.data.credit_limit;
          if (
            this.creditData.status === "Active" &&
            !this.cantUseCredit &&
            this.creditData.remaining_amount * 1 > 0
          ) {
            this.gatewayList.unshift({
              id: "1411373683",
              name: "CreditLimit",
              title: lang.pay_text18,
              url: `${url}img/common/credit_log.svg`,
            });
          }
        }
      } catch (error) {
        console.log(error);
      }
    },
    // 获取支付方式列表
    async getGateway() {
      try {
        this.getWayLoading = true;
        const res = await gatewayList();
        if (res.data.status === 200) {
          this.gatewayList = res.data.data.list;
          this.zfData.gateway = this.gatewayList[0]?.name;
          this.getWayLoading = false;
        }
      } catch (error) {
        console.log(error);
        this.gatewayList = [];
        this.getWayLoading = false;
      }
    },
    // 支付方式切换
    async zfSelectChange() {
      this.clearPolling();
      try {
        // 如果当前是余额支付，则勾选使用余额
        if (this.zfData.gateway == "credit" && this.balance * 1 > 0) {
          this.zfData.checked = true;
          this.isShowPay = false;
          return;
        }
        // 如果当前是信用额支付，则取消勾选使用余额
        if (this.zfData.gateway == "CreditLimit") {
          this.zfData.checked = false;
          this.isShowPay = false;
          return;
        }

        // 0元的订单直接余额支付成功
        if (this.zfData.amount == 0) {
          this.isShowPay = false;
          return;
        }

        const balance = Number(this.balance);
        const money = Number(this.zfData.amount);
        // 余额大于等于支付金额 且 勾选了使用余额 不需要拉起支付
        if (balance >= money && this.zfData.checked) {
          this.isShowPay = false;
          return;
        }
        if (!this.isCz) {
          await creditPay({
            id: this.zfData.orderId,
            use: Number(this.zfData.checked),
          });
        }
        this.priceLoading = true;
        this.diaInitIng = false;
        this.isShowPay = true;
        this.payHtml = "";
        this.payLoading = true;
        this.isShowimg = true;
        // 获取第三方支付
        const params = {gateway: this.zfData.gateway, id: this.zfData.orderId};
        const res = await pay(params);
        this.payLoading = false;
        this.time = 300000;
        this.payHtml = res.data.data.html;
        $("#payBox").html(res.data.data.html);
        // 开始支付状态轮询
        if (this.zfData.gateway !== "UserCustom") {
          this.pollingStatus(this.zfData.orderId);
        }
        this.priceLoading = false;
      } catch (error) {
        this.priceLoading = false;
        this.isShowimg = false;
        this.payLoading = false;
        this.$message.error(error.data.msg);
      }
    },
    // 确认使用余额支付
    handleOk() {
      this.doPayLoading = true;
      const params = {
        gateway:
          this.zfData.checked || this.zfData.amount == 0
            ? "credit"
            : "CreditLimit",
        id: this.zfData.orderId,
      };
      const subApi =
        this.zfData.gateway == "CreditLimit" ? payCreditLimit : pay;
      subApi(params)
        .then((res) => {
          this.$message.success(res.data.msg);
          this.doPayLoading = false;
          this.isPaySuccess = true;
          this.isShowZf = false;
          this.getAccount();
          this.$emit("payok", this.zfData.orderId);
        })
        .catch((error) => {
          this.$message.error(error.data.msg);
          this.doPayLoading = false;
        });
    },
    clearPolling() {
      if (this.timer) {
        clearInterval(this.timer);
      }
    },
    // 轮循支付状态
    pollingStatus(id) {
      if (this.timer) {
        clearInterval(this.timer);
      }
      this.timer = setInterval(async () => {
        const res = await getPayStatus(id);
        this.time = this.time - 2000;
        if (res.data.code === "Paid") {
          this.$message.success(res.data.msg);
          clearInterval(this.timer);
          this.time = 300000;
          this.isShowZf = false;
          this.getAccount();
          this.isPaySuccess = true;
          this.$emit("payok", this.zfData.orderId);
          return false;
        }
        if (this.time === 0) {
          clearInterval(this.timer);
          // 关闭充值 dialog
          this.isShowZf = false;
          this.$refs.selectCoinRef &&
            this.$refs.selectCoinRef.closeSelectDialog();
          this.$message.error(lang.pay_text20);
        }
      }, 2000);
    },
    czPay(orderId) {
      this.isCz = true;
      this.cantUseCredit = true;
      this.showPayDialog(orderId);
    },

    // 处理支付网关选择
    async handleGatewaySelection() {
      // 获取支付方式列表
      // 处理余额支付逻辑
      if (!this.isCz) {
        // 获取账户余额
        const res = await account();
        if (res.data.status === 200) {
          this.balance = res.data.data.account.credit;
          this.addCreditGateway();
        }
      }
      // 添加信用额支付方式
      if (this.isShowCredit && this.allowCredit && !this.isCz) {
        await this.getCreditDetail();
      }
      this.zfData.gateway = this.gatewayList[0]?.name;
      // 如果当前是信用额支付 则判断是否超出信用额 超出则切换到别的支付方式
      if (this.zfData.gateway === "CreditLimit") {
        const isExceedLimit =
          this.zfData.amount * 1 > this.creditData.remaining_amount * 1;
        if (isExceedLimit) {
          this.zfData.gateway = this.gatewayList[1]?.name;
        }
      }
      // 如果余额大于0 且 可以使用余额 则勾选使用余额
      if (this.balance > 0) {
        this.zfData.checked = true;
      }
    },

    // 添加余额支付方式
    addCreditGateway() {
      // 如果余额大于支付金额 则添加余额支付方式
      if (this.balance * 1 >= this.zfData.amount * 1 && this.balance * 1 > 0) {
        this.gatewayList.unshift({
          id: 0,
          name: "credit",
          title: lang.order_text8,
          url: `${url}img/common/credit-icon.svg`,
        });
      }
    },

    async showPayDialog(orderId) {
      try {
        if (this.diaInitIng) return;
        this.diaInitIng = true;
        await this.initPay();
        this.zfData.orderId = Number(orderId);
        // 获取订单详情
        const detailRes = await orderDetails(orderId);
        if (detailRes.data.status !== 200) {
          throw new Error("获取订单详情失败");
        }
        const orderData = detailRes.data.data.order;

        if (orderData.status === "Paid") {
          this.$message.success(lang.coin_text63);
          this.isShowZf = false;
          this.isPaySuccess = true;
          this.$emit("payok", this.zfData.orderId);
          return;
        }
        this.isCz = orderData.type === "recharge";
        this.zfData.amount = orderData.amount;
        // 检查特殊订单状态
        const specialStatus = ["WaitUpload", "WaitReview", "ReviewFail"];
        if (specialStatus.includes(orderData.status)) {
          this.isShowZf = false;
          return this.$refs.proof.getOrderDetails(this.zfData.orderId);
        }
        await this.getGateway();
        const canUseCoinOrderType = [
          "renew",
          "upgrade",
          "new",
          "change_billing_cycle",
        ];
        this.showCoin =
          havePlugin("Coin") && canUseCoinOrderType.includes(orderData.type);
        if (this.showCoin) {
          await this.getCoinInfo();
          if (this.coinClientInfo?.available_coin) {
            this.auto = true;
            this.useCoin = true;
            await this.applyCoin(true);
          }
        }
        // 处理支付方式选择
        await this.handleGatewaySelection();
        // 切换支付方式
        this.zfSelectChange();
      } catch (error) {
        this.getWayLoading = false;
        console.error("支付对话框初始化失败:", error);
      }
    },
  },
};
