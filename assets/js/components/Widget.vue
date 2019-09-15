    <template>
       <div>
           <p>This is an example of a custom Widget in VueJs</p>
           <div v-text="msg"></div>
           <p>{{ msg }}</p>
               <ul>
                <li :key="word.id" v-for="word in words">{{ word }}</li>
               </ul>
            <p>{{ searchResult }}</p>
       </div>
    </template>
    <script>
       export default {
           name: "Widget",
            data () {
                return {
                    msg: 'Welcome to Your Vue.js App',
                    words: [],
                    searchResult: ''
                };
            },
            methods: {
                performWidgetSearch: function () { 
                    console.log('Loking for something :' + this.search );
                },
                updateSearch: function(){
                    console.log('Update Search');
                }
            },
            mounted() {

                let el = document.querySelector("div[data-words]");
                let mywords = el.dataset.words.split(",");

                this.words.push.apply(this.words, mywords);
            }
       }
       console.log('Init Widget');
    </script>
    <style scoped>
    </style>