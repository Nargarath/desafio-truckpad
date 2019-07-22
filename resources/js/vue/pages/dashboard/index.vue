<template>
  <div>dashboard</div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import { JWT_LOGOUT } from "../../store/modules/auth/actions.type";


export default {
  data(){
    return {
      loading: false
    }
  },
  beforeCreate () {
    this.form = this.$form.createForm(this);
  },
  computed:{
    ...mapGetters(["token"])
  },
  methods: {
    ...mapActions([JWT_LOGOUT]),
  },
};
</script>
<style lang="scss" scoped>

</style>
