<script setup>
import axios from 'axios';
import {ref,onMounted} from 'vue';
import { confirmation } from '../../functions';
import { useAuthStore } from '../../stores/auth';

const authStore = useAuthStore();
axios.defaults.headers.common['Authorization'] = 'Bearer' + authStore.authToken;
onMounted(() => {getProgramas()});
const programas = ref([]);
const load = ref(false);
const getProgramas = async () =>{
    await axios.get('/api/programas-educativos').then(
        response => (programas.value = response.data));
        load.value = true;
}

const deletePrograma = (id,name) => {
    confirmation(name,('/api/programas-academicos/' + id), '/programas-academicos');
}

</script>
<template>
    <div class="container text-center">
        <div class="row align-items-center">
            <div v-for="cat in programas" :key ="cat.id" class="col">
                <div   class="card" style="width: 18rem;">
                        <img src="../../../public/aprende.jpg" class="card-img-top" alt="Aprende">
                    <div class="card-body">
                        <h3>{{ cat.nombre }}</h3>            
                    </div>
                    <div class="container text-center">
                        <div class="row align-items-center">
                            <div class="col">                                
                                <router-link :to="{path:'asignaturasbyprograma/'+ cat.id}" 
                                class ="btn btn-success">
                                    Pénsum<i class="fas fa-angle-double-right"></i>
                                </router-link>
                            </div>
                             <div class="col">
                                <router-link :to="{path:'edit/'+ cat.id}" 
                                    class = "btn btn-warning">
                                    <i class="fa-solid fa-edit"></i>
                                </router-link>
                            </div>
                            <!--div class="col">
                                <button class ="btn btn-danger"
                                    @click="$event => deleteCategoria(cat.id,cat.nombre)">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div-->
                        </div>
                    </div>        
                </div>
            </div>   
        </div>
    </div>

</template>