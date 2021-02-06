<template>
    <td>
        <input type        = "checkbox" 
               name        = "done" 
               :checked    = "itm.done"
               @change     = "updateStore(itm.title, itm.description, $event.target.checked, itm.deleted, itm.expires, itm.created)"
        />
    </td>
    <td>
        <input className   = "name" 
               type        = "text" 
               placeholder = "The To Do item"
               :value      = "itm.title" 
               @blur       = "updateStore($event.target.value, itm.description, itm.done, itm.deleted, itm.expires, itm.created)"
        />
    </td>
    <td>
        <input className   = "description" 
               type        = "text" 
               placeholder = "Description of the To Do"
               :value      = "itm.description" 
               @blur       = "updateStore(itm.title, $event.target.value, itm.done, itm.deleted, itm.expires, itm.created)"
        />
    </td>
    <td>
        <input type="date" 
               :value      = 'itm.created'
               @change     = "updateStore(itm.title, itm.description, itm.done, itm.deleted, itm.expires, $event.target.value)"
        />
    </td>
    <td>
        <input type="date" 
               :value      = 'itm.expires'
               @change     = "updateStore(itm.title, itm.description, itm.done, itm.deleted, $event.target.value, itm.created)"
        />
    </td>
   <td>
        <button @click="deleteItem">Delete</button>
    </td>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component';
import { ITEM         } from '../declarations';

@Options(
{
    name: 'Item',
    props: [ 'item', 'index' ],
    computed:
    {
        itm(): ITEM[]
        {
            return this.item
        }
    },
    methods:
    {
        updateStore(title: string, description: string, done: boolean, deleted: boolean, expires: string, created: string)
        {
            const newItem: ITEM =
            { 
                id: this.itm.id,
                title,
                description,
                done,
                deleted,
                created,
                expires,
            }

            this.$store.dispatch("UPDATE_ITEM", newItem)
            console.log(newItem)
        },
        deleteItem()
        {
            this.$store.dispatch("DELETE_ITEM", this.itm.id)
        },
    }

})
export default class Item extends Vue {}
</script>

<style scoped>
input
{
    display                                      : inline-block;
    margin                                       : 10px 10px;
}
.name
{
    width                                        : 15em;
}
.description
{
    width                                        : 25em;
}
</style>