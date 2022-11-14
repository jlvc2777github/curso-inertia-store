<template>
    
<!--          <form name="pform" @submit.prevent="submit">
            <label for="ptitulo">Title</label>
            <input name="ptitulo" type="text" v-model="form.title">
            <div v-if="errors.title">{{errors.title}}</div>
            <label for="pslug">Slug</label>
            <input name="pslug" type="text" v-model="form.slug">
            <button type="submit">Send</button>
            <div v-if="errors.slug">{{errors.slug}}</div>
        </form>  -->
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
                <button type="submit">Send</button>
                <div v-if="errors.slug">{{errors.slug}}</div>
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
        errors:Object
    },
    setup(){
        const form = useForm({
            title:null,
            slug:null
        })

        function submit(){
            Inertia.post(route('category.store',form))
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