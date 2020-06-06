const app = new Vue({
  el: "#app",
  data: {
    res: "",
    name: true,
    size: true,
    time: true,
  },

  filters: {
    //计算文件的单位
    pan_size(value) {
      if ((value / 1024) < 1) {
        return Math.round(value) + "b";
      } else if ((value / (1024 * 1024)) < 1) {
        return Math.round(value / 1024) + "Kb";
      } else if ((value / (1024 * 1024 * 1024)) < 1) {
        return Math.round(value / (1024 * 1024)) + "M";
      } else if ((value / (1024 * 1024 * 1024 * 1024)) < 1) {
        return Math.round(value / (1024 * 1024 * 1024)) + "G";
      }

    },
    cut(value) {
      //过滤掉前面的路径 ../upload
      value.slice(3);
      return encodeURI(value);
    },


  },

  methods: {
    ajax() {
      axios.post("php/ajax.php", {
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
      return 'php/del.php?url=' + val;
    },
    //文件名
    list_name() {


      function ascend(x, y) {
        return x.name.localeCompare(y.name);
      }

      this.name = !this.name;
      this.res.sort(ascend);



      if (this.name == true) {
        this.res.sort(ascend);
      } else {
        this.res.reverse(ascend);
      }


    },
    //大小
    list_size() {
      function ascend(x, y) {
        return x.size - y.size;
      };
      this.res.sort(ascend);
      this.size = !this.size;


      if (this.size == true) {
        this.res.sort(ascend);
      } else {
        this.res.reverse(ascend);
      }
    },
    //上传时间
    list_time() {
      function ascend(x, y) {
        return x.time.localeCompare(y.time);
      };
      this.res.sort(ascend);
      this.time = !this.time;

      if (this.time == true) {
        this.res.sort(ascend);
      } else {
        this.res.reverse(ascend);
      }
    },
    urle(value) {
      return 'php/down.php?url=' + value;
    },

  },
  mounted() {

  },
  created() {
    this.ajax();
  },
})