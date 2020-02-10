<template>
    <div class="container-fluid">
        <table id="prospectos" class="display">
            <thead>

            </thead>
            <tbody>

            </tbody>
        </table>

        <modal></modal>
    </div>
</template>

<script>
    import Modal from './ModalProspectosComponent'
    import {mapActions, mapGetters} from 'vuex'

    require('datatables.net-dt')
    export default {
        data() {
            return {
                data: [],
            }
        },
        components: {
            'modal': Modal
        },
        props: [
            'prospectos'
        ],
        methods: {
            ...mapActions(['editProspectoAction', 'deleteProspecto']),
        },
        mounted() {
            var table = $('#prospectos').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
                },
                data: this.prospectos,
                columns: [
                    {
                        title: 'Nombre',
                        data: 'nombre'

                    },
                    {
                        title: 'Apellido Paterno',
                        data: 'apellido_paterno'

                    },
                    {
                        title: 'Apellido Materno',
                        data: 'apellido_materno'

                    },
                    {
                        title: 'Celular',
                        data: 'celular'

                    },
                    {
                        title: 'Email',
                        data: 'email'

                    },
                    {
                        title: 'Estatus',
                        data: 'estatus',
                        render: function (data, type, row) {
                            if (row.estatus === 'A') {
                                return `<div class="alert alert-success" role="alert">
                                        ACTIVO
                                    </div>`
                            } else {
                                return `<div class="alert alert-warning" role="alert">
                                INACTIVO
                             </div>`
                            }
                        }

                    },
                    {
                        title: 'Acciones',
                        render: function (data, type, row) {
                            let prospect = JSON.stringify(row)
                            return `<a href='reuniones/registro/${row.id}' class="btn btn-primary" title="Reuniones" ><i class="fas fa-handshake"></i></i></a>
                        <a href='llamadas/registro/${row.id}' class="btn btn-info" title="Llamadas" ><i class="fas fa-phone"></i></i></a>
                        <button class="btn btn-warning edit" data-prospecto='${prospect}' ><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger eliminar" data-prospecto='${prospect}' ><i class="fas fa-trash"></i></button>
                       `;
                        }

                    }
                ],

            });
            let self = this
            $('#prospectos tbody').on('click', '.edit', function () {
                let p = $(this).data('prospecto')
                self.editProspectoAction(p)
                $('#exampleModal').modal()
            });
            $('#prospectos tbody').on('click', '.eliminar', function () {
                let p = $(this).data('prospecto')
                self.deleteProspecto(p)
            });
        },
    }
</script>

<style scoped>

</style>
