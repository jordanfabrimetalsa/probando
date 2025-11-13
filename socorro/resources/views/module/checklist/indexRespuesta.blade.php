@extends('layout.main')

@section('title', 'Checklist')

@section('content')

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-user-tie"></i> CheckList Guardia</h6>
              </div>
            </div>
            <div class="card-body p-3">
              <div class="card text-center mb-2"  style="box-shadow: none !important">
                <div class="card-header">
                  Intrucciones
                </div>
                <div class="card-body">
                  <h5 class="card-title">Favor de leer las instrucciones para evitar futuros problemas.</h5>
                  <p class="card-text">Todos los campos deben ser respondido por obligación, de no ser, este no sera enviado.</p>
                  <p class="text-danger">Recuerde que modifican los datos del vehiculo, por favor verifique los datos antes de enviar.</p>
                </div>
                <div class="card-footer text-muted">
                  Administración de CSA Nacional
                </div>
              </div>
              <form id="formChecklist">
                <div id="accordionExample">
                  <div class="card" style="box-shadow: none !important">
                    <div class="card-header">
                      <h6>Información General</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                          <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="form-group">
                              <label for="">Vehiculo</label>
                              <select name="car" id="car" class="form-control" required>
                                <option value="">Seleccione</option>
                                @foreach ($vehicles as $vehicle)
                                  <option value="{{ $vehicle->id }}" data-kilometer="{{ $vehicle->kilometer }}">{{ $vehicle->brand->name }} {{ $vehicle->model->name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="form-group">
                              <label for="">Kilometraje</label>
                              <input type="number" class="form-control" id="kilometer" name="kilometer" autocomplete="off" required>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="form-group">
                              <label for="">Combustible</label>
                              <select class="form-control" id="fuel" name="fuel" onchange="calculateFuel()">
                                <option selected disabled>Seleccione</option>
                                <option value="1">1/5</option>
                                <option value="2">2/5</option>
                                <option value="3">3/5</option>
                                <option value="4">4/5 (Minimo Operativo)</option>
                                <option value="5">5/5</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xl-3 col-md-4 col-sm-12">
                            <div class="form-group">
                              <label for="">Liquido Refigerante</label>
                              <select class="form-control" id="liquid_freeze" name="liquid_freeze">
                                <option selected disabled>Seleccione</option>
                                <option value="0">Bajo</option>
                                <option value="1">Medio (Minimo Operativo)</option>
                                <option value="2">Alto</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-xl-3 col-md-4 col-sm-12">
                            <div class="form-group">
                              <label for="">Liquido Hidraulico</label>
                              <select class="form-control" id="liquid_hydraulic" name="liquid_hydraulic">
                                <option selected disabled>Seleccione</option>
                                <option value="0">Bajo</option>
                                <option value="1">Medio (Minimo Operativo)</option>
                                <option value="2">Alto</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-xl-3 col-md-4 col-sm-12">
                            <div class="form-group">
                              <label for="">Aceite de Motor</label>
                              <select class="form-control" id="liquid_motor" name="liquid_motor">
                                <option selected disabled>Seleccione</option>
                                <option value="0">Bajo</option>
                                <option value="1">Medio (Minimo Operativo)</option>
                                <option value="2">Alto</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-xl-3 col-md-4 col-sm-12">
                            <div class="form-group">
                              <label for="">Liquido de Freno</label>
                              <select class="form-control" id="liquid_brake" name="liquid_brake">
                                <option selected disabled>Seleccione</option>
                                <option value="0">Bajo</option>
                                <option value="1">Medio (Minimo Operativo)</option>
                                <option value="2">Alto</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <br>
                        <hr>
                        <div class="row p-2">
                          @foreach ($question->groupBy('category') as $key => $category)
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="heading{{ $loop->index }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="false" aria-controls="collapse{{ $loop->index }}">
                                  {{ $key }}
                                </button>
                              </h2>
                              <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <table class="table table-striped dt-responsive nowrap" style="width: 100%;">
                                    <thead style="color: white" class="bg-gradient-dark text-center">
                                      <tr class="text-center">
                                        <th scope="col" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-white">Pregunta</th>
                                        <th scope="col" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-white">Cantidad</th>
                                        <th scope="col" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-white">Respuesta</th>
                                        <th scope="col" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-white">Observacion</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($category as $item)
                                        <tr>
                                          <td class="text-center">{{ $item->name }}</td>
                                          <td class="text-center">{{ $item->quantity }}</td>
                                          <td class="text-center">
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" value="Si" id="respuesta_{{ $item->id }}_si" name="respuesta[{{ $item->id }}]">
                                              <label class="form-check-label" for="respuesta_{{ $item->id }}_si">Si</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" value="No" id="respuesta_{{ $item->id }}_no" name="respuesta[{{ $item->id }}]">
                                              <label class="form-check-label" for="respuesta_{{ $item->id }}_no">No</label>
                                            </div>
                                          </td>
                                          <td class="text-center"><input type="text" class="form-control" id="observacion_{{ $item->id }}" name="observacion[{{ $item->id }}]" placeholder="Observacion"></td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div> 
                        <hr>
                        <br>
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                              <label for="">Observaciones</label>
                              <textarea class="form-control" name="observations" id="observations" cols="30" rows="5"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <br>
                </div>
                <div id="accordionExample" class="mt-2">
                  <div class="card" style="box-shadow: none !important">
                    <div class="card-header">
                      <h6>Responsable del Check</h6>
                    </div>
                    <div class="card-body">
                      <div class="row mb-2">
                        <div class="col-xl-6 col-md-6 col-sm-12">
                          <div class="form-group">
                            <label for="">Lider de Patrulla</label>
                            <select class="form-control" id="leader" name="leader">
                              <option selected disabled>Seleccione Lider de Patrulla</option>
                              @foreach ($voluntaries as $voluntary)
                                <option value="{{ $voluntary->id }}">{{ $voluntary->name }} {{ $voluntary->lastname }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12">
                          <div class="form-group">
                            <label for="">Correo Electronico</label>
                            <input type="email" class="form-control" id="email" name="email">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-dark text-white d-block mx-auto"><i class="fa-solid fa-save"></i> Guardar Checklist</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@push('script')
  <script>
    $(document).ready(function(){

      $('#car').change(function(){
        var id = $(this).val();
        var kilometer = $('#car option:selected').data('kilometer');
        $('#kilometer').val(kilometer);
      })

      $('#formChecklist').submit(function(e){
        e.preventDefault();
        
        var formData = $(this).serialize();
        $.ajax({
          url: '/checklist/question/store',
          type: 'POST',
          data: formData,
          success: function(response){
            Swal.fire({
              icon: 'success',
              title: 'Checklist Guardado',
              text: 'El checklist se guardo correctamente' + response.message,
              showConfirmButton: true,
              confirmButtonText: 'Aceptar'
            })
          },
          error: function(response){
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Ocurrio un error al guardar el checklist' + response.message,
              showConfirmButton: true,
              confirmButtonText: 'Aceptar'
            })
          }
        })
      })
      
    })

    function calculateFuel() {
      var fuel = $('#fuel').val();

      if(fuel < 4){
        Swal.fire({
          icon: 'warning',
          title: 'Advertencia',
          text: 'El combustible debe ser de 4/5 para ser operativo, recarge combustible y envio Factura/Boleta a Tesoreria via correo electronico.',
          showConfirmButton: true,
          confirmButtonText: 'Aceptar'
        })
      }
    }

  </script>
@endpush