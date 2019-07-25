<template>
  <a-layout id="dashboard" class="h-100v">
    <nav-bar :collapsed="collapsed"/>
    <a-layout>
      <a-layout-header style="background: #fff; padding: 0">
        <a-row>
          <a-col :span="12">
            <a-icon
              class="trigger"
              :type="collapsed ? 'menu-unfold' : 'menu-fold'"
              @click="()=> collapsed = !collapsed"
            />
          </a-col>
          <a-col :span="12" align="end">
            <a-button type="danger" shape="circle" icon="logout" class="logout" @click="logout()"></a-button>
          </a-col>
        </a-row>
        
      </a-layout-header>
      <a-layout-content :style="{ margin: '24px 16px', padding: '24px', background: '#fff', minHeight: '280px' }">
        <router-view></router-view>
      </a-layout-content>
    </a-layout>
  </a-layout>
</template>
<script>
import NavBar from './nav-bar';
import { mapGetters, mapActions } from "vuex";
import { JWT_LOGOUT } from "../../store/modules/auth/actions.type";
export default {
  components: {
    NavBar
  },
  data(){
    return {
        loading: false,
        collapsed: false
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
    logout() {
      this[JWT_LOGOUT]();
      this.$router.go({name:'login'});
    }
  },
}
</script>

<style lang="scss" scoped>
  #dashboard{
    .trigger {
      font-size: 18px;
      line-height: 64px;
      padding: 0 24px;
      cursor: pointer;
      transition: color .3s;
      &:hover {
        color: #1890ff;
      }
    }
    .logout {
      margin-right: 3rem;
    }
  }
</style>
