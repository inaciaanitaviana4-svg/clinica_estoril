<div class="modal fade" id="remover-modal" tabindex="-1" role="dialog" aria-labelledby="remover-modal-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="remover-modal-label">Deseja remover esse item?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja remover este item? Esta ação não pode ser desfeita.</p>

                <p hidden id="remover-modal-error" class="bg-danger text-white"
                    style="padding: 4px; border-radius: 4px;"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                <button id="confirm-button" type="button" class="btn btn-primary">Sim</button>
            </div>
        </div>
    </div>
</div>
