<template>
  <iframe
    v-if="account != null"
    :key="account.length"
    :src="
      'https://trade.mql5.com/trade?servers=' +
      account.broker +
      '&amp;trade_server=' +
      account.broker +
      '&demo_all_servers&=1&amp;startup_mode=open_trade&amp;lang=' +
      account.language +
      '&amp;save_password=on&login=' +
      account.number
    "
    allowfullscreen="allowfullscreen"
    :style="
      'height:' +
      windowHeight +
      'px;' +
      'width:' +
      windowWidth +
      'px;' +
      'margin:-27px'
    "
  ></iframe>
</template>

<script>
  export default {
    data() {
      return {
        account: [],
        windowHeight: window.innerHeight * 0.88,
        windowWidth: window.innerWidth * 0.955,
        txt: "",
      };
    },
    created() {
      this.fetchData();
    },
    mounted() {
      this.$nextTick(() => {
        window.addEventListener("resize", this.onResize);
      });
    },
    beforeUnmount() {
      window.removeEventListener("resize", this.onResize);
    },
    methods: {
      goBack() {
        window.history.length > 1
          ? this.$router.go(-1)
          : this.$router.push("/");
      },
      fetchData() {
        axios.post("/user/fetch/forex").then((response) => {
          this.account = response.account;
        });
      },
      onResize() {
        this.windowHeight = window.innerHeight * 0.88;
        this.windowWidth = window.innerWidth * 0.955;
      },
    },
  };
</script>
