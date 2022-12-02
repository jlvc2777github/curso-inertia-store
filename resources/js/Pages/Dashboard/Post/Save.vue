<template>  
    <app-layout>
       <form name="pform" @submit.prevent="submit">
           <div class="col-span-6">
                <label for="ptitulo">Title</label>
                <input class="w-full" name="ptitulo" type="text" v-model="form.title">
                <div v-if="errors.title">{{errors.title}}</div>
           </div>
            <div class="col-span-6">
                <label for="pslug">Slug</label>
                <input  class="w-full" name="pslug" type="text" v-model="form.slug">
                <div v-if="errors.slug">{{errors.slug}}</div>
           </div>
            <div class="col-span-6">
                <label for="pdate">Date</label>
                <input  class="w-full" name="pdate" type="date" v-model="form.date">
                <div v-if="errors.date">{{errors.date}}</div>
            </div>
                     
            <div class="col-span-6">
                <label for="pcategory">Category_id</label>
                <select v-model="form.category_id"  class="rounded-md w-full border-gray-300">
                    <option value =""></option>
                    <option v-for="c in categories" :value ="c.id" :key="c.id">{{ c.title }}</option>
                </select>
                <div v-if="errors.category_id">{{errors.category_id}}</div>
            </div>
               <div class="col-span-6">
                <label for="ptext">Text</label>
                <textarea class="rounded-md w-full border-gray-300" v-model="form.text">Text</textarea>
                <div v-if="errors.text">{{errors.text}}</div>
            </div>
            <div class="col-span-6">
                <label for="ptext">Description</label>
                <textarea class="rounded-md w-full border-gray-300" v-model="form.description"></textarea>
                <div v-if="errors.description">{{errors.description}}</div>
            </div>
            <div class="col-span-6">
                <label for="pposted">Posted</label>
                <select v-model="form.posted"  class="rounded-md w-full border-gray-300">
                    <option value ="not">Not</option>
                    <option value ="yes">Yes</option>
                </select>
                <div v-if="errors.posted">{{errors.posted}}</div>
           </div>
                <div class="col-span-6">
                <label for="pposted">Type</label>
                <select v-model="form.type"  class="rounded-md w-full border-gray-300">
                    <option value ="adverb">Adverb</option>
                    <option value ="post">Post</option>
                    <option value ="course">Course</option>
                    <option value ="movie">Movie</option>
                </select>
                <button type="submit">Send</button>
                <div v-if="errors.type">{{errors.type}}</div>
           </div>
       </form>

    </app-layout>
</template>
<script>
import { Inertia } from "@inertiajs/inertia"
import { useForm } from "@inertiajs/inertia-vue3"
//import AppLayout from "../../../Layouts/AppLayout.vue"
import AppLayout from '@/Layouts/AppLayout.vue'
import FormSection from "@/Components/FormSection.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import TextInput from "@/Components/TextInput.vue"



export default {
    components:{
        AppLayout
    },
    props:{
        errors:Object,
        post:Object,
        categories:Object
    },
    setup(props){
        const form = useForm({
            id:props.post.id,
            title:props.post.title,
            slug:props.post.slug,
            description:props.post.description,
            date:props.post.date,
            text:props.post.text,
            posted:props.post.posted,
            type:props.post.type,
            category_id:props.post.category_id


        })

        function submit(){
            Inertia.put(route('post.update',form.id),form)
        }
        return {
            form,
            submit
        }
    }
}
</script>
<style scoped>

</style>