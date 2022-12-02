<template>

    <app-layout>
<!--         <div>
            <o-modal  v-model="confirmDeleteActive">
                <p>Seguro de Eliminar</p>
                <div class="flex flex-row-reverse gap-2 bg-gray-100 p-3">
                    <o-button variant="danger" @click="deletePost">Delete</o-button>
                    <o-button @click="confirmDeleteActive=false">Cancel</o-button>
                </div>
            </o-modal>
        </div> -->
        <confirmation-modal :show="confirmDeleteActive">
            <template v-slot:title>
                Confirmation
            </template>
            <template v-slot:content>
               <p class="p-4">Estas seguro de borrar</p>
            </template>
            <template v-slot:footer>
                <div class="flex flex-row-reverse gap-2 bg-gray-100 p-3">
                    <o-button variant="danger" @click="deletePost">Delete</o-button>
                    <o-button @click="confirmDeleteActive=false">Cancel</o-button>
                </div>
            </template>
        </confirmation-modal>
        <div class="container m-auto">
            <div class="card">
                <div class="card-body">
                    <Link class="link-button-default my-3" :href="route('category.create')">Create</Link>
                    <table class="w-full border">
                        <thead class="bg-gray-100">
                            <tr class="border-b">
                                <th class="p-3">Id</th>
                                <th class="p-3">Title</th>
                                <th class="p-3">Slug</th>
                                <th class="p-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="border-b" v-for="c in categories.data" :key="c.id">
                                <td class="p-2">{{ c.id }}</td>
                                <td class="p-2">{{ c.title }}</td>
                                <td class="p-2">{{ c.slug }}</td>
                                <td class="p-2">
                                    <Link class="text-sm text-purple-400 hover:text-purple-700" :href="route('category.edit',c.id)">Edit</Link>
                                    <!-- <Link as="button" type="button" method="DELETE" class="text-sm text-red-400 hover:text-red-700 ml-2" :href="route('category.destroy',c.id)">Delete</Link> -->
                                    <o-button iconLeft="delete" rounded size="small" variant="danger" @click="confirmDeleteActive=true;deletePostRow=c.id">
                                        Delete
                                    </o-button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                
                <!-- <template v-for="l in categories.links" :key="l">
                    <Link v-if="! l.active" class="px-2 py-5"  :href="l.url" v-html="l.label" />
                    <span v-else class="px-2 py-5 cursor-pointer text-gray-500"  v-html="l.label" />
                </template> -->
                    <Pagination class="my-4" :link="categories" />
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import { Link} from "@inertiajs/inertia-vue3"
import { Inertia } from "@inertiajs/inertia"

import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Shared/Pagination.vue'

import Modal from "@/Components/Modal.vue"
import ConfirmationModal from "@/Components/ConfirmationModal.vue"
export default {
    data(){
        return{
            confirmDeleteActive:false,
            deletePostRow:""
        }
    },
    components:{
        AppLayout,
        Link,
        Pagination,
        Modal,
        ConfirmationModal
    },
    props:{
       // categories:Array
        categories:Object

    },
    methods:{
        deletePost(){
            Inertia.delete(route('category.destroy',this.deletePostRow))
            this.confirmDeleteActive=false
        }
    }
    // setup(props){
    //     function deletePost(){
    //         Inertia.delete(route('post.destroy',props.deletePostRow))
    //         props.confirmDeleteActive=false
    //     }

    // return{
    //         deletePost
    //     }
    // }
 
}
</script>
<style scoped>

</style>