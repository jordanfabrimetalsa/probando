@extends('layout.main')

@section('title', 'Voluntarios')

@section('content')

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Administración de Voluntarios</h6>
              </div>
            </div>
            <div class="card-body p-4">
              <div class="w-100 p-2 mb-4">
                <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i> Agregar Voluntario</button>
                <table id="datatableVoluntaries" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                  <thead class="bg-gradient-dark text-center">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Delegación</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Tipo</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Email</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Telefono</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Estado</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Acciones</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@include('module.voluntario.create')

@include('module.voluntario.edit')

@include('module.voluntario.show')

@include('module.voluntario.call')

@include('module.voluntario.remark')

@endsection

@push('script')
<script>
    var datatableVoluntaries;

    $(document).ready(function(){
      datatableVoluntaries = $('#datatableVoluntaries').DataTable({
        ajax: {
          url: '{{ route("voluntarios.data") }}',
          dataSrc: ''
        },
        columns: [
          { 
            data: null,
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data.name+' '+data.lastname+'</p>'
            }
          },
          { data: 'delegation.name',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'type',
            render: function(data){
              return data === 'V'
                ? '<span class="badge bg-success">Voluntario</span>'
                : '<span class="badge bg-danger">Aspirante</span>';
            }
           },
          { data: 'email',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'phone',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'status',
            render: function(data){
              return data == '1'
                ? '<span class="badge bg-success">Activo</span>'
                : '<span class="badge bg-danger">Inactivo</span>';
            }
          },
          {
                  data: null,
                  orderable: false,
                  searchable: false,
                  render: function(data, type, row) {
                    return `
                      <a href="javascript:;" class="btn btn-info text-white" onclick="showVoluntary(${data.id})" data-bs-toggle="modal" data-bs-target="#ShowModal">
                        <i class="fa-regular fa-user"></i>
                      </a>
                      <a href="javascript:;" class="btn btn-secondary text-white" onclick="showEmergency(${data.id})" data-bs-toggle="modal" data-bs-target="#EmergencyModal">
                        <i class="fa-solid fa-phone"></i>
                      </a>
                      <a href="javascript:;" class="btn btn-warning text-white" onclick="editVoluntary(${data.id})" data-bs-toggle="modal" data-bs-target="#EditModal">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                      <a onclick="deleteVoluntary(${data.id})" class="btn btn-danger text-white">
                        <i class="fa-solid fa-trash"></i>
                      </a>
                      <a href="javascript:;" class="btn btn-secondary text-white" onclick="showRemark(${data.id})" data-bs-toggle="modal" data-bs-target="#RemarkModal">
                        <i class="fa-solid fa-circle-exclamation"></i>
                      </a>
                      `;
                  }
                }
        ],
        buttons: [
                {
                  extend: 'excelHtml5',
                  text: '<i class="fa-solid fa-file-excel"></i>',
                  className: 'btn btn-success me-2'
                },
                {
                  extend: 'print',
                  text: '<i class="fa-solid fa-print"></i>',
                  className: 'btn btn-primary me-2'
                },
                {
                  extend: 'csvHtml5',
                  text: '<i class="fa-solid fa-file-csv"></i>',
                  className: 'btn btn-info me-2'
                }
              ],
        language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
        },
        dom:
                "<'row mb-2'<'col-md-6 d-flex align-items-center'B><'col-md-6'f>>" +
                "<'row'<'col-12'tr>>" +
                "<'row mt-2'<'col-md-6'i><'col-md-6'p>>",
        responsive:{
          details:{
            type: 'inline'
          }
        }
      });
    });
    
    function showVoluntary(id){
      try{
        $.ajax({
          url: 'voluntarios/show/' + id,
          type: 'GET',
          success: function(response){
            console.log(response);
            $('#ShowModal').modal('show');
            $('#fullname_title_show').text(response.name + ' ' + response.lastname);
            $('#fullname_show').text(response.name + ' ' + response.lastname);
            $('#document_show').text(response.document);
            $('#email_show').text(response.email);
            $('#phone_show').text(response.phone);
            $('#birthday_show').text(response.birthday);
            $('#gender_show').text(response.gender == 'M' ? 'Masculino' : 'Femenino');
            $('#allergic_show').text(response.allergic == 1 ? 'Si' : 'No');
            $('#disease_show').text(response.disease == 1 ? 'Si' : 'No');
            $('#medicine_show').text(response.medicine == 1 ? 'Si' : 'No');
            $('#vehicle_show').text(response.vehicle == 1 ? 'Si' : 'No');
            $('#license_show').text(response.license == 1 ? 'Si' : 'No');
            $('#type_show').text(response.type == 'V' ? 'Voluntario' : 'Aspirante');
            $('#status_show').text(response.status == 'A' ? 'Activo' : 'Inactivo');
            $('#delegation_show').text(response.delegation.name);
          },
          error: function(error){
            Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al mostrar voluntario' + JSON.stringify(error),
          });
          }
        });
      }catch(e){
        console.log(e);  
      }
    }

    $('#formVoluntario').submit(function(e){
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
        url: '{{ route("voluntarios.store") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Voluntario registrado correctamente',
          });
          $('#exampleModal').modal('hide');
          datatableVoluntaries.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al registrar voluntario',
          });
          $('#exampleModal').modal('hide');
        }
      })
    })

    $('#formVoluntaryEdit').submit(function(e){
      e.preventDefault();
      let id = $('#id').val();

      $.ajax({
        url: 'voluntarios/update/'+id,
        type: 'PUT',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: $(this).serialize(),
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Voluntario actualizado correctamente',
          });
          $('#EditModal').modal('hide');
          datatableVoluntaries.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al actualizar voluntario' + JSON.stringify(error),
          });
          $('#EditModal').modal('hide');
        }
      })
    })

    function editVoluntary(id){
      $.ajax({
        url: 'voluntarios/edit/'+id,
        type: 'GET',
        success:function(response){
          console.log(response);
          $('#EditModal').modal('show');
          $('#formVoluntaryEdit').attr('action', 'voluntarios/update/'+id);
          $('#vehicle_edit').val(response.vehicle);
          $('#license_edit').val(response.license);
          $('#type_edit').val(response.type);
          $('#status_edit').val(response.status);
          $('#name_edit').text(response.name);
          $('#id').val(response.id);

        },
        error:function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al editar voluntario',
          });
          $('#EditModal').modal('hide');
        }
      });
    }

    function deleteVoluntary(id){
      Swal.fire({
              title: "¿Estas seguro de eliminar al voluntario?",
              text: "No podrás revertir esto!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Si, eliminarlo!"
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  url: 'voluntarios/destroy/'+id,
                  type: 'DELETE',
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(response){
                        Swal.fire({
                            icon: 'success',
                            title: 'Exito.',
                            text: 'Voluntario eliminado correctamente',
                        });
                        datatableVoluntaries.ajax.reload();
                    },
                    error: function(error){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error.',
                            text: 'Error al eliminar voluntario: ' + JSON.stringify(error),
                        });
                    }
                });
              }
            });
    }
</script>

@endpush