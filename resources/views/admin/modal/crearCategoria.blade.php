<div class="modal fade" id="modalCrearCategoria" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Crear categoría</h4>
            </div>
            
            <div class="modal-body">
                <form id="formCrearCategoria">
                    <label class="control-label" for="crearCategoria">Título de la categoría</label>
                    <input id="crearCategoria" class="form-control" type="text" placeholder="Ingresar el nombre de la categoria">
                    <button class="btn btn-success" type="submit" style="margin-top: 1%;">Crear</button>
                </form>
                <p id="respuestaCrearCategoria"></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>