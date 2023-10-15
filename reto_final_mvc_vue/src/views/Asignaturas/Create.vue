<script setup>
import axios from 'axios';
import {ref,onMounted, nextTick} from 'vue';
import { useAuthStore } from '../../stores/auth';
import { show_alerta, sendRequest } from '../../functions'; 
const authStore = useAuthStore();
axios.defaults.headers.common['Authorization'] = 'Bearer' + authStore.authToken;
const form = ref({nombre:'',        
        descripcion:'',
        semestre: '',
        cantidad_de_creditos: '',
        id_del_docente: '',
        horas_de_trabajo_autonomo: ''})

const nameInput = ref('');
const save = () =>{
    sendRequest('POST', form.value, '/api/asignaturas','/asignaturas');
    //form.value.nombre = '';
    console.log(form.value);
    nextTick(() => nameInput.value.focus());
    
        

}

</script>
<template>
    <div class="row mt-5">
        <div class="col-md-4 offset-md-4">
            <div class="card border border-success">
                <div class="card-header bg-success border-success "></div>
                <div class="card-body">
                    <form @submit.prevent="save">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-building"></i>
                            </span>
                            <input autofocus type="text" v-model ="form.nombre"
                            placeholder="Nombre de Asignatura"  class=" form-control" required ref="nameInput">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-building"></i>
                            </span>
                            <input autofocus type="text" v-model ="form.descripcion"
                            placeholder="Descripción"  class=" form-control" required ref="nameInput">
                        </div> 
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-building"></i>
                            </span>
                            <input autofocus type="text" v-model ="form.semestre"
                            placeholder="semestre"  class=" form-control" required ref="nameInput">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-building"></i>
                            </span>
                            <input autofocus type="text" v-model ="form.cantidad_de_creditos"
                            placeholder="cantidad_de_creditos"  class=" form-control" required ref="nameInput">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-building"></i>
                            </span>
                            <input autofocus type="text" v-model ="form.id_del_docente"
                            placeholder="id_del_docente"  class=" form-control" required ref="nameInput">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-building"></i>
                            </span>
                            <input autofocus type="text" v-model ="form.horas_de_trabajo_autonomo"
                            placeholder="horas_de_trabajo_autonomo"  class=" form-control" required ref="nameInput">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-building"></i>
                            </span>
                            <input autofocus type="text" v-model ="form.horas_de_trabajo_dirigido"
                            placeholder="horas_de_trabajo_dirigido"  class=" form-control" required ref="nameInput">
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