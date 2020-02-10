<template>
    <div class="container-fluid">
        <div class="row">
            <h1>Reuniones de {{prospecto.nombre}}</h1>
            <div class="line"></div>
            <h2>Pendientes : {{pendientes}} Realizados: {{realizados}} No realizados: {{no_realizados}}</h2>
            <div class="line"></div>
            <button class="btn btn-samll btn-info" data-toggle="modal" data-target="#exampleModal" >Agregar Reunion</button>
        </div>
        <table id="reuniones" class="display">
            <thead>
            </thead>
            <tbody>
            </tbody>
        </table>
        <modal-create :prospecto="prospecto"></modal-create>
        <modal-edit></modal-edit>
    </div>
</template>

<script>
    import ModalEdit from './ModalEditComponent'
    import ModalCreate from './ModalCreateComponent'

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
            ...mapGetters(['getEditReunion'])
        },
        components: {
            'modal-edit': ModalEdit,
            'modal-create': ModalCreate
        },
        props: [
            'reuniones',
            'prospecto',
            'pendientes',
            'realizados',
            'no_realizados'
        ],
        methods: {
            ...mapActions(['editReunionAction','deleteReunion']),
        },
        mounted() {
            var table =$('#reuniones').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
                },
                data: this.reuniones,
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
                            let meting = JSON.stringify(row)
                            return `
                        <button class="btn btn-warning edit" data-reunion='${meting}' ><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger eliminar" data-reunion='${meting}' ><i class="fas fa-trash"></i></button>
                       `;
                        }

                    }
                ],

            });
            let self = this
            $('#reuniones tbody').on('click', '.edit', function () {
                let p = $(this).data('reunion')
                var dateTime = p.fecha_hora.split(" ");
                let hora = '';
                hora = dateTime[1].slice(0,5)
                p.hora = hora
                p.fecha = dateTime[0]
                self.editReunionAction(p)

                $('#modal-edit').modal()
            });
            $('#reuniones tbody').on('click', '.eliminar', function () {
                let p = $(this).data('reunion')
                self.deleteReunion(p)
            });
        },
    }
</script>
