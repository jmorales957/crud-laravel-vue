<template>
    <div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Reunion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="createLlamada()">
                            <div class="form-group">
                                <label for="nombre">Asunto <span class="req">*</span></label>
                                <input type="text" class="form-control" id="nombre" v-model="asunto" placeholder="Escribe el asunto" >
                            </div>
                            <div class="form-group">
                                <label for="fecha">Fecha <span class="req">*</span></label>
                                <input type="date" class="form-control" id="fecha" v-model="fecha" >
                            </div>
                            <div class="form-group">
                                <label for="hora">Hora<span class="req">*</span></label>
                                <input type="time" class="form-control" id="hora" v-model="hora" >
                            </div>
                            <div class="form-group">
                                <label for="lugar">Lugar <span class="req">*</span></label>
                                <input type="text" class="form-control" id="lugar" v-model="lugar" placeholder="Escribe el lugar" >
                            </div>
                            <div class="form-group">
                                <label for="estatus">Estatus <span class="req">*</span></label>
                                <select class="form-control" id="estatus" v-model="estatus">
                                    <option value="P">Pendiente</option>
                                    <option value="R">Realizada</option>
                                    <option value="NR">No Realizada</option>

                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" @click="createLlamada()">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                asunto: '',
                fecha_hora: '',
                estatus: '',
                fecha: '',
                hora: '',
                lugar: ''
            }
        },
        props: [
            'prospecto'
        ],
        methods: {
            getAsDate(day, time)
            {
                var dateObj = new Date(day + ' ' + time);
                console.log(JSON.stringify(dateObj))
                return dateObj

            },
            createLlamada() {
                let token = document.head.querySelector('meta[name="csrf-token"]')['content']
                this.fecha_hora = this.getAsDate(this.fecha, this.hora)
                fetch('/reuniones',{
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",

                    },
                    method:'post',
                    body: JSON.stringify({
                        aunto: this.asunto,
                        fecha_hora: this.fecha_hora,
                        lugar: this.lugar,
                        estatus: this.estatus,
                        prospectos_id: this.prospecto.id,
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
                            location.href=`/reuniones/registro/${this.prospecto.id}`;
                        })
                    }
                })
            }
        },
    }
</script>
