<template>
    <h2>To Do Tool!</h2>
    <div className="topEnd">
        <button @click='newItem'>Create Item</button>
        <input id="showDone" type= 'checkbox' v-model = 'showDone'/><label for = "showDone">Show ALL records</label>
    </div>
    <hr color="black"/>
    <table align = "center">
        <tr v-if="unDoneItems.length !== 0">
            <td align='left'>Done</td>
            <td align='left'>Title</td>
            <td align="left">Description</td>
            <td>Created</td>
            <td>Expiry</td>
            <td align='center'>action</td>
        </tr>
        <tr className="list" v-for="(item, index) in unDoneItems" :key='index'>
            <Item :item = 'item' :index='index'/>
        </tr>
        <tr v-if="items.length === 0">
            <td colspan="6" className="centered">There are no to do items. Please create some!</td>
        </tr>
    </table>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component';
import Item             from './Item.vue';

import { ITEM         } from '../declarations';

@Options(
{
    name: 'ToDo',
    components: 
    {
        Item,
    },
    data()
    {
        return{
            index: 0,
            loading: true,
            error: false,
            showDone: false,
        }
    },
    computed:
    {
        items(): ITEM[]
        {
            return this.$store.state.items
        },
        unDoneItems(): ITEM[]
        {
            if (this.showDone)
            {
                return this.items;
            }
            return this.items.filter((item: ITEM) => !item.done)
        }
    },
    mounted()
    {
        this.$store.dispatch('GET_ALL_ITEMS');
    },
    methods:
    {
        newItem()
        {
            const now   = new Date();
            const year  = now.getFullYear()
            const month = `0${now.getMonth()+1}`.slice(-2);
            const day   = `0${now.getDate()}`.slice(-2);
            const fNow  = `${year}-${month}-${day}`

            const newItem: ITEM =
            { 
                title       : '',
                description : '',
                done        : false,
                deleted     : false,
                created     : fNow,
                expires     : fNow,
            }

            this.$store.dispatch("CREATE_ITEM", newItem)
        },
    }
})
export default class ToDo extends Vue {}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.topEnd
{
    display                                      : inline-block;
    margin                                       : 10px 10px;

}
.inputs
{
    display                                      : inline-block;
    margin                                       : 10px 10px;
}
.light
{
    color                                        : #6b6b6b;
}
.dark
{
    color                                        : black;
}
h3
{
    margin                                       : 40px 0 0;
}
ul
{
    list-style-type                              : none;
    padding                                      : 0;
}
li
{
    display                                      : inline-block;
    margin                                       : 0 10px;
}
a
{
    color                                        : #42b983;
}
td
{
    color                                        : black;
    font-weight                                  : bold;
    font-size                                    : small;
    padding                                      : 10px 10px 10px 10px;
}
.centered
{
    text-align                                   : center;
}
</style>
