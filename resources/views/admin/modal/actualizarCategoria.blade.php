<div class="modal fade" id="modalActualizarCategoria" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Editar categoría</h4>
            </div>
            
            <div class="modal-body">
                <input id="idActualizarCategoria" type="text" style="display: none;" disabled>
                <form id="formEditarCategoria">
                    <label class="control-label" for="actualizarCategoria">Título de la categoría</label>
                    <input id="actualizarCategoria" class="form-control" type="text">
                    <button class="btn btn-info" type="submit" style="margin-top: 1%;">Editar</button>
                </form>
                <p id="respuestaActualizarCategoria"></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>