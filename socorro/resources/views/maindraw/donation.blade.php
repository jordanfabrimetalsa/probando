<div class="modal fade" id="donationModal" tabindex="-1" aria-labelledby="donationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-extra-background">
            <form action="{{ route('donations.create') }}" method="POST">

                @method('POST')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="donationModalLabel">Donación al CSA.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="pt-2 pb-2"><strong class="text-danger">¡Muchas Gracias!, </strong> Somos una institución sin fines de lucro y que auto-financia con los voluntarios.</div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="mb-3">
                                <label>Monto de la donación(CLP):</label>
                                <input type="number" class="form-control" name="amount" value="1000" min="100" required>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-6">
                            <div class="mb-3">
                                <label>Descripción de la donación:</label>
                                <input type="text" rowspan=2 class="form-control" name="description" required>
                            </div>
                        </div>
                    </div>

                    <img src="{{ asset('assets/img/webpay.png') }}" width="300" height="100" class="rounded">

                </div>
         
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-dark btn-save-load">Donar</button>
                </div>
                
            </form>
        </div>
    </div>
</div>


