import store from '../store'

const state= {
    llamadaEdit: {}
}

const getters = {
    getEditLlamada: state => state.llamadaEdit
}

const actions = {
    editLlamadaAction ({commit}, llamada) {
        commit('setEditLlamada', llamada)
    },
    updateLlamada({commit},llamada) {
    console.log(llamada)
        let token = document.head.querySelector('meta[name="csrf-token"]')['content']
          fetch(`/llamadas/${llamada.id}`,{
              headers: {
                  "Content-Type": "application/json",
                  "Accept": "application/json",

              },
              method:'put',
              body: JSON.stringify({
                  aunto: llamada.aunto,
                  fecha_hora: llamada.fecha_hora,
                  estatus: llamada.estatus,
                  prospectos_id: llamada.prospectos_id,
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
                       location.href=`/llamadas/registro/${llamada.prospectos_id}`;
                  })
              }
          })
    },
    deleteLlamada({commit},llamada) {
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
                fetch(`/llamadas/${llamada.id}`,{
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
                             location.href=`/llamadas/registro/${llamada.prospectos_id}`;
                        })
                    }
                })

            }
          })
    }

}

const mutations = {
    setEditLlamada: ( state, llamada ) => {
        state.llamadaEdit = llamada

    }
}

export default {
    state,
    getters,
    actions,
    mutations
}
