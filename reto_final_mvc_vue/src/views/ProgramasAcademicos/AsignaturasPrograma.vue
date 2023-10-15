<script setup>
import axios from 'axios';
import {ref,onMounted} from 'vue';
import { useAuthStore } from '../../stores/auth';
import {  sendRequest } from '../../functions'; 
import { useRoute } from 'vue-router';

const route= useRoute();
const authStore = useAuthStore();
axios.defaults.headers.common['Authorization'] = 'Bearer' + authStore.authToken;
const form = ref({id:'',nombre:''});
const id = ref(route.params.id);
onMounted(() => {getPrograma()});



const getPrograma = async () =>{
    axios.get('api/programas-educativos/' + id.value).then(
        response => (form.value.nombre = response.data.nombre)
    );
    
}

const load = ref(false);
const cursos = ref([]);
onMounted(()=>getAsignaturas());
const getAsignaturas = async () => {
  axios.get('/api/programa-educativo/'+id.value+' /asignaturas')
  .then((response) => {    
    console.log(response.data);
    cursos.value = response.data; 
    load.value = true;
  })
  .catch((error) => {
    console.error(error);
  }); 
  
}





</script>
<template>
  <div class="card border border-white text-center" v-if ="!load">
                <div class="card-body">
                    <img src="../../../public/loading.gif" class = "img-fluid">
                </div>
      </div>

  <div v-else >
      <div class="card border border-white text-center" v-if ="!load">
                <div class="card-body">
                    <img src="../../../public/loading.gif" class = "img-fluid">
                </div>
      </div>
    
      <div >        
        <h1 >{{ form.nombre }}</h1>
        

        <div class="table-responsive" >
                  <table class ="table table-bordered table-hover">
                      <thead><tr><th>Asignatura</th><th>Semestre</th><th>Cant Creditos</th><th>Horas de trabajo autonomo</th><th>Horas de trabajo dirigido</th></tr></thead>
                      <tbody class="table-group-divider">
                          <tr v-for="curso in cursos" :key ="curso.id">
                              <td>{{ curso.nombre }}</td>
                              <td>{{ curso.semestre}}</td>
                              <td>{{ curso.cantidad_de_creditos}}</td>
                              <td>{{ curso.horas_de_trabajo_autonomo}}</td>
                              <td>{{ curso.horas_de_trabajo_dirigido}}</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
      </div>
  </div>
    
</template>