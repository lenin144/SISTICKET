<?php
$active1 = "active";
include "header.php";
?>

<div class="content-wrapper">
<section class="content-header">
    <h1><i class="fa fa-plus-circle"></i> Solicitar Servicio</h1>
</section>

<section class="content">
<div class="row">
<div class="col-md-10 col-md-offset-1">
<div class="box box-primary">
<div class="box-body">

<form id="formTicket">

<!-- ================= CATEGORÍAS ================= -->
<div class="row">
    <div class="col-md-4">
        <label>Categoría *</label>
        <select id="categoria" name="categoria_id" class="form-control" required>
            <option value="">Seleccione</option>
            <option value="1">Activos Fijos</option>
        </select>
    </div>

    <div class="col-md-4">
        <label>Subcategoría *</label>
        <select id="subcategoria" name="subcategoria_id" class="form-control" required>
            <option value="">Seleccione</option>
        </select>
    </div>

    <div class="col-md-4">
        <label>Categoría tercer nivel *</label>
        <select id="tercer_nivel" name="tercer_nivel_id" class="form-control" required>
            <option value="">Seleccione</option>
        </select>
    </div>
</div>

<hr>

<!-- ================= DATOS ================= -->
<div class="form-group">
    <label>Empresa *</label>
    <select name="empresa_id" class="form-control" required>
        <option value="">Seleccione</option>
        <option value="1">SGS DEL PERÚ</option>
    </select>
</div>

<div class="form-group">
    <label>Título *</label>
    <input type="text" name="titulo" class="form-control" required>
</div>

<div class="form-group">
    <label>Descripción *</label>
    <textarea name="descripcion" class="form-control" rows="4" required></textarea>
</div>

<div class="form-group">
    <label>Responsable *</label>
    <input type="text" name="responsable" class="form-control" required>
</div>

<div class="form-group">
    <label>Cargo *</label>
    <input type="text" name="cargo" class="form-control" required>
</div>

<div class="form-group">
    <label>Motivo *</label>
    <select name="motivo" class="form-control" required>
        <option value="">Seleccione</option>
        <option value="desgaste">Desgaste</option>
        <option value="siniestro">Siniestro</option>
    </select>
</div>

<div class="text-right">
    <button type="submit" class="btn btn-primary">
        <i class="fa fa-send"></i> Enviar
    </button>
</div>

</form>

</div>
</div>
</div>
</div>
</section>
</div>

<script>
const categoria   = document.getElementById('categoria');
const subcategoria= document.getElementById('subcategoria');
const tercerNivel = document.getElementById('tercer_nivel');
const formTicket  = document.getElementById('formTicket');

categoria.addEventListener('change', () => {
    subcategoria.innerHTML = '<option value="">Seleccione</option>';
    tercerNivel.innerHTML = '<option value="">Seleccione</option>';

    if(categoria.value === '1'){
        subcategoria.innerHTML += '<option value="1">Baja de activos</option>';
    }
});

subcategoria.addEventListener('change', () => {
    tercerNivel.innerHTML = '<option value="">Seleccione</option>';

    if(subcategoria.value === '1'){
        tercerNivel.innerHTML += '<option value="1">Obsolescencia</option>';
        tercerNivel.innerHTML += '<option value="2">Otros</option>';
    }
});

formTicket.addEventListener('submit', e => {
    e.preventDefault();

    if(!categoria.value || !subcategoria.value || !tercerNivel.value){
        alert('Categorías incompletas');
        return;
    }

    fetch('ajax/guardar_ticket.php',{
        method:'POST',
        body:new FormData(formTicket)
    })
    .then(r=>r.json())
    .then(d=>{
        alert(d.ok ? 'Solicitud registrada correctamente' : d.error);
        if(d.ok) location.reload();
    });
});
</script>

<?php include "footer.php"; ?>
