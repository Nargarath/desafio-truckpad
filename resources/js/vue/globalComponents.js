import Vue from "vue"
import { Row, Col, Button, message, Form, Icon, Input, Checkbox, Alert, Menu, Layout,Table, Divider } from 'ant-design-vue';
Vue.prototype.$message = message

Vue.component(Menu.name, Menu)
Vue.component(Layout.name, Layout)
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
Vue.component(Table.name, Alert)
Vue.component(Divider.name, Divider)

Vue.use(Row)
Vue.use(Col)
Vue.use(Checkbox)
Vue.use(Input)
Vue.use(Form)
Vue.use(Icon)
Vue.use(Button)
Vue.use(Alert)
Vue.use(Menu)
Vue.use(Layout)
Vue.use(Table)
Vue.use(Divider)


export { Vue };
