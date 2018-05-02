<form method="POST" action="{{ url('contact') }}">
  {{ csrf_field() }}

  @if(!Auth::check())
    <div class="form-group">
        <label for="name">Nombre completo</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Nombre completo" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Correo electrónico" required>
    </div>
  @endif

  <div class="form-group">
    <label for="subject">Asunto</label>
    <input type="text" name="subject" id="subject" class="form-control" placeholder="Asunto" required>
  </div>

  @if(Auth::check())
  <div class="form-group">
    <label for="order_id">Orden (Solo para devoluciones)</label>
    <select name="order_id" class="form-control">
      <option value="0">Ninguna</option>
      @foreach(Auth::user()->orders as $order)
      <option value="{{ $order->id }}">{{ $order->id.' | Total: $ '.$order->total }} | Fecha: {{ $order->created_at }} | Estado: {{ $order->status }}</option>
      @endforeach
    </select>
  </div>
  @endif

  <div class="form-group">
    <label for="content">Mensaje</label>
    <textarea name="content" id="content" class="form-control" placeholder="Mensaje" rows="10" required></textarea>
  </div>

  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Enviar</button>

</form>
