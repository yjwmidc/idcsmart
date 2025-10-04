/* 分页 */
const comPagination = {
  template: `
     <t-pagination
     :show-jumper="showJumper"
     :current="page"
     :page-size="limit"
     :total="total"
     :page-size-options="sizeOptions"
     v-bind="$attrs"
     @change="changePage" />
    `,
  props: {
    page: {
      type: Number,
      required: true,
      default () {
        return 1;
      },
    },
    limit: {
      type: Number,
      required: true,
      default () {
        return 10;
      },
    },
    total: {
      type: Number,
      required: true,
      default () {
        return 0;
      },
    },
    pageSizeOptions: {
      type: Array,
      default () {
        return [10, 20, 50, 100];
      }
    },
    showJumper: {
      type: Boolean,
      default: true
    }
  },
  data () {
    return {
      sizeOptions: []
    };
  },
  created () {
    this.sizeOptions = [...new Set([...this.pageSizeOptions, this.limit])].sort((a, b) => a - b);
  },
  methods: {
    changePage (e) {
      this.$emit('page-change', e);
    }
  }
};
