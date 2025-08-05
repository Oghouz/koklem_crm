<div class="modal fade" id="paymentModal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('invoice.set.payment')}}" method="POST">
                 <div class="modal-header justify-content-between bg-info">
                    <h5 class="modal-title text-white dark__text-gray-1100" id="staticBackdropLabel">Paiement</h5>
                    <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                            class="fas fa-times fs-9 text-white dark__text-gray-1100"></span></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="paid_at">Date de paiement</label>
                        <input class="form-control" name="paid_at" id="paid_at" type="date" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required="required" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="payment_method">Mode de paiement</label>
                        <select class="form-select" name="payment_method" id="payment_method" required="required">
                            <option disabled selected value="">Selectionner un mode de paiement</option>
                            <option value="Virement">Virement</option>
                            <option value="Chèque">Chèque</option>
                            <option value="Carte Bancaire">Carte Bancaire</option>
                            <option value="Espèces">Espèces</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="total_paid">Montant paiement</label>
                        <input class="form-control" name="total_paid" id="total_paid" type="number" value="{{$invoice->total_ttc}}" required="required" />
                    </div>
                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                    <button class="btn btn-success" type="submit">Valider</button>
                    <button class="btn btn-outline-secondary" type="button" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>    
        </div>
    </div>
</div>