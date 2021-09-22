<div>
    @if (array_key_exists("nama",$student))
    <livewire:register-form :student="$student" />
    @else
    @if ($captcha === false)
    <div class="alert alert-danger">
        <strong>Mohon maaf!</strong> Situs referensi kemdikbud sedang gangguan silahkan pilih <a href="#"
            class="alert-link btnOpsiLain"><u>Opsi Lain</u></a>.
    </div>
    @endif
    <form class="form-horizontal" wire:submit.prevent="getNisn">
        <div class="form-group">
            <label class="control-label col-sm-3" for="nisn">NISN:</label>
            <div class="col-sm-9">
                <input type="text" wire:model.lazy="nisn" class="form-control"
                    placeholder="Nomor Induk Santri Nasional">
                <small>
                    *Bisa ditanyakan ke sekolah asal, atau cari di
                    <a href="//referensi.data.kemdikbud.go.id/nisn/index.php/Cindex/formcaribynama"
                        target="_blank"><u>situs kemdikbud</u></a><br>
                </small>
                @error('nisn') <strong class="text-danger">{{ $message }}</strong> @enderror
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="kode_captcha">Captcha:</label>
            <div class="col-sm-9">
                <input type="text" wire:model.lazy="kode_captcha" class="form-control"
                    placeholder="Ketikan captcha dibawah">
                @error('kode_captcha') <strong class="text-danger">{{ $message }}</strong> @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3" style="margin-bottom: 10px; padding: 0;">
                <img src="{{ $captcha }}" width="200" height="80" alt="captcha">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-default" wire:loading.class="disabled">
                    <span wire:loading.remove>Submit</span>
                    <span wire:loading class="text-muted">Processing...</span>
                </button>
                &nbsp; &nbsp; atau &nbsp; &nbsp;
                <a href="#" class="btnOpsiLain"><u>Opsi Lain</u></a>
            </div>
        </div>
    </form>
    @endif
</div>
