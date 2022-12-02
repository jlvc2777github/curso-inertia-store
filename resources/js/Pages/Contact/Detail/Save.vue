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
                            <button >Send</button>
                            <span class="mt-5 ml-3 cursor-pointer" @click="$emit('backStepEvent',backStep)">Back</span>
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
        contactDetail:{
            default:{
                id:"",
                extra:"",
            },
        },
        contactGeneralId:{
            type:Number,
            default:{
                id:0
            }
        },
        backStep:{
            type:Number,
            default:{
                id:2
            }
        },
    },
    setup(props){
        const form = useForm({
            extra:props.contactDetail.extra,
            contact_general_id:props.contactGeneralId
        })

        function submit(){
           if(form.id=="") Inertia.post(route('contact-detail.store',form));
           else
           Inertia.post(route('contact-detail.update',form.id),{
                _method:"put",
                extra:form.extra,
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