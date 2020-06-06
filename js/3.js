const app = new Vue({
  el: "#app",
  data: {
    img_src: [],
  },
  methods: {
    ajax() {
      axios.post("php/image_axios.php", {
          params: {

          }
        })
        .then(function (response) {
          console.log(response.data);
          app.img_src = response.data;
        })
        .catch(function (error) {})
    },
    is_show() {
      if (this.img_src.length == 0) {
        return true;
      } else {
        return false;
      }
    },

  },
  filters: {
    //过滤掉前面的路径
    cutName(value) {
      return value.slice(10);
    }
  },
  created() {
    this.ajax();
  },

})