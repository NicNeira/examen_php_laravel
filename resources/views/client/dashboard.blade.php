@extends('layouts.app')

@section('title', 'Clients Dashboard')

@section('content')
<div class="container">
  <h1>Mantenedor de Clientes</h1>

  <div class="d-flex justify-content-between mb-3">
    <div>
      <label for="entries">Mostrar</label>
      <select id="entries" class="form-select d-inline-block w-auto">
        <option>10</option>
        <option>25</option>
        <option>50</option>
        <option>100</option>
      </select>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
      + Nuevo Cliente
    </button>
  </div>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>RUT Empresa</th>
        <th>Rubro</th>
        <th>Razón Social</th>
        <th>Teléfono</th>
        <th>Dirección</th>
        <th>Nombre de Contacto</th>
        <th>Email de Contacto</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($clients as $client)
      <tr>
        <td>{{ $client->rut_empresa }}</td>
        <td>{{ $client->rubro }}</td>
        <td>{{ $client->razon_social }}</td>
        <td>{{ $client->telefono }}</td>
        <td>{{ $client->direccion }}</td>
        <td>{{ $client->nombre_contacto }}</td>
        <td>{{ $client->email_contacto }}</td>
        <td>
          <!-- Ver cliente -->
          <button class="btn btn-sm btn-info view-client" data-id="{{ $client->id }}" title="Ver" data-bs-toggle="modal" data-bs-target="#viewModal">
            <i class="bi bi-eye" aria-hidden="true"></i>
          </button>

          <!-- Editar cliente -->
          <button class="btn btn-sm btn-warning edit-client" data-id="{{ $client->id }}" title="Editar" data-bs-toggle="modal" data-bs-target="#editModal">
            <i class="bi bi-pencil" aria-hidden="true"></i>
          </button>

          <!-- Eliminar cliente -->
          <button class="btn btn-sm btn-danger delete-client" data-id="{{ $client->id }}" title="Eliminar" data-bs-toggle="modal" data-bs-target="#deleteModal">
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

<!-- Modal para crear cliente -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Crear Nuevo Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Formulario de cliente -->
        <form method="POST" action="{{ route('client.store') }}" id="createClientForm">
          @csrf

          <!-- RUT Empresa -->
          <div class="mb-3">
            <label for="rut_empresa" class="form-label">RUT Empresa</label>
            <input type="text" id="create-rut_empresa" class="form-control" name="rut_empresa" required placeholder="Ingresa el RUT de la empresa">
            <x-input-error :messages="$errors->get('rut_empresa')" class="mt-2" />
          </div>

          <!-- Rubro -->
          <div class="mb-3">
            <label for="rubro" class="form-label">Rubro</label>
            <input type="text" id="create-rubro" class="form-control" name="rubro" required placeholder="Ingresa el rubro">
            <x-input-error :messages="$errors->get('rubro')" class="mt-2" />
          </div>

          <!-- Razón Social -->
          <div class="mb-3">
            <label for="razon_social" class="form-label">Razón Social</label>
            <input type="text" id="create-razon_social" class="form-control" name="razon_social" required placeholder="Ingresa la razón social">
            <x-input-error :messages="$errors->get('razon_social')" class="mt-2" />
          </div>

          <!-- Teléfono -->
          <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" id="create-telefono" class="form-control" name="telefono" required placeholder="Ingresa el teléfono">
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
          </div>

          <!-- Dirección -->
          <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" id="create-direccion" class="form-control" name="direccion" required placeholder="Ingresa la dirección">
            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
          </div>

          <!-- Nombre de Contacto -->
          <div class="mb-3">
            <label for="nombre_contacto" class="form-label">Nombre de Contacto</label>
            <input type="text" id="create-nombre_contacto" class="form-control" name="nombre_contacto" required placeholder="Ingresa el nombre del contacto">
            <x-input-error :messages="$errors->get('nombre_contacto')" class="mt-2" />
          </div>

          <!-- Email de Contacto -->
          <div class="mb-3">
            <label for="email_contacto" class="form-label">Email de Contacto</label>
            <input type="email" id="create-email_contacto" class="form-control" name="email_contacto" required placeholder="Ingresa el email del contacto">
            <x-input-error :messages="$errors->get('email_contacto')" class="mt-2" />
          </div>

          <!-- Botón de crear cliente -->
          <button type="submit" class="btn btn-primary d-grid w-100">{{ __('Crear Cliente') }}</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal cliente -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Contenido del modal que estará oculto mientras se carga -->
      <div class="modal-body" id="edit-modalContent">
        <form id="editClientForm" action="" method="POST">
          @csrf
          @method('PUT')

          <!-- RUT Empresa -->
          <div class="mb-3">
            <label for="rut_empresa" class="form-label">RUT Empresa</label>
            <input type="text" class="form-control" id="edit-rut_empresa" name="rut_empresa" required>
          </div>

          <!-- Rubro -->
          <div class="mb-3">
            <label for="rubro" class="form-label">Rubro</label>
            <input type="text" class="form-control" id="edit-rubro" name="rubro" required>
          </div>

          <!-- Razón Social -->
          <div class="mb-3">
            <label for="razon_social" class="form-label">Razón Social</label>
            <input type="text" class="form-control" id="edit-razon_social" name="razon_social" required>
          </div>

          <!-- Teléfono -->
          <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="edit-telefono" name="telefono" required>
          </div>

          <!-- Dirección -->
          <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="edit-direccion" name="direccion" required>
          </div>

          <!-- Nombre de Contacto -->
          <div class="mb-3">
            <label for="nombre_contacto" class="form-label">Nombre de Contacto</label>
            <input type="text" class="form-control" id="edit-nombre_contacto" name="nombre_contacto" required>
          </div>

          <!-- Email de Contacto -->
          <div class="mb-3">
            <label for="email_contacto" class="form-label">Email de Contacto</label>
            <input type="email" class="form-control" id="edit-email_contacto" name="email_contacto" required>
          </div>

          <!-- Botón de guardar cambios -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para ver cliente -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel">Información del Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="view-modalContent">
        <div class="card-body pt-12">
          <h5 class="pb-4 border-bottom mb-4">Detalles del Cliente</h5>
          <div class="info-container">
            <ul class="list-unstyled mb-6">
              <li class="mb-2">
                <span class="h6">RUT Empresa:</span>
                <span id="client-rut_empresa"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Rubro:</span>
                <span id="client-rubro"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Razón Social:</span>
                <span id="client-razon_social"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Teléfono:</span>
                <span id="client-telefono"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Dirección:</span>
                <span id="client-direccion"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Nombre de Contacto:</span>
                <span id="client-nombre_contacto"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Email de Contacto:</span>
                <span id="client-email_contacto"></span>
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

<!-- Modal para eliminar cliente -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Eliminar Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Estás seguro de que deseas eliminar este cliente?</p>
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

  // Editar cliente
  $(document).on('click', '.edit-client', function() {
    var clientId = $(this).data('id');
    console.log('Client ID:', clientId);

    // Ocultar el contenido del modal mientras se cargan los datos
    $('#edit-modalContent').hide();

    // Llamada AJAX para obtener los datos del cliente
    $.ajax({
      url: '/clients/' + clientId + '/edit',
      method: 'GET',
      success: function(data) {
        console.log('Received data:', data);

        // Llenar los campos del formulario con los datos recibidos
        $('#edit-rut_empresa').val(data.rut_empresa);
        $('#edit-rubro').val(data.rubro);
        $('#edit-razon_social').val(data.razon_social);
        $('#edit-telefono').val(data.telefono);
        $('#edit-direccion').val(data.direccion);
        $('#edit-nombre_contacto').val(data.nombre_contacto);
        $('#edit-email_contacto').val(data.email_contacto);

        // Actualizar la acción del formulario
        $('#editClientForm').attr('action', '/clients/' + clientId);

        // Mostrar el contenido del modal
        $('#edit-modalContent').fadeIn('slow');
      },
      error: function(xhr) {
        console.log('Error:', xhr.responseText);
      }
    });
  });

  // Ver cliente desde la tabla
  $(document).on('click', '.view-client', function() {
    var clientId = $(this).data('id');
    console.log('Client ID:', clientId);

    $('#view-modalContent').hide();

    // Llamada AJAX para obtener los datos del cliente
    $.ajax({
      url: '/clients/' + clientId,
      method: 'GET',
      success: function(data) {
        console.log('Received data:', data);

        // Rellenar el modal con los datos del cliente seleccionado
        $('#client-rut_empresa').text(data.rut_empresa);
        $('#client-rubro').text(data.rubro);
        $('#client-razon_social').text(data.razon_social);
        $('#client-telefono').text(data.telefono);
        $('#client-direccion').text(data.direccion);
        $('#client-nombre_contacto').text(data.nombre_contacto);
        $('#client-email_contacto').text(data.email_contacto);

        // Mostrar el modal
        $('#view-modalContent').fadeIn('slow');
      },
      error: function(xhr) {
        console.log('Error:', xhr.responseText);
      }
    });
  });

  // Eliminar cliente
  var deleteId;
  $(document).on('click', '.delete-client', function() {
    console.log('Delete client clicked');

    deleteId = $(this).data('id'); // Captura el ID del cliente
    $('#deleteModal').modal('show'); // Muestra el modal
  });

  $('#confirmDelete').click(function() {
    $.ajax({
      url: '/clients/' + deleteId,
      type: 'DELETE',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function(result) {
        location.reload(); // Recargar la página después de eliminar
        showToast('Cliente eliminado exitosamente.', true); // Mostrar Toast de éxito
      },
      error: function() {
        showToast('Error al eliminar el cliente.', false); // Mostrar Toast de error
      }
    });
  });
</script>
@endsection