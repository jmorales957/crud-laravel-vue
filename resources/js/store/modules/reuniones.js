import store from '../store'

const state= {
    reunionEdit: {}
}

const getters = {
    getEditReunion: state => state.reunionEdit
}

const actions = {
    editReunionAction ({commit}, reunion) {
        commit('setEditReunion', reunion)
    },
    updateReunion({commit},reunion) {
        console.log(reunion)
        let token = document.head.querySelector('meta[name="csrf-token"]')['content']
        fetch(`/reuniones/${reunion.id}`,{
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",

            },
            method:'put',
            body: JSON.stringify({
                aunto: reunion.aunto,
                fecha_hora: reunion.fecha_hora,
                estatus: reunion.estatus,
                lugar:reunion.lugar,
                prospectos_id: reunion.prospectos_id,
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
                    location.href=`/reuniones/registro/${reunion.prospectos_id}`;
                })
            }
        })
    },
    deleteReunion({commit},reunion) {
        let token = document.head.querySelector('meta[name="csrf-token"]')['content']

        Swal.fire({
            title: 'Estas seguro?',
            text: "No podras recuoerar la informacion!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, Eliminar!'
        }).then((result) => {
            if (result.value) {
                fetch(`/reuniones/${reunion.id}`,{
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        'X-CSRF-TOKEN':token
                    },
                    method:'delete',
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
                        Swal.fire(
                            'Eliminado!',
                            'Tu registro a sido eliminado.',
                            'success'
                        ).then(() => {
                            location.href=`/reuniones/registro/${reunion.prospectos_id}`;
                        })
                    }
                })

            }
        })
    }

}

const mutations = {
    setEditReunion: ( state, reunion ) => {
        state.reunionEdit = reunion

    }
}

export default {
    state,
    getters,
    actions,
    mutations
}
