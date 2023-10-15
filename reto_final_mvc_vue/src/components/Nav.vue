<script setup>


import { useAuthStore } from '../stores/auth';

const authStore = useAuthStore();

</script>
<template>
    <nav class="navbar navbar-expand-lg bg-success">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"> IUDIGITAL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" v-if="authStore.user">
        <li class="nav-item px-lg-5">
          <RouterLink to="/programas-academicos" class="nav-link">Bienvenid@ {{ authStore.user.name }}</RouterLink>          
        </li>
        <li class="nav-item px-lg-5">
          <RouterLink to="/programas-academicos" class="nav-link">Pogramas Academicos</RouterLink>
        </li>
        <li class="nav-item px-lg-5">
          <RouterLink to="/asignaturas" class="nav-link">Asignaturas</RouterLink>
        </li>
      </ul>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" v-if="authStore.user">
        <li class="nav-item px-lg-5">
          <button @click ="$event => (authStore.logout())" class="btn btn-success">Salir</button>
        </li>
      </ul>
 
    </div>
  </div>
</nav>
    
</template>