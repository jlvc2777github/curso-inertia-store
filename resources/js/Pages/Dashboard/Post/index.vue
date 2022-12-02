<template>
    <app-layout>
        
        <div class="container m-auto">
            <div class="card">
                <div class="card-body">
                    <Link class="link-button-default my-3" :href="route('post.create')">Create</Link>

                    <div class="grid grid-cols-2 gap-2">   
                        <div class="col-span-2 border grid grid-cols-2 gap-2 p-3">     
                        <label>Date From</label>      
                        <label>Date To</label>          
                        <input class="w-full" type="date" v-model="from"   placeholder="fecha desde" />                            
                        <input class="w-full" type="date" v-model="to"   placeholder="fecha hasta" />
                        </div>
                        <input class="w-full" v-debounce.5s="customSearch" 
                        :debounce-events="['keyup']" 
                        v-model="search"  
                        autofocus
                        placeholder="search....." />

                        <select @change="customSearch" v-model="posted"  class="rounded-md w-full border-gray-300">
                            <option :value ="null">Posted</option>
                            <option value ="not">Not</option>
                            <option value ="yes">Yes</option>
                        </select>

                        <select v-model="type"  class="rounded-md w-full border-gray-300">
                            <option value ="adverb">Adverb</option>
                            <option value ="post">Post</option>
                            <option value ="course">Course</option>
                            <option value ="movie">Movie</option>
                        </select>  

                        <select v-model="category_id"  class="rounded-md w-full border-gray-300">
                            <option value =""></option>
                            <option v-for="c in categories" :value ="c.id" :key="c.id">{{ c.title }}</option>
                        </select>              
                        <div>        
                            <button class="link-button-default" @click="customSearch">
                                Filter
                            </button>
                        </div>
                        <div>        
                            <button class="link-button-default" @click="cleanSearch">
                                Clean
                            </button>
                        </div>                        
                    </div>

                    <table class="w-full border">
                        <thead class="bg-gray-100">
                            <tr class="border-b">
                                <th v-for="(c,k) in columns" :key="c" class="p-3">
                                    <button @click="sort(k)">
                                        {{c}} 
                                        <template v-if="k == sortColumn">
                                            <template v-if="'asc' == sortDirection">
                                                &uarr;
                                            </template>                                                
                                            <template v-else>
                                                &darr;
                                            </template >
                                        </template>
                                    </button>
                                </th>
                                <th class="p-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="border-b" v-for="c in posts.data" :key="c.id">
                                <td class="p-2">{{ c.id }}</td>
                                <td class="p-2">{{ c.date }}</td>
                                <td class="p-2">{{ c.title.substring(0,15) }}</td>
                                <td class="p-2">
                                    <textarea class="w-48">
                                        {{ c.description }}
                                    </textarea>
                                </td>
                                <td class="p-2">{{ c.type }}</td>
                                <td class="p-2">{{ c.category }}</td>
                                <td class="p-2">
                                    <Link class="text-sm text-purple-400 hover:text-purple-700" :href="route('post.edit',c.id)">Edit</Link>
                                    <Link as="button" type="button" method="DELETE" class="text-sm text-red-400 hover:text-red-700 ml-2" :href="route('post.destroy',c.id)">Delete</Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                
                <!-- <template v-for="l in categories.links" :key="l">
                    <Link v-if="! l.active" class="px-2 py-5"  :href="l.url" v-html="l.label" />
                    <span v-else class="px-2 py-5 cursor-pointer text-gray-500"  v-html="l.label" />
                </template> -->
                    <Pagination class="my-4" :link="posts" />
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import { Link} from "@inertiajs/inertia-vue3"
import { Inertia } from "@inertiajs/inertia"

import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Shared/Pagination.vue'
export default {
    data(){
        /* deben de ser props */
        const type="";
        const posted=""; 
        const search="";
        const from="";
        const to="";       
      
        return{
            column:"id"
        }
        
    },
    components:{
        AppLayout,
        Link,
        Pagination
    },
    props:{
       // categories:Array
        posts:Object,
        categories:Object, 
        columns:"",
        sortDirection:"",
        sortColumn:"",
        
       
    },
    methods:{
        customSearch(){
            //console.log(search)
            Inertia.get(route('post.index'),{
                category_id:this.category_id,
                type:this.type,
                posted:this.posted,
                search:this.search,
                from:this.from,
                to:this.to,
                sortColumn:this.column,
                sortDirection:this.sortDirection == 'asc' ? 'desc' : 'asc',
             
            })
        },
        sort(column='id'){
            this.column = column
            this.customSearch()
        },
        cleanSearch(){
            Inertia.get(route('post.index'))
        },
    },
    setup(){


    return{
            
        }
    }
 
}
</script>
<style scoped>

</style>