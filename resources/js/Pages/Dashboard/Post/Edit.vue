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
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label for="pimg">File</label>
                                <input  class="w-full" name="pimg" type="file" @input="form.image=$event.target.files[0]" >
                                <div v-if="errors.image">{{errors.image}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <o-upload v-model="form.image">
                <o-button tag="a" variant="primary">
                    <o-icon icon="upload" />
                    <span>Click to upload </span>
                </o-button>
            </o-upload>>
            <div class="col-span-6">
                <label for="pposted">Multiple</label>
                <o-upload v-model="dropFiles" multiple drag-drop>
                    <section class="ex-center">
                        <p>
                            <o-icon icon="upload" size="is-large"></o-icon>
                        </p>
                    </section>
                </o-upload>>
            </div>
            <div class="col-span-6">
                <label for="pposted">Type</label>
                <select v-model="form.type"  class="rounded-md w-full border-gray-300">
                    <option value ="adverd">adverd</option>
                    <option value ="post">Post</option>
                    <option value ="course">Course</option>
                    <option value ="movie">Movie</option>
                </select>
                <button type="submit">Send</button>
                <div v-if="errors.type">{{errors.type}}</div>
           </div>
       </form>
        <div class="container mb-4" v-if="post.image">
            <div class="card">
                <div class="card-body">
                    <img class="max-w-xs rounded-md" :src="'/image/post/'+post.image" alt="img">
                    <button class="mt-4 bg-red-100"
                    @click="form.delete(route('post.image-delete',form.id))" >Delete</button>
                    <a :href="'/image/post/' + post.image" download="" class="ml-2 mt-4 link-button-default">Descargar</a>
                </div>
            </div>
        </div>
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

import { ref } from "vue"

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
            category_id:props.post.category_id,
            image:""


        })
      //  const  dropFiles=[]
      const dropFiles = ref([])

        function submit(){
         //  Inertia.put(route('post.update',form.id),form)
         // si agrego campo de imagen
            Inertia.post(route('post.update',form.id),{
                _method:'put',
                title:form.title,
                date:form.date,
                description:form.description,
                text:form.text,
                type:form.type,
                posted:form.posted,
                category_id:form.category_id,
                image:form.image,
            })
        }
        function upload(){
            Inertia.post(route('post.upload',form.id),form)
        }
        return {
            form,
            submit,
            upload
            
        }
    },
    watch:{
        dropFiles:{
            handler(val){
              // console.log(this.$page)
                Inertia.post(route('post.upload',this.$page.props.id),{
                    "image":val
                })
            }
        }
    }
}
</script>
<style scoped>

</style>