<template>  
    <contact-layout>
        <template #header>
            <div>
                Titulo
            </div>
        </template>
        <div class="card">
            <div class="card-body">
                <form name="pform" @submit.prevent="submit">
                    <template >Create Contact</template>
                        <div class="col-span-6">
                            <label for="psubject">Subject</label>
                            <textarea class="rounded-md w-full border-gray-300" v-model="form.subject">Text</textarea>
                            <div v-if="errors.subject">{{errors.subject}}</div>
                        </div>      
                        <div class="col-span-6">
                            <label for="pmessage">Message</label>
                            <textarea class="rounded-md w-full border-gray-300" v-model="form.message">Text</textarea>
                            <div v-if="errors.message">{{errors.message}}</div>
                        </div> 
            
                        <div class="col-span-6">
                            <label for="pposted">Type</label>
                            <select v-model="form.type"  class="rounded-md w-full border-gray-300">
                                <option value ="company">Company</option>
                                <option value ="person">Person</option>
                            </select>
                            <button class="mt-5" type="submit">Send</button>
                            <div v-if="errors.type">{{errors.type}}</div>
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
        errors:Object,
        contactGeneral:{
            default:{
                id:"",
                subject:"",
                message:"",
                type:""
            }
        }

    },
    setup(props){
        const form = useForm({
            id:props.contactGeneral.id,
            subject:props.contactGeneral.subject,
            message:props.contactGeneral.message,
            type:props.contactGeneral.type
        })

        function submit(){
            if(form.id=="") Inertia.post(route('contact-general.store',form));
            else
            Inertia.post(route('contact-general.update',form.id),{
                _method:"put",
                subject:form.subject,
                message:form.message,
                type:form.type    
            });
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