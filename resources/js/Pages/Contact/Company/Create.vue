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
                            <button type="submit">Send</button>
                            <div v-if="errors.choices">{{errors.choices}}</div>
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
            name:null,
            identification:null,
            email:null,
            extra:null,
            choices:null,
            contact_general_id:1
        })

        function submit(){
            Inertia.post(route('contact-company.store',form))
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