<template>
    <input v-model="count" type="number" class="w-20" min="1" >
    <button @click="submit">Send</button>

</template>
<script>
import { Inertia } from "@inertiajs/inertia"
export default {
    data(){

        return{
            count:this.pcount
        }
    },
    props:{
        post:{
            type:Object,
            required:true
        },
        pcount:{
            type:String,
            default:"1"
        }        
    },
    methods:{
        submit(){
            Inertia.post(route('shop.add',{
                post:this.post.id,
                count:this.count
            }));
        }
    }
}
</script>