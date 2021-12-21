<div>
    <section aria-labelledby="profile-overview-title">
        <div class="rounded-lg bg-white overflow-hidden shadow">
            <h2 class="sr-only" id="profile-overview-title">PSB Overview</h2>
            <div class="bg-white py-6 px-10">
                <div class="sm:flex">
                    <div class="mt-4 sm:mt-0 sm:pt-1 sm:text-left">
                        <h2 class="text-base font-medium text-gray-900" id="announcements-title">
                            Home
                        </h2>
                        <div class="mt-6 prose">
                            @if (in_array($data['status_psb_id'], [1, 2]))
                            {!! $data['description'] !!}
                            @else
                            @if (strtotime('now') >= strtotime($data['tgl_pengumuman']))
                            {!! $data['description'] !!}
                            @else
                            <p class="text-red-600 font-semibold animate-pulse">
                                Pengumuman penerimaan PSB akan berlangsung pada {{ tanggal(date('Y-m-d',
                                strtotime($data['tgl_pengumuman']))) }}
                            </p>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
