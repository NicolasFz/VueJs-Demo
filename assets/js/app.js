/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

import Vue from 'vue';
import Example from './components/Example'
import Widget from './components/Widget'
import VueResource from 'vue-resource';
import axios from "axios";
// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

Vue.use(VueResource);

new Vue({
    el: '#app',
    components: {Widget,Example},
    data: {
      search: null
    },
    methods: {
      performSearch: function () { 
        this.fetch();
      },
      fetch: function () {
        this.$http.get('/element/search',{params:{search:this.search}}).then((response) => {
            // success callback
            console.log('fecth success');
            console.log(response);
        }, (response) => {
            // error callback
            console.log('fecth error');
        });
        axios.get('/element/search',{params:{search:this.search}}).then((response) => {
            // success callback
            console.log('fecth Axios success');
            console.log(response.data);
            //Call a component function
            this.$refs.widget.updateSearch();
        }, (response) => {
            // error callback
            console.log('fecth error');
        });
    }
    },
    watch: {
      search: function (newValue, oldValue) { 
        console.log('Live Search something :' + this.search );
      }
    }
  });