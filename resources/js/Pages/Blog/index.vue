<template>
    <web-layout>
        
        <div class="container m-auto">
            <div class="card">
                <div class="card-body">
            
                    <div class="grid grid-cols-2 gap-2">   
                        <input class="w-full" v-debounce.5s="customSearch" 
                        :debounce-events="['keyup']" 
                        v-model="search"  
                        autofocus
                        placeholder="search....." />

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
                </div>
            </div>                    

                    <div class="flex flex-col items-center mt-5">
                        <div class="w-full sm:max-w-4xl overflow-hidden">
                                <div v-for="p in posts.data" :key="p" class="p-3">
                                    <h4 class="text-center text-4xl mb-3">{{p.title}} </h4>
                                    <p class="text-center text-sm text-gray-500 italic
                                    font-bold uppercase tracking-widest">{{ p.date }}</p>
                                    <img class="w-full rounded-md mt-4" :src="p.image ??  '/image/post/default.jpg'" alt="img">
                                   
                                    <p class="mx-4">{{ p.description }}</p>

                                    <p class="mx-4">{{ p.type }}</p>

                                    <div class="flex flex-col items-center mt-7">
                                        <a class="btn-primary" :href="route('web.show',p.slug)">Read More!</a>
                                    </div>

                                    <hr class="my-16">
                                </div>
                        </div>
                    </div>
                
                <!-- <template v-for="l in categories.links" :key="l">
                    <Link v-if="! l.active" class="px-2 py-5"  :href="l.url" v-html="l.label" />
                    <span v-else class="px-2 py-5 cursor-pointer text-gray-500"  v-html="l.label" />
                </template> -->
                    <Pagination class="my-4" :link="posts" />

        </div>
    </web-layout>
</template>
<script>
import { Link} from "@inertiajs/inertia-vue3"
import { Inertia } from "@inertiajs/inertia"

import WebLayout from '@/Layouts/WebLayout.vue'
import Pagination from '@/Shared/Pagination.vue'
export default {
    data(){
        /* deben de ser props */
        const type="";
        const posted=""; 
        const search="";
        const from="";
        const to="";       
            
    },
    components:{
        WebLayout,
        Link,
        Pagination
    },
    props:{
       // categories:Array
        posts:Object,
        categories:Object, 
       
    },
    methods:{
        customSearch(){
            //console.log(search)
            Inertia.get(route('web.index'),{
                category_id:this.category_id,
                type:this.type,
                search:this.search,
                from:this.from,
                to:this.to,
             
            })
        },

        cleanSearch(){
            Inertia.get(route('web.index'))
        },
    }
 
}
</script>
<style scoped>

</style>