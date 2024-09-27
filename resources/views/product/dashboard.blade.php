@extends('layouts.app')

@section('title', 'Products Dashboard')

@section('content')
<div class="container">
  <h1>Mantenedor de Productos</h1>

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
      + Nuevo Proyecto
    </button>
  </div>

  <table class="table table-striped">
    <thead>
      <tr>
        <!-- <th>ID</th> -->
        <th>Sku</th>
        <th>Nombre</th>
        <th>Descripcion Corta</th>
        <th>Descripcion Larga</th>
        <th>Imagen</th>
        <th>Precio Neto</th>
        <th>Precio Venta</th>
        <th>Stock Actual</th>
        <th>Stock Minimo</th>
        <th>Stock Bajo</th>
        <th>Stock Alto</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        <td>{{ $product->sku }}</td>
        <td>{{ $product->nombre }}</td>
        <td>{{ $product->descripcion_corta }}</td>
        <td>{{ $product->descripcion_larga }}</td>
        <td>
          @if($product->imagen)
          <img src="{{ asset('storage/' . $product->imagen) }}" alt="Imagen del product" style="width: 50px; height: auto;">
          @else
          Sin imagen
          @endif
        </td>
        <td>{{ $product->precio_neto }}</td>
        <td>{{ $product->precio_venta }}</td>
        <td>{{ $product->stock_actual }}</td>
        <td>{{ $product->stock_minimo }}</td>
        <td>{{ $product->stock_bajo }}</td>
        <td>{{ $product->stock_alto }}</td>
        <td>
          <!-- Ver product -->
          <button class="btn btn-sm btn-info view-product" data-id="{{ $product->id }}" title="Ver" data-bs-toggle="modal" data-bs-target="#viewModal">
            <i class="bi bi-eye" aria-hidden="true"></i>
          </button>

          <!-- Editar product -->
          <button class="btn btn-sm btn-warning edit-product" data-id="{{ $product->id }}" title="Editar" data-bs-toggle="modal" data-bs-target="#editModal">
            <i class="bi bi-pencil" aria-hidden="true"></i>
          </button>

          <!-- Eliminar product -->
          <button class="btn btn-sm btn-danger delete-product" data-id="{{ $product->id }}" title="Eliminar" data-bs-toggle="modal" data-bs-target="#deleteModal">
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

<!-- Modal para crear producto -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Crear Nuevo Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
          <div class="authentication-inner py-6">
            <div class="app-brand justify-content-center mb-6">
              <a href="{{ url('/') }}" class="app-brand-link">
                <span class="app-brand-logo demo">
                  <!-- Logo SVG code -->
                </span>
                <span class="app-brand-text demo text-heading fw-bold">Vuexy</span>
              </a>
            </div>
            <h4 class="mb-1">Agrega un nuevo producto 🚀</h4>

            <!-- Formulario de producto -->
            <form method="POST" action="{{ route('product.store') }}" id="formAuthentication" enctype="multipart/form-data">
              @csrf

              <!-- SKU -->
              <div class="mb-6">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" id="create-sku" class="form-control" name="sku" required autofocus placeholder="Ingresa el SKU">
                <x-input-error :messages="$errors->get('sku')" class="mt-2" />
              </div>

              <!-- Nombre -->
              <div class="mb-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="create-nombre" class="form-control" name="nombre" required placeholder="Ingresa el nombre del producto">
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
              </div>

              <!-- Descripción Corta -->
              <div class="mb-6">
                <label for="descripcion_corta" class="form-label">Descripción Corta</label>
                <input type="text" id="create-descripcion_corta" class="form-control" name="descripcion_corta" required placeholder="Ingresa una descripción corta">
                <x-input-error :messages="$errors->get('descripcion_corta')" class="mt-2" />
              </div>

              <!-- Descripción Larga -->
              <div class="mb-6">
                <label for="descripcion_larga" class="form-label">Descripción Larga</label>
                <textarea id="create-descripcion_larga" class="form-control" name="descripcion_larga" required placeholder="Ingresa una descripción larga"></textarea>
                <x-input-error :messages="$errors->get('descripcion_larga')" class="mt-2" />
              </div>

              <!-- Imagen -->
              <div class="mb-6">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" id="create-imagen" class="form-control" name="imagen">
                <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
              </div>

              <!-- Precio Neto -->
              <div class="mb-6">
                <label for="precio_neto" class="form-label">Precio Neto</label>
                <input type="number" id="create-precio_neto" class="form-control" name="precio_neto" required placeholder="Ingresa el precio neto">
                <x-input-error :messages="$errors->get('precio_neto')" class="mt-2" />
              </div>

              <!-- Precio Venta -->
              <div class="mb-6">
                <label for="precio_venta" class="form-label">Precio Venta</label>
                <input type="number" id="create-precio_venta" class="form-control" name="precio_venta" required placeholder="Ingresa el precio de venta">
                <x-input-error :messages="$errors->get('precio_venta')" class="mt-2" />
              </div>

              <!-- Stock Actual -->
              <div class="mb-6">
                <label for="stock_actual" class="form-label">Stock Actual</label>
                <input type="number" id="create-stock_actual" class="form-control" name="stock_actual" required placeholder="Ingresa el stock actual">
                <x-input-error :messages="$errors->get('stock_actual')" class="mt-2" />
              </div>

              <!-- Stock Mínimo -->
              <div class="mb-6">
                <label for="stock_minimo" class="form-label">Stock Mínimo</label>
                <input type="number" id="create-stock_minimo" class="form-control" name="stock_minimo" required placeholder="Ingresa el stock mínimo">
                <x-input-error :messages="$errors->get('stock_minimo')" class="mt-2" />
              </div>

              <!-- Stock Bajo -->
              <div class="mb-6">
                <label for="stock_bajo" class="form-label">Stock Bajo</label>
                <input type="number" id="create-stock_bajo" class="form-control" name="stock_bajo" required placeholder="Ingresa el stock bajo">
                <x-input-error :messages="$errors->get('stock_bajo')" class="mt-2" />
              </div>

              <!-- Stock Alto -->
              <div class="mb-6">
                <label for="stock_alto" class="form-label">Stock Alto</label>
                <input type="number" id="create-stock_alto" class="form-control" name="stock_alto" required placeholder="Ingresa el stock alto">
                <x-input-error :messages="$errors->get('stock_alto')" class="mt-2" />
              </div>

              <!-- Botón de crear producto -->
              <button class="btn btn-primary d-grid w-100">{{ __('Crear Producto') }}</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal producto -->
<!-- Contenido del modal que estará oculto mientras se carga -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Contenido del modal que estará oculto mientras se carga -->
      <div class="modal-body" id="edit-modalContent">
        <form id="editProductForm" action="" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <!-- SKU -->
          <div class="mb-3">
            <label for="sku" class="form-label">SKU</label>
            <input type="text" class="form-control" id="edit-sku" name="sku" required>
          </div>

          <!-- Nombre -->
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="edit-nombre" name="nombre" required>
          </div>

          <!-- Descripción Corta -->
          <div class="mb-3">
            <label for="descripcion_corta" class="form-label">Descripción Corta</label>
            <input type="text" class="form-control" id="edit-descripcion_corta" name="descripcion_corta" required>
          </div>

          <!-- Descripción Larga -->
          <div class="mb-3">
            <label for="descripcion_larga" class="form-label">Descripción Larga</label>
            <textarea class="form-control" id="edit-descripcion_larga" name="descripcion_larga" required></textarea>
          </div>

          <!-- Imagen -->
          <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="text" class="form-control" id="edit-imagen" name="imagen">
          </div>

          <!-- Precio Neto -->
          <div class="mb-3">
            <label for="precio_neto" class="form-label">Precio Neto</label>
            <input type="number" class="form-control" id="edit-precio_neto" name="precio_neto" required>
          </div>

          <!-- Precio Venta -->
          <div class="mb-3">
            <label for="precio_venta" class="form-label">Precio Venta</label>
            <input type="number" class="form-control" id="edit-precio_venta" name="precio_venta" required>
          </div>

          <!-- Stock Actual -->
          <div class="mb-3">
            <label for="stock_actual" class="form-label">Stock Actual</label>
            <input type="number" class="form-control" id="edit-stock_actual" name="stock_actual" required>
          </div>

          <!-- Stock Mínimo -->
          <div class="mb-3">
            <label for="stock_minimo" class="form-label">Stock Mínimo</label>
            <input type="number" class="form-control" id="edit-stock_minimo" name="stock_minimo" required>
          </div>

          <!-- Stock Bajo -->
          <div class="mb-3">
            <label for="stock_bajo" class="form-label">Stock Bajo</label>
            <input type="number" class="form-control" id="edit-stock_bajo" name="stock_bajo" required>
          </div>

          <!-- Stock Alto -->
          <div class="mb-3">
            <label for="stock_alto" class="form-label">Stock Alto</label>
            <input type="number" class="form-control" id="edit-stock_alto" name="stock_alto" required>
          </div>

          <!-- Botón de guardar cambios -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>




<!-- Modal para ver producto -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel">Información del Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="view-modalContent">
        <div class="card-body pt-12">
          <div class="product-avatar-section">
            <div class="d-flex align-items-center flex-column">
              @if($product->imagen)
              <img src="{{ asset('storage/' . $product->imagen) }}" alt="Imagen del product" style="width: 50px; height: auto;">
              @else
              Sin imagen
              @endif
            </div>
          </div>
          <h5 class="pb-4 border-bottom mb-4">Detalles del Producto</h5>
          <div class="info-container">
            <ul class="list-unstyled mb-6">
              <li class="mb-2">
                <span class="h6">SKU:</span>
                <span id="product-sku"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Nombre:</span>
                <span id="product-nombre"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Descripción Corta:</span>
                <span id="product-descripcion_corta"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Descripción Larga:</span>
                <span id="product-descripcion_larga"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Precio Neto:</span>
                <span id="product-precio_neto"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Precio Venta:</span>
                <span id="product-precio_venta"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Stock Actual:</span>
                <span id="product-stock_actual"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Stock Mínimo:</span>
                <span id="product-stock_minimo"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Stock Bajo:</span>
                <span id="product-stock_bajo"></span>
              </li>
              <li class="mb-2">
                <span class="h6">Stock Alto:</span>
                <span id="product-stock_alto"></span>
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

<!-- Modal para eliminar producto -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Eliminar Producto</h5> <!-- Cambiado a Producto -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Estás seguro de que deseas eliminar este producto?</p>
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

  // Editar producto
  $(document).on('click', '.edit-product', function() {
    var productId = $(this).data('id');
    console.log('Product ID:', productId);

    // Ocultar el contenido del modal mientras se cargan los datos
    $('#edit-modalContent').hide();

    // Llamada AJAX para obtener los datos del producto
    $.ajax({
      url: '/products/' + productId + '/edit',
      method: 'GET',
      success: function(data) {
        console.log('Received data:', data);

        // Llenar los campos del formulario con los datos recibidos
        $('#edit-sku').val(data.sku);
        $('#edit-nombre').val(data.nombre);
        $('#edit-descripcion_corta').val(data.descripcion_corta);
        $('#edit-descripcion_larga').val(data.descripcion_larga);
        $('#edit-imagen').val(data.imagen);
        $('#edit-precio_neto').val(data.precio_neto);
        $('#edit-precio_venta').val(data.precio_venta);
        $('#edit-stock_actual').val(data.stock_actual);
        $('#edit-stock_minimo').val(data.stock_minimo);
        $('#edit-stock_bajo').val(data.stock_bajo);
        $('#edit-stock_alto').val(data.stock_alto);

        // Actualizar la acción del formulario
        $('#editProductForm').attr('action', '/products/' + productId);

        // Mostrar el contenido del modal
        $('#edit-modalContent').fadeIn('slow');
      },
      error: function(xhr) {
        console.log('Error:', xhr.responseText);
      }
    });
  });



  // Ver producto desde la tabla
  $(document).on('click', '.view-product', function() {
    var productId = $(this).data('id');
    console.log('Product ID:', productId);

    $('#view-modalContent').hide();

    // Llamada AJAX para obtener los datos del producto
    $.ajax({
      url: '/products/' + productId,
      method: 'GET',
      success: function(data) {
        console.log('Received data:', data);

        // Rellenar el modal con los datos del producto seleccionado
        $('#product-nombre').text(data.nombre);
        $('#product-sku').text(data.sku);
        $('#product-descripcion_corta').text(data.descripcion_corta);
        $('#product-descripcion_larga').text(data.descripcion_larga);
        $('#product-precio_neto').text(data.precio_neto);
        $('#product-precio_venta').text(data.precio_venta);
        $('#product-stock_actual').text(data.stock_actual);
        $('#product-stock_minimo').text(data.stock_minimo);
        $('#product-stock_bajo').text(data.stock_bajo);
        $('#product-stock_alto').text(data.stock_alto);

        // Mostrar el modal
        $('#view-modalContent').fadeIn('slow');
      },
      error: function(xhr) {
        console.log('Error:', xhr.responseText);
      }
    });
  });


  // Delete Product
  // Delete Product
  var deleteId;
  $(document).on('click', '.delete-product', function() {
    console.log('Delete product clicked');

    deleteId = $(this).data('id'); // Captura el ID del producto
    $('#deleteModal').modal('show'); // Muestra el modal
  });

  $('#confirmDelete').click(function() {
    $.ajax({
      url: '/products/' + deleteId,
      type: 'DELETE',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function(result) {
        location.reload(); // Recargar la página después de eliminar
        showToast('Producto eliminado exitosamente.', true); // Mostrar Toast de éxito
      },
      error: function() {
        showToast('Error al eliminar el producto.', false); // Mostrar Toast de error
      }
    });
  });
</script>
@endsection