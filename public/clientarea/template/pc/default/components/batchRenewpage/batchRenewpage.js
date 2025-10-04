const batchRenewpage = {
  template: /*html */ `
  <div class="batch-op-btn">

  <div class="search-btn" style="margin-right: 0.1rem;" v-if="show_quick_order === 1">
    <a :href="quick_order_url" style="color: #fff; text-decoration: none;" target="_blank">{{lang.new_goods}}</a>
  </div>


    <el-dropdown split-button type="primary" @click="handleClick"  @command="handleCommand" v-show="canOp">
        {{opName}}
        <el-dropdown-menu slot="dropdown">
          <el-dropdown-item  v-for="item in opList" :key="item.value" :command="item.value">{{item.label}}</el-dropdown-item>
        </el-dropdown-menu>
    </el-dropdown>
    <el-dialog width="5.5rem" :visible.sync="confirmDialog" :title="lang.cart_tip_text15 + opName + '?'" class="branch-confirm-dialog">
      <div slot="footer" class="dialog-footer">
        <el-button type="primary" @click="handelOp" :loading="subLoading">{{lang.cart_tip_text9}}</el-button>
        <el-button @click="confirmDialog = false;">{{lang.cart_tip_text10}}</el-button>
      </div>
    </el-dialog>


    <el-dialog width="10rem" :visible.sync="isShow" @close="rzClose" class="branch-rennew-dialog">
      <div class="dialag-content" v-loading="loading">
        <h2 class="tips-title">{{title}}</h2>
        <el-table :data="dataList" style="width: 100%" max-height="600">
          <el-table-column prop="id" label="ID" width="120">
          </el-table-column>
          <el-table-column prop="product_name" :label="lang.cart_tip_text11" min-width="180"
            :show-overflow-tooltip="true">
          </el-table-column>
          <el-table-column prop="billing_cycles" :label="lang.cart_tip_text12" min-width="180">
            <template slot-scope="{row}">
              <el-select v-model="row.select_cycles" @change="(val) =>changeCycles(row)">
                <el-option v-for="(item,index) in row.billing_cycles" :key="index" :value="index" :label=" item.customfield?.multi_language?.billing_cycle || item.billing_cycle">
                  <span>{{currency_prefix + item.price}} /{{ item.customfield?.multi_language?.billing_cycle || item.billing_cycle }}</span>
                </el-option>
              </el-select>
            </template>
          </el-table-column>
          <el-table-column prop="base_price" :label="lang.cart_tip_text13" width="180" align="right">
            <template slot-scope="{row}">
              <span>{{currency_prefix + row.cur_pirce}}</span>
            </template>
          </el-table-column>
        </el-table>
        <div class="total-price">{{lang.template_text87}}：<span class="pay-money">{{currency_prefix }} <span
              class="font-26">{{ calcTotalPrice}}</span> </span> </div>
      </div>
      <div slot="footer" class="dialog-footer">
        <el-button type="primary" @click="handelRenew" :loading="subLoading">{{lang.cart_tip_text9}}</el-button>
        <el-button @click="rzClose">{{lang.cart_tip_text10}}</el-button>
      </div>
    </el-dialog>


        <!-- 重置密码弹窗 -->
        <div class="branch-repass-dialog">
        <el-dialog width="6.8rem" :visible.sync="isShowRePass" :show-close=false @close="rePassDgClose">
          <div class="dialog-title">
            {{lang.cart_tip_text28}}
          </div>
          <div class="dialog-main">
            <el-input class="pass-input" v-model="rePassData.password" :placeholder="lang.account_tips47">
              <div class="pass-btn" slot="suffix" @click="autoPass">{{lang.common_cloud_btn1}}</div>
            </el-input>
          </div>
          <div slot="footer" class="dialog-footer">
            <div class="btn-ok" @click="rePassSub" v-loading="subLoading">{{lang.cart_tip_text9}}</div>
            <div class="btn-no" @click="rePassDgClose">{{lang.cart_tip_text10}}</div>
          </div>
        </el-dialog>
      </div>




    <pay-dialog ref="RennwPayDialog" @payok="paySuccess" @paycancel="payCancel"></pay-dialog>
    <safe-confirm ref="safeRef" :password.sync="client_operate_password" @confirm="hadelSafeConfirm"></safe-confirm>
</div>

    `,
  props: {
    title: {
      type: String,
      default: lang.cart_tip_text7,
    },
    ids: {
      type: Array,
      required: true,
      default: () => {
        return [];
      },
    },
    tab: {
      type: String,
      required: true,
      default: "", // using expiring  // overdue // deleted // ""
    },
    moduleType: {
      type: String,
      required: true,
    },
  },
  components: {
    payDialog,
    safeConfirm,
  },
  data() {
    return {
      currency_prefix:
        (JSON.parse(localStorage.getItem("common_set_before")) || {})
          ?.currency_prefix || "￥",
      isShow: false,
      loading: false,
      subLoading: false,
      confirmDialog: false,
      dataList: [],
      opType: "renew",
      client_operate_password: "",
      allOpList: [
        {
          value: "renew",
          label: lang.cart_tip_text7,
        },
        {
          value: "on",
          label: lang.cart_tip_text16,
        },
        {
          value: "off",
          label: lang.cart_tip_text17,
        },
        {
          value: "reboot",
          label: lang.cart_tip_text18,
        },
        {
          value: "hard_off",
          label: lang.cart_tip_text19,
        },
        {
          value: "hard_reboot",
          label: lang.cart_tip_text20,
        },
      ],
      cloud_moudle: ["mf_cloud", "remf_cloud", "remf_finance", "rewhmcs_cloud"],
      dcim_moudle: [
        "mf_dcim",
        "remf_dcim",
        "remf_finance_dcim",
        "rewhmcs_dcim",
      ],
      ip_moudle: ["mf_cloud_ip", "mf_cloud_disk", "huawei_eip"],
      common_moudle: ["idcsmart_common"],
      show_quick_order: 0,
      quick_order_url: "",
      isShowRePass: false,
      rePassData: {
        password: "",
      },
    };
  },
  created() {
    this.setQuickOrderUrl();
  },
  computed: {
    canOp() {
      return this.tab !== "deleted";
    },
    opList() {
      const isActive =
        this.tab === "using" || this.tab === "expiring" || this.tab == "";
      const isCloud = this.cloud_moudle.includes(this.moduleType);
      const isDcim = this.dcim_moudle.includes(this.moduleType);
      const isIp = this.ip_moudle.includes(this.moduleType);
      const isCommon = this.common_moudle.includes(this.moduleType);
      if (!isActive) {
        return [
          {
            value: "renew",
            label: lang.cart_tip_text7,
          },
        ];
      }
      if (isIp) {
        return [
          {
            value: "renew",
            label: lang.cart_tip_text7,
          },
          {
            value: "unlink",
            label: lang.cart_tip_text21,
          },
        ];
      } else if (isCloud) {
        return [...this.allOpList];
      } else if (isDcim) {
        return [
          {
            value: "renew",
            label: lang.cart_tip_text7,
          },
          {
            value: "on",
            label: lang.cart_tip_text16,
          },
          {
            value: "off",
            label: lang.cart_tip_text17,
          },
          {
            value: "reboot",
            label: lang.cart_tip_text18,
          },
        ];
      }
      if (isCommon) {
        return [
          ...this.allOpList,
          {
            value: "crack_pass",
            label: lang.cart_tip_text27,
          },
          // {
          //   value: "reinstall",
          //   label: lang.cart_tip_text28,
          // },
        ];
      } else {
        return [
          {
            value: "renew",
            label: lang.cart_tip_text7,
          },
        ];
      }
    },
    idsArr() {
      return this.ids.map((item) => {
        return item.id;
      });
    },
    rewIdArr() {
      return this.dataList.map((item) => {
        return item.id;
      });
    },
    calcTotalPrice() {
      return this.dataList
        .reduce((acc, cur) => {
          return acc + cur.cur_pirce * 1;
        }, 0)
        .toFixed(2);
    },
    opName() {
      return (
        this.opList.filter((item) => item.value === this.opType)[0]?.label ||
        lang.cart_tip_text22
      );
    },
  },
  watch: {
    opList(val) {
      this.opType = val[0].value || "";
    },
  },
  methods: {
    setQuickOrderUrl() {
      // 拿到当前导航完整路径 去除location.origin
      this.currentNav = location.href.replace(location.origin, "");
      const params = getUrlParams();
      let currentMenu;
      const menuList = JSON.parse(localStorage.getItem("frontMenus") || "[]");
      let isFindById = false;
      // 找到当前导航
      // 有id直接使用id
      if (params.m) {
        currentMenu = menuList.find(
          (item) =>
            item.id == params.m || item?.child?.some((el) => el.id == params.m)
        );
        isFindById = true;
      }
      if (!currentMenu) {
        currentMenu = menuList.find(
          (item) =>
            (item.url !== "" && this.currentNav.includes(item.url)) ||
            item?.child?.some(
              (el) => el.url !== "" && this.currentNav.includes(el.url)
            )
        );
        isFindById = false;
      }
      if (currentMenu?.child) {
        if (isFindById) {
          currentMenu = currentMenu?.child?.find((el) => el.id == params.m);
        } else {
          currentMenu = currentMenu.child.find(
            (el) => el.url !== "" && this.currentNav.includes(el.url)
          );
        }
      }

      if (currentMenu) {
        this.show_quick_order = currentMenu?.show_quick_order;
        this.quick_order_url = currentMenu?.quick_order_url;
      }
    },
    // 随机生成密码
    autoPass() {
      let passLen = 9;
      let pass =
        randomCoding(1) +
        randomCoding(1).toLocaleLowerCase() +
        0 +
        genEnCode(passLen, 1, 1, 0, 1, 0);
      this.rePassData.password = pass;
    },
    rePassSub() {
      if (!this.rePassData.password) {
        this.$message.error(lang.cart_tip_text29);
        return;
      }
      this.handelOp();
    },
    rePassDgClose() {
      this.isShowRePass = false;
      this.rePassData.password = "";
    },
    hadelSafeConfirm(val) {
      this[val]();
    },
    handleCommand(command) {
      this.opType = command;
    },
    handleClick() {
      if (this.opType === "") {
        this.$message.warning(lang.cart_tip_text23);
        return;
      }
      if (this.idsArr.length === 0) {
        this.$message.warning(lang.cart_tip_text24);
        return;
      }
      if (this.opType === "renew") {
        this.openDia();
        return;
      }
      if (this.opType === "crack_pass") {
        this.isShowRePass = true;
        return;
      }
      this.confirmDialog = true;
    },
    handelOp(e, remember_operate_password = 0) {
      // if (!this.client_operate_password) {
      //   this.$refs.safeRef.openDialog("handelOp");
      //   return;
      // }
      const client_operate_password = this.client_operate_password;
      this.client_operate_password = "";
      this.subLoading = true;
      const params = {
        id: this.idsArr,
        action: this.opType,
        client_operate_password,
        client_operate_methods: "handelOp",
        remember_operate_password,
      };
      if (this.opType === "crack_pass") {
        params.password = this.rePassData.password;
      }
      batchOperation(this.moduleType, params)
        .then((res) => {
          const arr = res.data.data;
          const tips = arr
            .map((item) => {
              return `<p>ID：${item.id}：${item.msg}</p>`;
            })
            .join("");
          this.$notify({
            title: lang.cart_tip_text25,
            message: tips,
            duration: 0,
            dangerouslyUseHTMLString: true,
          });
          this.$emit("success");
          this.subLoading = false;
          this.confirmDialog = false;

          if (this.opType === "crack_pass") {
            this.isShowRePass = false;
          }
        })
        .catch((err) => {
          this.subLoading = false;
          this.$message.error(err.data.msg);
          if (err.data.data) {
            if (
              !client_operate_password &&
              err.data.data.operate_password === 1
            ) {
              this.$refs.safeRef.openDialog("handelOp");
              return;
            } else {
              return this.$message.error(err.data.msg);
            }
          }
        });
    },
    openDia() {
      this.isShow = true;
      this.getRenewList();
    },
    changeCycles(item) {
      item.cur_pirce = this.calcPrice(item);
    },
    calcPrice(row) {
      return (
        row.billing_cycles.filter(
          (item, index) => index == row.select_cycles
        )[0]?.price || 0
      );
    },
    getRenewList() {
      this.loading = true;
      batchRenewList({ids: this.idsArr})
        .then((res) => {
          this.dataList = res.data.data.list.map((item) => {
            item.select_cycles = 0;
            item.cur_pirce = item.billing_cycles[0].price;
            return item;
          });
          this.loading = false;
        })
        .catch((err) => {
          this.loading = false;
          this.$message.error(err.data.msg);
        });
    },
    rzClose() {
      this.isShow = false;
    },
    paySuccess(e) {
      this.isShow = false;
      this.$emit("success");
    },
    // 取消支付回调
    payCancel(e) {},
    handelRenew() {
      this.subLoading = true;
      const billing_cycles = {};
      this.dataList.forEach((item) => {
        billing_cycles[item.id] = item.billing_cycles.filter(
          (items, index) => index == item.select_cycles
        )[0].billing_cycle;
      });
      aipBatchRenew({
        ids: this.rewIdArr,
        billing_cycles,
        customfield: {},
      })
        .then((res) => {
          this.subLoading = false;
          if (res.data.code === "Unpaid") {
            this.$refs.RennwPayDialog.showPayDialog(res.data.data.id);
          } else {
            this.isShow = false;
            this.$emit("success");
          }
        })
        .catch((err) => {
          this.subLoading = false;
          this.$message.error(err.data.msg);
        });
    },
  },
};
