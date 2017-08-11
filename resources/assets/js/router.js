import VueRouter    from 'vue-router'
import templatelists from './components/Lists.vue'
//import templatetasks from './components/Tasks.vue'

//import Bar from './component/bar'

//Define route components
const Home = { template: '<div>home</div>' }
const Foo = { template: '<div>Foo</div>' }
//const Bar = { template: '<div>Bar</div>' }
const Categories = { template: '<li v-on:click="taskList">{{ name }}<span class="menu" v-on:click="categoriesMenu"><i class="fa fa-pencil" aria-hidden="true"></i></span></li>' }
const Tasks = {
  template: '<li v-on:click="taskDetail"><input type="checkbox" v-on:click="taskComplete">{{ name }}<span class="menu" v-on:click="taskDetail"><i class="fa fa-pencil" aria-hidden="true"></i></span></li>',
   methods: {
      taskDetail: function(){},
      taskComplete: function(){}
   },
   data: {
      name: ""
   }
}

export default new VueRouter({
  mode: 'history',
  base: __dirname,
  routes: [
    { path: '/categories', component: templatelists },
    { path: '/tasks', component: require('./components/Tasks') },
  ]
});
