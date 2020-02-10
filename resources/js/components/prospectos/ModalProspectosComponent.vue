<template>
<div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form @submit.prevent="updateProspecto(getEditProspecto)">
                <div class="form-group">
                    <label for="nombre">Nombre <span class="req">*</span></label>
                    <input type="text" class="form-control" id="nombre" v-model="getEditProspecto.nombre" placeholder="Escribe tu nombre" >
                </div>
                <div class="form-group">
                    <label for="apellido_paterno">Apelldo Paterno</label>
                    <input type="text" class="form-control" id="apellido_paterno" v-model="getEditProspecto.apellido_paterno" placeholder="Escribe tu apellido paterno">
                </div>
                <div class="form-group">
                    <label for="apellido_materno">Apellido Materno</label>
                    <input type="text" class="form-control" id="apellido_materno" v-model="getEditProspecto.apellido_materno"  placeholder="Escribe tu apellido materno">
                </div>
                <div class="form-group">
                    <label for="celular">Celular <span class="req">*</span></label>
                    <input type="text" class="form-control" id="celular" v-model="getEditProspecto.celular" placeholder="Escribe tu celular" >
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="req">*</span></label>
                    <input type="email" class="form-control" id="email" v-model="getEditProspecto.email"  placeholder="Escribe tu email" >
                </div>
                <div class="form-group">
                    <label for="estatus">Estatus</label>
                    <select class="form-control" id="estatus" v-model="getEditProspecto.estatus">
                    <option value="A">Activo</option>
                    <option value="I">Inactivo</option>
                    </select>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="updateProspecto(getEditProspecto)">Actualizar</button>
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
        ...mapGetters(['getEditProspecto'])
    },
    methods: {
        ...mapActions(['updateProspecto'])
    },
    mounted() {



    },
}
</script>
