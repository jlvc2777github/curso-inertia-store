<template>  
    <contact-layout>
        <div class="card">
            <div class="card-body">
                   <form name="pform" @submit.prevent="submit">
                     <template >Create Detail</template>
                        <div class="col-span-6">
                            <label for="pmessage">Extra</label>
                            <textarea class="rounded-md w-full border-gray-300" v-model="form.extra">Text</textarea>
                            <div v-if="errors.extra">{{errors.extra}}</div>
                            <button type="submit">Send</button>
                        </div> 
                </form>
            </div>
        </div>
    </contact-layout>
</template>
<script>
import { Inertia } from "@inertiajs/inertia"
import { useForm } from "@inertiajs/inertia-vue3"

import ContactLayout from '@/Layouts/ContactLayout.vue'
import FormSection from "@/Components/FormSection.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import TextInput from "@/Components/TextInput.vue"

import { ref } from "vue"

export default {
    components:{
        ContactLayout
    },
    props:{
        errors:Object,
        contactDetail:{
            type:Object,
            default:{
                id:"",
                extra:"",
                contact_general_id:""
            }
        }       
    },
    setup(props){
        const form = useForm({
            id:props.contactDetail.id,
            extra:props.contactDetail.extra,
            contact_general_id:1
        })
      //  const  dropFiles=[]
      const dropFiles = ref([])

        function submit(){
         //  Inertia.put(route('post.update',form.id),form)
         // si agrego campo de imagen
         
            Inertia.post(route('contact-detail.update',form.id),{
                _method:'put',
                extra:form.extra,
                contact_general_id:1
            })
        }
        return {
            form,
            submit
            
        }
    },
}
</script>
<style scoped>

</style>