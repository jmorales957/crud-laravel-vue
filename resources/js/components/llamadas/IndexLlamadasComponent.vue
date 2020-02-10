<template>
    <div class="container-fluid">
        <div class="row">
            <h1>Llamadas de {{prospecto.nombre}}</h1>
            <div class="line"></div>
            <h2>Pendientes : {{pendientes}} Realizados: {{realizados}} No realizados: {{no_realizados}}</h2>
            <div class="line"></div>
            <button class="btn btn-samll btn-info" data-toggle="modal" data-target="#exampleModal" >Agregar Llamada</button>
        </div>
        <table id="llamadas" class="display">
            <thead>
            </thead>
            <tbody>
            </tbody>
        </table>
        <modal-create :prospecto="prospecto"></modal-create>
        <modal-edit :fecha="fecha" :hora="hora"></modal-edit>
    </div>
</template>

<script>
import ModalEdit from './ModalEditLlamadasComponent'
import ModalCreate from './ModalCreateLlamadasComponent'

import {mapActions, mapGetters} from 'vuex'

require('datatables.net-dt')
export default {
    data() {
        return {
            fecha: '',
            hora: ''
        }
    },
    computed: {
        ...mapGetters(['getEditLlamada'])
    },
    components: {
        'modal-edit': ModalEdit,
        'modal-create': ModalCreate
    },
    props: [
        'llamadas',
        'prospecto',
        'pendientes',
        'realizados',
        'no_realizados'
    ],
    methods: {
        ...mapActions(['editLlamadaAction','deleteLlamada']),
    },
    mounted() {
        var table =$('#llamadas').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
            },
            data: this.llamadas,
            columns: [
                {
                    title: 'Asunto',
                    data: 'aunto'

                },
                {
                    title: 'Fecha y Hora',
                    data: 'fecha_hora'

                },
                {
                    title: 'Estatus',
                    data: 'estatus',
                    render: function (data,type,row) {
                        if(row.estatus == 'P') {
                              return `<div class="alert alert-warning" role="alert">
                                        PENDIENTE
                                    </div>`
                        }else if(row.estatus == 'R') {
                             return `<div class="alert alert-success" role="alert">
                                        REALIZADA
                                    </div>`
                        }else {
                             return `<div class="alert alert-danger" role="alert">
                                        NO REALIZADA
                                    </div>`
                        }
                    }

                },
                {
                    title: 'Acciones',
                    render: function (data,type, row){
                        let call = JSON.stringify(row)
                        return `
                        <button class="btn btn-warning edit" data-llamada='${call}' ><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger eliminar" data-llamada='${call}' ><i class="fas fa-trash"></i></button>
                       `;
                    }

                }
            ],

        });
        let self = this
        $('#llamadas tbody').on('click', '.edit', function () {
            let p = $(this).data('llamada')
            var dateTime = p.fecha_hora.split(" ");
            let hora = '';
            hora = dateTime[1].slice(0,5)
            p.hora = hora
            p.fecha = dateTime[0]
            self.editLlamadaAction(p)

            $('#modal-edit').modal()
        });
        $('#llamadas tbody').on('click', '.eliminar', function () {
            let p = $(this).data('llamada')
            self.deleteLlamada(p)
        });
    },
}
</script>
