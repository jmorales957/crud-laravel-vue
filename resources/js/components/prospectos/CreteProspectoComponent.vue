<template>
    <div class="container-fluid">
        <div class="row"><h1>Prospectos</h1></div>
        <div class="">
            <form @submit.prevent="crear">
                <div class="form-group">
                    <label for="nombre">Nombre <span class="req">*</span></label>
                    <input type="text" class="form-control" id="nombre" v-model="nombre" placeholder="Escribe tu nombre" >
                </div>
                <div class="form-group">
                    <label for="apellido_paterno">Apelldo Paterno</label>
                    <input type="text" class="form-control" id="apellido_paterno" v-model="apellido_paterno" placeholder="Escribe tu apellido paterno">
                </div>
                <div class="form-group">
                    <label for="apellido_materno">Apellido Materno</label>
                    <input type="text" class="form-control" id="apellido_materno" v-model="apellido_materno"  placeholder="Escribe tu apellido materno">
                </div>
                <div class="form-group">
                    <label for="celular">Celular <span class="req">*</span></label>
                    <input type="text" class="form-control" id="celular" v-model="celular" placeholder="Escribe tu celular" >
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="req">*</span></label>
                    <input type="email" class="form-control" id="email" v-model="email"  placeholder="Escribe tu email" >
                </div>
                <div class="form-group">
                    <label for="estatus">Estatus</label>
                    <select class="form-control" id="estatus" v-model="estatus">
                    <option value="A">Activo</option>
                    <option value="I">Inactivo</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            nombre: '',
            apellido_paterno: '',
            apellido_materno: '',
            celular: '',
            email: '',
            estatus: ''
        }
    },
    methods: {
        crear () {
              let token = document.head.querySelector('meta[name="csrf-token"]')['content']
            fetch('/prospectos',{
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",

                },
                method:'post',
                body: JSON.stringify({
                    nombre: this.nombre,
                    apellido_paterno: this.apellido_paterno,
                    apellido_materno: this.apellido_materno,
                    celular: this.celular,
                    email: this.email,
                    estatus: this.estatus,
                    _token: token

                })
            }).then((response) =>  {
                return response.json()
            }).then((data) => {
                let error_html = '';
                if(data.hasOwnProperty('errors')) {
                    for(let prop in data.errors){
                       for(let error of data.errors[prop]) {
                          error_html +=`<li>${error}</li>`
                       }
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: `<ul>${error_html}</ul>`,
                        }).then(()=> {
                           var span= document.getElementsByClassName('req')
                           for(let i = 0;i<span.length;i++){
                               span[i].style.cssText = 'color:red;';
                           }
                        })
                }else  {
                    Swal.fire({
                        icon: 'success',
                        title: 'Tu trabajo a sido guardado',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                         location.href="/prospectos";
                    })
                }
            })
        }
    }
}
</script>
