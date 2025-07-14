@extends('layout.main')

@section('title', 'Usuarios')

@section('content')

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Administración de Usuarios</h6>
              </div>
              <div class="p-2 d-flex justify-align-content-start">
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i> Agregar Usuario</button>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-2">
                <table class="table align-items-center mb-0 datatable table-striped table-bordered border-radius-lg">
                  <thead class="table-dark">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Rol</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Estado</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Ingresado</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$user->name}}</h6>
                            <p class="text-xs text-secondary mb-0">{{$user->email}}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{$user->role}}</p>
                        <p class="text-xs text-secondary mb-0">Voluntario CSA</p>
                      </td>
                      @if($user->status == 'A')
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Activo</span>
                      </td>
                      @else
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-danger">Inactivo</span>
                      </td>
                      @endif
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{$user->created_at}}</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs btn btn-warning text-white" data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs btn btn-danger text-white" data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Usuario</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
      </div>
      <div class="modal-body">
        <form class="form" method="POST" action="{{route('usuarios.store')}}">
          @csrf
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre</label>
            <input type="text" class="form-control border border-gray p-2" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control border border-gray p-2" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control border border-gray p-2" id="exampleInputPassword1" name="password" autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirmar Password</label>
            <input type="password" class="form-control border border-gray p-2" id="exampleInputPassword1" name="password_confirmation" autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Rol</label>
            <select class="form-select border border-gray p-2" aria-label="Default select example" name="role">
              <option selected>Seleccione el Rol</option>
              <option value="admin">Admin</option>
              <option value="leader">Lider</option>
              <option value="comun">Común</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Estado</label>
            <select class="form-select border border-gray p-2" aria-label="Default select example" name="status">
              <option selected>Seleccione el Estado</option>
              <option value="A">Activo</option>
              <option value="I">Inactivo</option>
            </select>
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
@endsection
