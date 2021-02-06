import Vuex     from 'vuex'
import axios    from 'axios';

import { ITEM } from '../declarations'
/* eslint-disable */
const items: ITEM[] = []

const store = new Vuex.Store(
{
    state:
    {
        items
    },
    mutations:
    {
        setEverything(state, payload)
        {
            state.items = payload;
        },
        createItem(state, item: ITEM)
        {
            state.items.push(item)
        },
        updateItem(state, payload: ITEM)
        {
            const idx         = state.items.findIndex((item) => item.id === payload.id)

            state.items[idx]  = payload
        },
        deleteItem(state, id)
        {
            const index = state.items.findIndex((item) => item.id === id)

            state.items.splice(index, 1)
        }
    },
    actions:
    {
        GET_ALL_ITEMS({commit})
        {
            axios.get('http://localhost:8000/v1/api/items')
            .then(response => {
                commit('setEverything', response.data)
            })
        },
        CREATE_ITEM({commit}, item)
        {
            axios.post(`http://localhost:8000/v1/api/items/create`, item)
            .then((response) => {
                commit('createItem', response.data)
            })
        },
        UPDATE_ITEM({commit}, item)
        {
            axios.put(`http://localhost:8000/v1/api/item/${item.id}`, item)
            .then(() => {
                commit('updateItem', item)
            })
        },
        DELETE_ITEM({commit}, id)
        {
            axios.delete(`http://localhost:8000/v1/api/item/delete/${id}`)
            .then(() => {
                commit('deleteItem', id)
            })
        },
    },
    modules:
    {
    }
})

export default store;
