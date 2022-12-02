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
//import AppLayout from '@/Layouts/AppLayout.vue'
import ContactLayout from '@/Layouts/ContactLayout.vue'

import FormSection from "@/Components/FormSection.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import TextInput from "@/Components/TextInput.vue"


export default {
    components:{
        ContactLayout    
        },
    props:{
        errors:Object

    },
    setup(){
        const form = useForm({
            extra:null,
            contact_general_id:1
        })

        function submit(){
            Inertia.post(route('contact-detail.store',form))
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