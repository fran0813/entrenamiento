<div class="modal fade" id="modalEliminarCategoria" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Confirmar selección</h4>
            </div>
            
            <div class="modal-body">
                <h1 class="text-center">Por favor confirme esta acción</h1>
            </div>

            <div class="modal-footer">
                <input id="idEliminarCategoria" type="text" style="display: none;" disabled>
                <form id="formEliminarCategoria" class="text-center">
                    <button class="btn btn-success" type="submit">Confirmar</button>
                    <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </form>                
                <p class="text-left" id="repuestaEliminarCategoria"></p>
            </div>
        </div>
    </div>
</div>