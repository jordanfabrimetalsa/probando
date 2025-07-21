<!-- Modal -->
<div class="modal fade" id="CreateCategoryModal" tabindex="-1" aria-labelledby="CreateCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CreateCategoryModalLabel">Agregar Categoria</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formCategory" class="form" method="POST">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="name" class="form-label">Nombre<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="name" name="name">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="description" class="form-label">Descripción<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="description" name="description">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success btn-sm">Guardar</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@push('scripts')
    <script>
        $('#formCategory').submit(function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: '{{ route("inventario.category") }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                Swal.fire({
                    icon: 'success',
                    title: 'Exito.',
                    text: 'Categoria registrado correctamente',
                });
                $('#CreateCategoryModal').modal('hide');
                },
                error: function(error){
                Swal.fire({
                    icon: 'error',
                    title: 'Error.',
                    text: 'Error al registrar categoria' + JSON.stringify(error),
                });
                $('#CreateCategoryModal').modal('hide');
                }
            })
        })
    </script>
@endpush
