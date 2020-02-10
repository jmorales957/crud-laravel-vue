import store from '../store'

const state= {
    prospectoEdit: {}
}

const getters = {
    getEditProspecto: state => state.prospectoEdit
}

const actions = {
    editProspectoAction ({commit}, prospecto) {
        commit('setEditProduct', prospecto)
    },
    updateProspecto({commit},prospecto) {
        // let token = document.head.querySelector('meta[name="csrf-token"]')['content']
        // console.log(token)
        // fetch(`/prospectos/${prospecto.id}`,{
        //     headres: {
        //         "Content-Type": "application/json",
        //             "Accept": "application/json",
        //              "X-Requested-With": "XMLHttpRequest",
        //             'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')['content']

        //     },
        //     method: 'put',
        //     body: JSON.stringify({
        //         nombre: prospecto.nombre,
        //         apellido_paterno: prospecto.apellido_paterno,
        //         apellido_materno: prospecto.apellido_materno,
        //         celular: prospecto.celular,
        //         email: prospecto.email,
        //         estatus: prospecto.estatus,
        //                 })
        // }).then((response) => {
        //     return response.json()
        // }).then((data) => {
        //     console.log(data)
        // }).catch((error) => {
        //     console.log('error: '+error)
        // })
            let token = document.head.querySelector('meta[name="csrf-token"]')['content']
          fetch(`/prospectos/${prospecto.id}`,{
              headers: {
                  "Content-Type": "application/json",
                  "Accept": "application/json",

              },
              method:'put',
              body: JSON.stringify({
                  nombre: prospecto.nombre,
                  apellido_paterno: prospecto.apellido_paterno,
                  apellido_materno: prospecto.apellido_materno,
                  celular: prospecto.celular,
                  email: prospecto.email,
                  estatus: prospecto.estatus,
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
    },
    deleteProspecto({commit},prospecto) {
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
                fetch(`/prospectos/${prospecto.id}`,{
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
                            'YTu registro a sido eliminado.',
                            'success'
                          ).then(() => {
                             location.href="/prospectos";
                        })
                    }
                })

            }
          })
    }

}

const mutations = {
    setEditProduct: ( state, prospecto ) => {
        state.prospectoEdit = prospecto
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}
