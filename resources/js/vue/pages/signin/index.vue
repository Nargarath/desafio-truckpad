<template>
  <a-row type="flex" justify="space-around" align="middle" class="h-100v">
    <a-col :md="8" :lg="5">
      <a-form
        id="form"
        :form="form"
        class="login-form"
        @submit="handleSubmit"
      >
        <a-alert
          message="Error"
          :description="error.message"
          type="error"
          showIcon
          v-show="error.active"
        />
        <a-form-item>
          <a-input
            v-decorator="[
              'email',
              { rules: [{ type: 'email' ,required: true }] }
            ]"
            placeholder="seu@email.com.br"
            :disabled="loading"
          >
            <a-icon
              slot="prefix"
              type="mail"
              style="color: rgba(0,0,0,.25)"
            />
          </a-input>
        </a-form-item>
        <a-form-item>
          <a-input
            v-decorator="[
              'password',
              { rules: [{ required: true }] }
            ]"
            type="password"
            placeholder="password"
            :disabled="loading"
          >
            <a-icon
              slot="prefix"
              type="lock"
              style="color: rgba(0,0,0,.25)"
            />
          </a-input>
        </a-form-item>
        <a-form-item>
          <a-checkbox
            v-decorator="[
              'remember',
              {
                valuePropName: 'checked',
                initialValue: true,
              }
            ]"
          >
            lembrar-me
          </a-checkbox>
          <a-button
            type="primary"
            html-type="submit"
            class="login-form-button"

            :loading="loading"
          >
            Entrar <a-icon type="right" />
          </a-button>
        </a-form-item>
      </a-form>
    </a-col>
  </a-row>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import { JWT_LOGIN } from "../../store/modules/auth/actions.type";


export default {
  data(){
    return {
      loading: false,
      error: {
        active: false,
        message: ''
        
      }
    }
  },
  beforeCreate () {
    this.form = this.$form.createForm(this);
  },
  computed:{
    ...mapGetters(["token"])
  },
  methods: {
    ...mapActions([JWT_LOGIN]),
    handleSubmit (e) {
      e.preventDefault();
      this.loading = true;
      this.error.active = false;
      this.form.validateFields((err, values) => {
        if (!err) {
          this.$store.dispatch(JWT_LOGIN,{email: values.email,password: values.password})
          .then(
            (data) => {
              this.$router.push({ name: 'dashboard.index' });

            }
          )
          .catch(
            (err) => {
              if(err.response.data.status === 'error'){
                this.error.active = true;
                this.error.message = err.response.data.error;
                this.loading = false;
              }
            }
          );
        } else {
          this.loading = false;
        }
        
      });
    },
  },
};
</script>
<style lang="scss" scoped>
#form {
  .login-form {
    max-width: 300px;
  }

  .login-form-forgot {
    float: right;
  }

  .login-form-button {
    width: 100%;
  }
  .ant-alert{
    margin-bottom: 12px;
  }
}

</style>
