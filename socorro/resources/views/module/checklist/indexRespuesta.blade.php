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

              <div class="card text-center mb-2">
                <div class="card-header">
                  Intrucciones
                </div>
                <div class="card-body">
                  <h5 class="card-title">Favor de leer las instrucciones para evitar futuros problemas.</h5>
                  <p class="card-text">Todos los campos deben ser respondido por obligación, de no ser, este no sera enviado.</p>
                </div>
                <div class="card-footer text-muted">
                  Administración de CSA Nacional
                </div>
              </div>

              <div id="accordionExample">
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
                              <th scope="col" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-white">N°</th>
                              <th scope="col" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-white">Pregunta</th>
                              <th scope="col" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-white">Cantidad</th>
                              <th scope="col" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-white">Respuesta</th>
                              <th scope="col" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-white">Observacion</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php $count = 1; @endphp
                            @foreach ($category as $item)
                              <tr>
                                <td class="text-center">{{ $count++ }}</td>
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
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="N/A" id="respuesta_{{ $item->id }}_na" name="respuesta[{{ $item->id }}]">
                                    <label class="form-check-label" for="respuesta_{{ $item->id }}_na">N/A</label>
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
              <br>
              <div class="col-12">
                <button type="submit" class="btn btn-dark text-white"><i class="fa-solid fa-save"></i> Guardar Checklist</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection