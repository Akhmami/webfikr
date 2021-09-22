<div>
    @if ($expired)
    <h3 class="text-danger">PENDAFTARAN JALUR BERIKUT TELAH DITUTUP!</h3><br><br>
    @else
    <form class="form-horizontal" wire:submit.prevent="store">
        @honeypot
        <div class="form-group">
            <label class="control-label col-sm-3">Cari Berdasarkan:</label>
            <div class="col-sm-9">
                <select wire:model.lazy="pilihan" class="form-control">
                    <option value="">Pilih</option>
                    <option value="nik">NIK</option>
                    <option value="ttl">Tanggal Lahir</option>
                </select>
                @error('pilihan') <strong class="text-danger">{{ $message }}</strong> @enderror
            </div>
        </div>

        @if ($pilihan == 'nik')
        <div class="form-group">
            <label class="control-label col-sm-3"></label>
            <div class="col-sm-9">
                <input type="text" wire:model.lazy="nik" class="form-control" placeholder="Masukan NIK" required>
                @error('nik') <strong class="text-danger">{{ $message }}</strong> @enderror
            </div>
        </div>
        @endif

        @if ($pilihan == 'ttl')
        <div class="form-group">
            <label class="control-label col-sm-3"></label>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-md-4" style="padding-right: 0;">
                        <input type="text" wire:model.lazy="tempat_lahir" class="form-control"
                            placeholder="Tempat Lahir" required>
                        @error('tempat_lahir') <strong class="text-danger">{{ $message }}</strong> @enderror
                    </div>
                    <div class="col-md-8" style="padding-left: 0;">
                        <input type="text" wire:model.lazy="tanggal_lahir" class="form-control"
                            placeholder="Tanggal Lahir Ex: 2020-09-29" required>
                        @error('tanggal_lahir') <strong class="text-danger">{{ $message }}</strong> @enderror
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="form-group has-feedback @if(session()->has('vouchererr'))has-error bg-danger @elseif(session()->has('vouchersuc'))has-success bg-success @else bg-info @endif"
            style="margin-bottom: 0;">
            <label class="control-label col-sm-3" for="voucher">Voucher Diskon:</label>
            <div class="col-sm-7">
                <input type="text" wire:model.lazy="voucher" class="form-control" placeholder="Kode Voucher">
                <span class="form-control-feedback" wire:loading wire:target="voucher">
                    <img src="/images/loader.gif" width="20px" height="20px">
                </span>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-default btn-sm">Check</button>
            </div>
        </div>
        <div class="col-sm-9 col-sm-offset-3" style="margin-bottom: 15px;">
            @if (session()->has('vouchererr'))
            <strong class="text-danger">{{ session('vouchererr') }}</strong>
            @endif
            @if (session()->has('vouchersuc'))
            <strong class="text-success">{{ session('vouchersuc') }}</strong>
            @endif
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-default">Daftar Sekarang</button>
            </div>
        </div>
    </form>
    @endif
</div>
