<script setup>
import axios from 'axios';
import {ref,onMounted} from 'vue';
import { useAuthStore } from '../../stores/auth';
import {  sendRequest } from '../../functions'; 
import { useRoute } from 'vue-router';

const route= useRoute();
const authStore = useAuthStore();
axios.defaults.headers.common['Authorization'] = 'Bearer' + authStore.authToken;
const form = ref({nombre:'',        
        descripcion:'',
        semestre: '',
        cantidad_de_creditos: '',
        id_del_docente: '',
        horas_de_trabajo_autonomo: ''});
const id = ref(route.params.id);
const load = ref(false);
onMounted(() => {getCategoria()});
const getCategoria = async() =>{
    await axios.get('api/asignaturas/' + id.value).then(
        response => (form.value = response.data)
    );
    load.value = true;
}
const save = () =>{
    sendRequest('PUT', form.value, '/api/asignaturas/'+id.value,'/asignaturas');

}

</script>
<template>
    
    
    <div class="row mt-5">
        <div class="card border border-white text-center" v-if ="!load">
                <div class="card-body">
                    <img src="/loading.gif" class = "img-fluid">
                </div>
            </div>        
        <div class="col-md-4 offset-md-4" v-else>            
            <div class="card border border-success">
                <div class="card-header bg-success border-success text-white" ><i class="fa-solid fa-building"></i>Editar Asignatura</div>
                <div class="card-body">
                    <form @submit.prevent="save">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                Nombre
                            </span>
                            <input autofocus type="text" v-model ="form.nombre"
                            placeholder="Programa Academico"  class=" form-control" required >
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text ">
                                 Descripcion
                            </span>
                            <input autofocus type="text" v-model ="form.descripcion"
                            placeholder="Programa Academico"  class=" form-control" required >
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text ">
                                semestre
                            </span>
                            <input autofocus type="text" v-model ="form.semestre"
                            placeholder="Programa Academico"  class=" form-control" required >
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                cantidad_de_creditos
                            </span>
                            <input autofocus type="text" v-model ="form.cantidad_de_creditos"
                            placeholder="Programa Academico"  class=" form-control" required >
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                               id_del_docente
                            </span>
                            <input autofocus type="text" v-model ="form.id_del_docente"
                            placeholder="Programa Academico"  class=" form-control" required >
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                horas_de_trabajo_autonomo
                            </span>
                            <input autofocus type="text" v-model ="form.horas_de_trabajo_autonomo"
                            placeholder="Programa Academico"  class=" form-control" required >
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                horas_de_trabajo_dirigido
                            </span>
                            <input autofocus type="text" v-model ="form.horas_de_trabajo_dirigido"
                            placeholder="Programa Academico"  class=" form-control" required >
                        </div>                     
                        <div class="d-grid col-10 mx-auto">
                            <button class="btn btn-dark">
                                <i class="fa-solid fa-save"></i>
                                Guardar
                            </button>
                        </div>
                        
                            

                    </form>
                </div>
            </div>            
        </div>

    </div>


</template>