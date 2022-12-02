<template>  
    <contact-layout>
       <div class="card">
           <div class="card-body">
                
                <form name="pform" @submit.prevent="submit">
                    <template >Create Contact</template>
                        <div class="col-span-6">
                            <label for="psubject">Name</label>
                            <input class="rounded-md w-full border-gray-300" v-model="form.name" />
                            <div v-if="errors.name">{{errors.name}}</div>
                        </div>  
                        <div class="col-span-6">
                            <label for="psubject">Id</label>
                            <input class="rounded-md w-full border-gray-300" v-model="form.identification" />
                            <div v-if="errors.identification">{{errors.identification}}</div>
                        </div>  
                        <div class="col-span-6">
                            <label for="psubject">Email</label>
                            <input class="rounded-md w-full border-gray-300" type="email" v-model="form.email" />
                            <div v-if="errors.email">{{errors.email}}</div>
                        </div>  
                        <div class="col-span-6">
                            <label for="pmessage">Extra</label>
                            <textarea class="rounded-md w-full border-gray-300" v-model="form.extra">Text</textarea>
                            <div v-if="errors.extra">{{errors.extra}}</div>
                        </div>     
            
                        <div class="col-span-6">
                            <label for="pposted">Choice</label>
                            <select v-model="form.choices"  class="rounded-md w-full border-gray-300">
                                <option value ="adverd">adverd</option>
                                <option value ="post">Post</option>
                                <option value ="course">Course</option>
                                <option value ="movie">Movie</option>
                            </select>                           
                            <div v-if="errors.choices">{{errors.choices}}</div>
                             <button class="mt-5" type="submit" >Send</button>
                            <span class="mt-5 ml-3 cursor-pointer" @click="$emit('backStepEvent',1)">Back</span>
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
    emits:['backStepEvent'],
    props:{
        errors:Object,
        contactCompany:{
            default:{
                id:"",
                name:"",
                identification:"",
                email:"",
                extra:"",
                choices:""
               
            },
        },
        contactGeneralId:{
            type:Number,
            default:{
                id:0
            }
        },
    },
    setup(props){
        const form = useForm({
            id:props.contactCompany.id,
            name:props.contactCompany.name,
            identification:props.contactCompany.identification,
            email:props.contactCompany.email,
            extra:props.contactCompany.extra,
            choices:props.contactCompany.choices,
            contact_general_id:props.contactGeneralId
        })

        function submit(){
             
            if(form.id=="") Inertia.post(route('contact-company.store'),form);
            else
            Inertia.post(route('contact-company.update',form.id),{
                _method:"put",
                name:form.name,
                identification:form.identification,
                email:form.email,
                extra:form.extra,
                choices:form.choices,
                contact_general_id:props.contactGeneralId   
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