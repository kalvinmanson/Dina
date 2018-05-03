@extends('layouts.app')
@section('title', 'MultiServicios Dina')
@section('meta-keywords', 'Contacte con nosotros')
@section('meta-description', 'Contacte con nosotros')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-6">
        <h4>Devoluciones:</h4>
        <p>Si presento algún problema con el pedido y desea solicitar el cambio de alguno de los productos seleccione el pedido del cual requiere hacer el cambio o devolución.</p>
        <h4>Quejas y reclamos</h4>
        <p>Para nosotros es muy importante atender cualquier solicitud, duda, queja o reclamo relacionado con nuestro servicio, escribanos y le responderemos a su correo en poco tiempo.</p>
      </div>
      <div class="col-sm-6">
        @include('partials.forms.contact')
      </div>
    </div>
</div>
@endsection
