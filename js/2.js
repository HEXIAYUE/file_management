const app = new Vue({
  el: "#app",
  data: {
    res: "",

  },
  methods: {
    ajax() {
      axios.post("ajax.php", {
          params: {}
        })
        .then(function (response) {
          console.log(response.data);
          app.res = response.data;
          console.log(app.res);

        })
        .catch(function (error) {
          console.log(error);
        })
      console.log(this.res.length);
    },
    getGoodsHref(val) {
      return 'del.php?url='+val;
    },

  },
  mounted() {

  },
  created() {
    this.ajax();
  },
})