import Vue from "vue"
import { Row, Col, Button, message, Form, Icon, Input, Checkbox, Alert } from 'ant-design-vue';
Vue.prototype.$message = message

Vue.component(Row.name, Row)
Vue.component(Col.name, Col)
Vue.component(Checkbox.name, Checkbox)
Vue.component(Input.name, Input)
Vue.component(Form.name, Form)
Vue.component(Icon.name, Icon)
Vue.component(Button.name, Button)
Vue.component(Button.Group.name, Button.Group)
Vue.component(Button.Group.name, Button.Group)
Vue.component(Alert.name, Alert)

Vue.use(Row)
Vue.use(Col)
Vue.use(Checkbox)
Vue.use(Input)
Vue.use(Form)
Vue.use(Icon)
Vue.use(Button)
Vue.use(Alert)

export { Vue };
