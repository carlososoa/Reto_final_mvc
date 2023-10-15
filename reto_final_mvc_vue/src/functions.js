import Swal from 'sweetalert2';
import {nextTick} from '@vue/runtime-core';
import { useAuthStore} from '@/stores/auth.js';


export function show_alerta(msj,icon,focus){
    if(focus !== ''){
        nextTick(()=> focus.value.focus());
        
    }
    Swal.fire({
        title:msj,
        icon:icon,bottonsStyling:true
    });

}

export function confirmation(name,url,redirect){
    const alert = Swal.mixin({buttonsStyling:true});
    alert.fire({
        title:'Esta seguro de eliminar '+name+'?',
        icon: 'question',showCancelButton:true,
        conffirmButtonText:'<i class="fa-solid fa-check"></i> Si, eliminar',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar'

    }).then((result) => {
        if(result.isConfirmed){
            sendRequest('DELETE', {},url,redirect);
        }

    });

}

export async function sendRequest(method,params,url,redirect=''){
    const authStore = useAuthStore();
    axios.defaults.headers.common['Authorization'] = 'Bearer'+ authStore.authToken;
    let res;
    await axios({method:method,url:url,data:params}).then(
        response => {
            res= response.data.status,
            show_alerta(response.data.message,'success', ''),
            setTimeout(
                () => (redirect !=='')? window.location.href = redirect:'',2000
            )
        }).catch((errors)=> {
            let desc='';
            res = errors.response.data.status;
            let mensaje = errors.message;
            if (Array.isArray(errors)) {
                errors.response.data.errors.map((e) => { desc = desc + ' ' +e})
                console.log('error')
              }
            if(mensaje == 'Request failed with status code 403'){
                show_alerta('No tienes permisos para realizar estos cambios','error', '')
                setTimeout(
                    () => (redirect !=='')? window.location.href = redirect:'',2000
                )

            }else{
                show_alerta(desc,'error', '')
                setTimeout(
                    () => (redirect !=='')? window.location.href = redirect:'',2000
                )
            }
            
        })
        return res;

}