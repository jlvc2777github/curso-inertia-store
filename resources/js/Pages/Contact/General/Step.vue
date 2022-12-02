<template>
    <contact-layout>
        <div >
            {{ $page.props.step }}

            <div class="flex"  v-if="$page.props.step!=4">
                <div class="flex mx-auto flex-col sm:flex-row">
                    <div class="step" :class="{active: $page.props.step==1}">
                        STEP 1
                    </div>
                    <div class="step" :class="{active: parseInt($page.props.step)==2}">
                        STEP 2
                    </div>
                    <div class="step" :class="{active: $page.props.step==3}">
                        STEP 3
                    </div>
                </div>
            </div>
            <general-edit  v-if="$page.props.step==1"  :errors="errors" :contactGeneral="contactGeneral" />
            <company-edit v-if="$page.props.step==2.5" 
                :errors="errors" 
                :contactCompany="contactGeneral.company"
                :contactGeneralId="contactGeneral.id"
                @back-step-event="backStep" 
            />
            <person-edit v-if="$page.props.step==2" 
                :errors="errors" 
                :contactPerson="contactGeneral.person"
                :contactGeneralId="contactGeneral.id"  
                 @back-step-event="backStep" 
            />
            <detail-edit v-if="$page.props.step==3" 
                :errors="errors" 
                :contactDetail="contactGeneral.detail"  
                :contactGeneralId="contactGeneral.id"
                :backStep="contactGeneral.type == 'person' ? 2 : 2.5"
                @back-step-event="backStep" 
            /> 
            <div v-if="$page.props.step==4" >
                <h3 class="text-center">
                    Contacto realizodo exitosamente
                </h3>
            </div>
             <!-- <general-edit :errors="errors" :contactGeneral="contactGeneral" /> -->
        </div>
    </contact-layout>
</template>
<script>
import ContactLayout from '@/Layouts/ContactLayout.vue'
import GeneralEdit from "@/Pages/Contact/General/Save.vue"
import CompanyEdit from "@/Pages/Contact/Company/Save.vue"
import PersonEdit from "@/Pages/Contact/Person/Save.vue"
import DetailEdit from "@/Pages/Contact/Detail/Save.vue"

export default {
    methods:{
        backStep(value){
          //  console.log(value)
            this.$page.props.step=value
        }
    },
    props:{
        errors:Object,
        contactGeneral:Object
    },
    components:{
        ContactLayout,
        GeneralEdit,
        CompanyEdit,
        PersonEdit,
        DetailEdit
    }
}
</script>