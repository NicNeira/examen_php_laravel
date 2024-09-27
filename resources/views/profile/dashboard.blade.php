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
          <button class="btn btn-sm btn-info view-user" data-id="{{ $user->id }}" title="Ver" data-bs-toggle="modal" data-bs-target="#viewModal">
            <i class="bi bi-eye" aria-hidden="true"></i>
          </button>

          <!-- Editar Usuario -->
          <button class="btn btn-sm btn-warning edit-user" data-id="{{ $user->id }}" title="Editar" data-bs-toggle="modal" data-bs-target="#editModal">
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

@if(session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

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
              <form method="POST" action="{{ route('user.store') }}" id="formAuthentication">
                @csrf
                <!-- Name -->
                <div class="mb-6">
                  <label for="name" class="form-label">{{ __('Name') }}</label>
                  <input type="text" id="create-name" class="form-control" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your name">
                  <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Lastname -->
                <div class="mb-6">
                  <label for="lastname" class="form-label">{{ __('Last Name') }}</label>
                  <input type="text" id="create-lastname" class="form-control" name="lastname" :value="old('lastname')" required autocomplete="lastname" placeholder="Enter your last name">
                  <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                </div>

                <!-- RUT -->
                <div class="mb-6">
                  <label for="rut" class="form-label">{{ __('RUT') }}</label>
                  <input type="text" id="create-rut" class="form-control" name="rut" :value="old('rut')" required autocomplete="rut" placeholder="Enter your RUT">
                  <x-input-error :messages="$errors->get('rut')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mb-6">
                  <label for="email" class="form-label">{{ __('Email') }}</label>
                  <input type="email" id="create-email" class="form-control" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter your email">
                  <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-6 form-password-toggle">
                  <label for="password" class="form-label">{{ __('Password') }}</label>
                  <div class="input-group input-group-merge">
                    <input type="password" id="create-password" class="form-control" name="password" required autocomplete="new-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                  <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6 form-password-toggle">
                  <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                  <div class="input-group input-group-merge">
                    <input type="password" id="create-password_confirmation" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
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
        <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Contenedor para el spinner -->
      <!-- <div id="loadingSpinner" class="d-flex justify-content-center align-items-center" style="min-height: 300px; display: none;">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Cargando...</span>
        </div>
      </div> -->

      <!-- Contenido del modal que estará oculto mientras se carga -->
      <div class="modal-body" id="edit-modalContent">
        <form id="editUserForm" action="{{ route('user.update', $user->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="edit-name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="lastname" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="edit-lastname" name="lastname" required>
          </div>
          <div class="mb-3">
            <label for="rut" class="form-label">RUT</label>
            <input type="text" class="form-control" id="edit-rut" name="rut" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="edit-email" name="email" required required autocomplete="username">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña (dejar en blanco para no cambiar)</label>
            <input type="password" class="form-control" id="edit-password" name="password" autocomplete="new-password">
          </div>
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="edit-password_confirmation" name="password_confirmation" autocomplete="new-password">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal para ver usuario -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel">Información del usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="view-modalContent">
        <div class="card-body pt-12">
          <div class="user-avatar-section">
            <div class="d-flex align-items-center flex-column">
              <img
                id="user-avatar"
                class="img-fluid rounded mb-4"
                src="{{ asset('assets/img/avatars/1.png') }}"
                height="120"
                width="120"
                alt="User avatar" />
              <div class="user-info text-center">
                <h5 id="user-fullname">Nombre Completo</h5>
                <span class="badge bg-label-secondary">User</span>
              </div>
            </div>
          </div>
          <h5 class="pb-4 border-bottom mb-4">Detalles</h5>
          <div class="info-container">
            <ul class="list-unstyled mb-6">
              <li class="mb-2">
                <span class="h6">Nombre:</span>
                <span id="user-name"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Apellido:</span>
                <span id="user-lastname"></span>
              </li>
              <li class="mb-2">
                <span class="h6">RUT:</span>
                <span id="user-rut"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Email:</span>
                <span id="user-email"></span>
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
</div>




<!-- Modal para eliminar usuario -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Eliminar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Estás seguro de que deseas eliminar este Usuario?</p>
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

@section('page-script')
<script>
  $(document).ready(function() {

    $(document).ready(function() {
      console.log("jQuery is loaded and working");
    });

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

    // Editar user
    $(document).on('click', '.edit-user', function() {
      var userId = $(this).data('id');
      console.log('User ID:', userId);

      // Mostrar el spinner y ocultar el contenido del modal
      // $('#loadingSpinner').show();
      $('#edit-modalContent').hide();

      // Llamada AJAX para obtener los datos del usuario
      $.ajax({
        url: '/users/' + userId + '/edit',
        method: 'GET',
        success: function(data) {
          console.log('Received data:', data);

          // Llenar los campos del formulario con los datos recibidos
          $('#edit-name').val(data.name); // ID actualizado
          $('#edit-lastname').val(data.lastname); // ID actualizado
          $('#edit-rut').val(data.rut); // ID actualizado
          $('#edit-email').val(data.email); // ID actualizado

          // Actualizar la acción del formulario
          $('#editUserForm').attr('action', '/users/' + userId);

          // Ocultar el spinner
          // $('#loadingSpinner').css('display', 'none');

          $('#edit-modalContent').fadeIn('slow');

          // console.log('Spinner current display:', $('#loadingSpinner').css('display'));

        },
        error: function(xhr) {
          console.log('Error:', xhr.responseText);

          // Ocultar el spinner en caso de error
          // $('#loadingSpinner').hide();
        }
      });
    });


    // Ver usuario desde la tabla
    $(document).on('click', '.view-user', function() {
      var userId = $(this).data('id');
      console.log('User ID:', userId);

      $('#view-modalContent').hide();

      // Llamada AJAX para obtener los datos del usuario
      $.ajax({
        url: '/users/' + userId,
        method: 'GET',
        success: function(data) {
          console.log('Received data:', data);
          // Rellenar el modal con los datos del usuario seleccionado
          $('#user-fullname').text(data.name + ' ' + data.lastname);
          $('#user-name').text(data.name);
          $('#user-lastname').text(data.lastname);
          $('#user-rut').text(data.rut);
          $('#user-email').text(data.email);

          // Mostrar el modal
          $('#view-modalContent').fadeIn('slow');
        },
        error: function(xhr) {
          console.log('Error:', xhr.responseText);
        }
      });
    });


    // Cambiar el estado del proyecto (activo/inactivo)
    // $('.toggle-status').click(function() {
    //   var projectId = $(this).data('id');
    //   $.post('/proyects/' + projectId + '/toggle-status', {
    //     _token: '{{ csrf_token() }}'
    //   }, function(data) {
    //     if (data.success) {
    //       location.reload(); // Recargar la página para actualizar el estado
    //       showToast('Estado del proyecto actualizado correctamente.', true); // Mostrar Toast de éxito
    //     }
    //   }).fail(function() {
    //     showToast('Error al cambiar el estado del proyecto.', false);
    //   });
    // });

    // Delete Project
    var deleteId;
    $('.delete-project').click(function() {
      deleteId = $(this).data('id');
      $('#deleteModal').modal('show');
    });

    $('#confirmDelete').click(function() {
      $.ajax({
        url: '/users/' + deleteId,
        type: 'DELETE',
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function(result) {
          location.reload(); // Recargar la página después de eliminar
          showToast('Usuario eliminado exitosamente.', true); // Mostrar Toast de éxito
        },
        error: function() {
          showToast('Error al eliminar el proyecto.', false); // Mostrar Toast de error
        }
      });
    });
  });
</script>
@endsection