<template>
<div>
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Llamada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form @submit.prevent="edit(getEditLlamada)">
                <div class="form-group">
                    <label for="nombre">Asunto <span class="req">*</span></label>
                    <input type="text" class="form-control" id="nombre" v-model="getEditLlamada.aunto" placeholder="Escribe el asunto" >
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha <span class="req">*</span></label>
                    <input type="date" class="form-control" id="fecha" v-model="getEditLlamada.fecha" >
                </div>
                <div class="form-group">
                    <label for="hora">Hora<span class="req">*</span></label>
                    <input type="time" class="form-control" id="hora" v-model="getEditLlamada.hora" >
                </div>
                <div class="form-group">
                    <label for="estatus">Estatus <span class="req">*</span></label>
                    <select class="form-control" id="estatus" v-model="getEditLlamada.estatus">
                    <option value="P">Pendiente</option>
                    <option value="R">Realizada</option>
                    <option value="NR">No Realizada</option>

                    </select>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="edit(getEditLlamada)">Actualizar</button>
      </div>
    </div>
  </div>
</div>
</div>
</template>

<script>
import {mapGetters,mapActions} from 'vuex'
export default {
    computed: {
        ...mapGetters(['getEditLlamada']),

    },
    props: [
        'prospecto',
    ],
    methods: {
         getAsDate(day, time)
            {
                 var dateObj = new Date(day + ' ' + time);
                 console.log(JSON.stringify(dateObj))
                    return dateObj
            },
        edit(llamada) {
           llamada.fecha_hora =  this.getAsDate(llamada.fecha, llamada.hora)
          this.updateLlamada(llamada)
        },

        ...mapActions(['updateLlamada'])
    },
    mounted(){
        var self = this
    console.log(this.fecha_edit =self.fecha)
    }
}
</script>
