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
                            <label for="psurname">Surname</label>
                            <input class="rounded-md w-full border-gray-300" v-model="form.surname" />
                            <div v-if="errors.surname">{{errors.surname}}</div>
                        </div>  
                         <div class="col-span-6">
                            <label for="psurname">Other</label>
                            <input class="rounded-md w-full border-gray-300" v-model="form.other" />
                            <div v-if="errors.other">{{errors.other}}</div>
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
                            <button >Send</button>
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
        contactPerson:{
            default:{
                id:"",
                name:"",
                surname:"",
                other:"",
                choices:"",
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
            id:props.contactPerson.id,
            name:props.contactPerson.name,
            surname:props.contactPerson.surname,
            other:props.contactPerson.other,
            choices:props.contactPerson.choices,
            contact_general_id:props.contactGeneralId
        })

        function submit(){
            if(form.id=="") Inertia.post(route('contact-person.store',form));
            else
            Inertia.post(route('contact-person.update',form.id),{
                _method:"put",
                name:form.name,
                surname:form.surname,
                other:form.other,
                choices:form.choices,
                contact_general_id:props.contactGeneralId 
            }); 
            console.log("update");
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