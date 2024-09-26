@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
<div class="container">
  <h1>Mantenedor de Usuarios</h1>

  <div class="d-flex justify-content-between mb-3">
    <div>
      <label for="entries">Show</label>
      <select id="entries" class="form-select d-inline-block w-auto">
        <option>10</option>
        <option>25</option>
        <option>50</option>
        <option>100</option>
      </select>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
      + Nuevo Usuario
    </button>
  </div>

  <table class="table table-striped">
    <thead>
      <tr>
        <!-- <th>ID</th> -->
        <th>Nombre</th>
        <th>Apellido</th>
        <th>RUT</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <!-- <td>{{ $user->user }}</td> -->
        <td>{{ $user->name }}</td>
        <td>{{ $user->lastname }}</td>
        <td>{{ $user->rut }}</td>
        <td>{{ $user->email }}</td>
        <!-- <td>
          <span class="badge bg-{{ $user->activo ? 'success' : 'danger' }}">
            {{ $user->activo ? 'Activo' : 'Inactivo' }}
          </span>
        </td> -->
        <td>
          <!-- Ver Usuario -->
          <button class="btn btn-sm btn-info view-project" data-id="{{ $user->id }}" title="Ver" data-bs-toggle="modal" data-bs-target="#viewModal">
            <i class="bi bi-eye" aria-hidden="true"></i>
          </button>

          <!-- Editar Usuario -->
          <button class="btn btn-sm btn-warning edit-project" data-id="{{ $user->id }}" title="Editar" data-bs-toggle="modal" data-bs-target="#editModal">
            <i class="bi bi-pencil" aria-hidden="true"></i>
          </button>

          <!-- Cambiar Estado -->
          <!-- <button class="btn btn-sm toggle-status {{ $user->activo ? 'btn-danger' : 'btn-success' }}" data-id="{{ $user->id }}" title="Cambiar estado">

            <i class="bi bi-arrow-repeat" aria-hidden="true"></i>
          </button> -->

          <!-- Eliminar Usuario -->
          <button class="btn btn-sm btn-danger delete-project" data-id="{{ $user->id }}" title="Eliminar" data-bs-toggle="modal" data-bs-target="#deleteModal">
            <i class="bi bi-trash" aria-hidden="true"></i>
          </button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Modal para crear proyecto -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Crear Nuevo Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <x-guest-layout>
        <div class="container-xxl">
          <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6">
              <!-- Register Card -->
              <!-- <div class="card"> -->
              <!-- <div class="card-body"> -->
              <!-- Logo -->
              <div class="app-brand justify-content-center mb-6">
                <a href="{{ url('/') }}" class="app-brand-link">
                  <span class="app-brand-logo demo">
                    <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                        fill="#7367F0" />
                      <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                        fill="#161616" />
                      <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                        fill="#161616" />
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                        fill="#7367F0" />
                    </svg>
                  </span>
                  <span class="app-brand-text demo text-heading fw-bold">Vuexy</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-1">Adventure starts here 🚀</h4>
              <p class="mb-6">Make your app management easy and fun!</p>

              <!-- Formulario de registro -->
              <form method="POST" action="{{ route('register') }}" id="formAuthentication">
                @csrf

                <!-- Name -->
                <div class="mb-6">
                  <label for="name" class="form-label">{{ __('Name') }}</label>
                  <input type="text" id="name" class="form-control" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your name">
                  <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Lastname -->
                <div class="mb-6">
                  <label for="lastname" class="form-label">{{ __('Last Name') }}</label>
                  <input type="text" id="lastname" class="form-control" name="lastname" :value="old('lastname')" required autocomplete="lastname" placeholder="Enter your last name">
                  <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                </div>

                <!-- RUT -->
                <div class="mb-6">
                  <label for="rut" class="form-label">{{ __('RUT') }}</label>
                  <input type="text" id="rut" class="form-control" name="rut" :value="old('rut')" required autocomplete="rut" placeholder="Enter your RUT">
                  <x-input-error :messages="$errors->get('rut')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mb-6">
                  <label for="email" class="form-label">{{ __('Email') }}</label>
                  <input type="email" id="email" class="form-control" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter your email">
                  <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-6 form-password-toggle">
                  <label for="password" class="form-label">{{ __('Password') }}</label>
                  <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password" required autocomplete="new-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                  <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6 form-password-toggle">
                  <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                  <div class="input-group input-group-merge">
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                  <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Términos y condiciones -->
                <div class="my-8">
                  <div class="form-check mb-0 ms-2">
                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                    <label class="form-check-label" for="terms-conditions">
                      I agree to <a href="javascript:void(0);">privacy policy & terms</a>
                    </label>
                  </div>
                </div>

                <!-- Botón de registro -->
                <button class="btn btn-primary d-grid w-100">{{ __('Register') }}</button>
              </form>

              <!-- Enlace a login -->
              <p class="text-center mt-4">
                <span>{{ __('Already registered?') }}</span>
                <a href="{{ route('login') }}">
                  <span>{{ __('Sign in instead') }}</span>
                </a>
              </p>
              <!-- </div> -->
              <!-- </div> -->
              <!-- /Register Card -->
            </div>
          </div>
        </div>
      </x-guest-layout>
    </div>
  </div>
</div>






<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Proyecto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editForm" method="POST" action="" enctype="multipart/form-data">
          @csrf
          @method('PUT') <!-- Para indicarle a Laravel que es una actualización -->
          <div class="mb-3">
            <label for="edit_name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="edit_name" name="nombre" required>
          </div>
          <div class="mb-3">
            <label for="edit_description" class="form-label">Descripción</label>
            <textarea class="form-control" id="edit_description" name="descripcion" required></textarea>
          </div>
          <div class="mb-3">
            <label for="edit_image" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="edit_image" name="imagen">
            <img id="edit_image_preview" src="" alt="Imagen del proyecto" style="width: 100px; height: auto;">
          </div>
          <div class="mb-3">
            <label for="edit_active" class="form-label">Estado</label>
            <select id="edit_active" name="activo" class="form-select">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal para ver proyecto -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel">Información del usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card-body pt-12">
          <div class="user-avatar-section">
            <div class="d-flex align-items-center flex-column">
              <img
                class="img-fluid rounded mb-4"
                src="{{ asset('assets/img/avatars/1.png') }}"
                height="120"
                width="120"
                alt="User avatar" />
              <div class="user-info text-center">
                <h5>{{ $user->name . ' ' . $user->lastname }}</h5>
                <span class="badge bg-label-secondary">User</span>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">
            <div class="d-flex align-items-center me-5 gap-4">
              <div class="avatar">
                <div class="avatar-initial bg-label-primary rounded">
                  <i class="ti ti-checkbox ti-lg"></i>
                </div>
              </div>
            </div>
          </div>
          <h5 class="pb-4 border-bottom mb-4">Detalles</h5>
          <div class="info-container">
            <ul class="list-unstyled mb-6">
              <li class="mb-2">
                <span class="h6">Nombre:</span>
                <span>{{$user->name}}</span>
              </li>
              <li class="mb-2">
                <span class="h6">Apellido:</span>
                <span>{{$user->lastname}}</span>
              </li>
              <li class="mb-2">
                <span class="h6">RUT:</span>
                <span>{{$user->rut}}</span>
              </li>
              <li class="mb-2">
                <span class="h6">Email:</span>
                <span>{{$user->email}}</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>



  <!-- Modal para eliminar proyecto -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Eliminar Proyecto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>¿Estás seguro de que deseas eliminar este proyecto?</p>
          <p class="text-danger">Esta acción no se puede deshacer.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" id="confirmDelete" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Toast Notification -->
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          Acción realizada correctamente.
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>


  @endsection

  @push('scripts')

  <script>
    $(document).ready(function() {

      // Toast Notification
      function showToast(message, isSuccess = true) {
        var toastElement = document.getElementById('toast');
        var toastBody = toastElement.querySelector('.toast-body');
        var toast = new bootstrap.Toast(toastElement);

        // Cambiar el color del Toast según el éxito o fallo
        if (isSuccess) {
          toastElement.classList.remove('bg-danger');
          toastElement.classList.add('bg-success');
        } else {
          toastElement.classList.remove('bg-success');
          toastElement.classList.add('bg-danger');
        }

        // Establecer el mensaje
        toastBody.textContent = message;

        // Mostrar el Toast
        toast.show();
      }


      // Create Project
      $('#submitCreate').click(function() {
        $('#createForm').submit(function(e) {
          e.preventDefault(); // Evitar la recarga de la página

          $.post($(this).attr('action'), $(this).serialize(), function(data) {
            $('#createModal').modal('hide'); // Cerrar el modal
            showToast('Proyecto creado exitosamente.', true); // Mostrar Toast de éxito
          }).fail(function() {
            showToast('Error al crear el proyecto.', false); // Mostrar Toast de error
          });
        });
      });

      // Editar Proyecto
      $('.edit-project').click(function() {
        var projectId = $(this).data('id');
        $.get('/proyects/' + projectId + '/edit', function(data) {
          $('#editForm').attr('action', '/proyects/' + projectId); // Cambia la acción del formulario
          $('#edit_name').val(data.nombre); // Rellena el campo nombre
          $('#edit_description').val(data.descripcion); // Rellena el campo descripción
          $('#edit_image_preview').attr('src', '/storage/' + data.imagen); // Muestra la imagen actual
          $('#edit_active').val(data.activo); // Cambia el estado
          $('#editModal').modal('show'); // Muestra el modal de edición
        }).fail(function() {
          showToast('Error al cargar el proyecto para editar.', false);
        });
      });

      $('#submitEdit').click(function() {
        $('#editForm').submit(function(e) {
          e.preventDefault();
          $.ajax({
            url: $('#editForm').attr('action'),
            type: 'POST',
            data: $('#editForm').serialize(),
            success: function(data) {
              $('#editModal').modal('hide'); // Cerrar el modal
              showToast('Proyecto actualizado exitosamente.', true); // Mostrar Toast de éxito
            },
            error: function() {
              showToast('Error al actualizar el proyecto.', false); // Mostrar Toast de error
            }
          });
        });
      });

      // Ver Proyecto desde la tabla
      $('.view-project').click(function() {
        var projectId = $(this).data('id'); // Capturamos el ID del proyecto desde el botón

        // Hacemos una solicitud AJAX para obtener los datos del proyecto
        $.get('/proyects/' + projectId, function(data) {
          // Colocamos los datos en los campos del modal
          $('#view_id').text(data.id);
          $('#view_name').text(data.nombre);
          $('#view_description').text(data.descripcion);

          // Verificamos si hay una imagen y la mostramos
          if (data.imagen) {
            $('#view_image').attr('src', '/storage/' + data.imagen).show(); // Muestra la imagen actual
          } else {
            $('#view_image').hide(); // Si no hay imagen, ocultamos el campo
          }

          $('#view_user_create').text(data.user_id_create);
          $('#view_user_update').text(data.user_id_last_update);
          $('#view_active').text(data.activo ? 'Activo' : 'Inactivo');

          // Mostramos el modal
          $('#viewModal').modal('show');
          showToast('Proyecto cargado correctamente.', true);
        }).fail(function() {
          showToast('Error al cargar el proyecto.', false);
        });
      });

      // Cambiar el estado del proyecto (activo/inactivo)
      $('.toggle-status').click(function() {
        var projectId = $(this).data('id');
        $.post('/proyects/' + projectId + '/toggle-status', {
          _token: '{{ csrf_token() }}'
        }, function(data) {
          if (data.success) {
            location.reload(); // Recargar la página para actualizar el estado
            showToast('Estado del proyecto actualizado correctamente.', true); // Mostrar Toast de éxito
          }
        }).fail(function() {
          showToast('Error al cambiar el estado del proyecto.', false);
        });
      });

      // Delete Project
      var deleteId;
      $('.delete-project').click(function() {
        deleteId = $(this).data('id');
        $('#deleteModal').modal('show');
      });

      $('#confirmDelete').click(function() {
        $.ajax({
          url: '/proyects/' + deleteId,
          type: 'DELETE',
          data: {
            _token: '{{ csrf_token() }}'
          },
          success: function(result) {
            location.reload(); // Recargar la página después de eliminar
            showToast('Proyecto eliminado exitosamente.', true); // Mostrar Toast de éxito
          },
          error: function() {
            showToast('Error al eliminar el proyecto.', false); // Mostrar Toast de error
          }
        });
      });
    });
  </script>
  @endpush